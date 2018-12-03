<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;  // DO NOT REMOVE!
use App\Http\Services\MailSupportService;
use App\Http\Services\PrismicContentProvider;
use App\Http\Services\PrismicLinkResolver as PrismicLinkResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Prismic\Api;
use Prismic\LinkResolver;
use Prismic\Predicates;
use Barryvdh\Debugbar\Facade as Debugbar;
use ResourceBundle;


class PrismicController extends Controller
{
    /** @var PrismicContentProvider */
    private $contentProvider;
    private $linkResolver;
    private $api;


    public function __construct(PrismicContentProvider $contentProvider, PrismicLinkResolver $linkResolver)
    {
        $this->contentProvider = $contentProvider;
        $this->linkResolver = $linkResolver;
        $this->locale = config('laravellocalization.prismic_locales')[LaravelLocalization::getCurrentLocale()];
        $this->api = Api::get(env('PRISMIC_API'));

    }

    /**
     * Generic page is used when there is no subdocument in the page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function genericPage(Request $request)
    {
        // Get asked page
        $page = $request->route()->action['page'];

        $document = $this->contentProvider->getSimplePage($page, $this->locale);

        if ($request->has("debug")) dd($document);

        return view($page, [
            'doc' => $document
        ]);
    }


    public function contactPage(Request $request, MailSupportService $support)
    {
        if ($request->isMethod("POST")) {

            $name = $request->post("name");
            $email = $request->post("email");
            $tel = $request->post("tel");
            $question = $request->post("question");
            $pref = $request->post("rappel");
            $pref .= $pref == 'tel' ? "(" . $request->post("time") . ")" : '';
            $to = config('mail.to.commercial');
            $subject = "[contact commercial]";
            $message = <<<EOL
Nouveau message de $name
Email : $email
Téléphone : $tel
Préférences de rappel : $pref

$question         
EOL;
            $support->mail($to, $subject, $message);
        }

        // Get asked page
        $page = 'page_contact_commercial';
        $document = $this->contentProvider->getSimplePage($page, $this->locale);

        if ($request->has("debug")) dd($document);

        return view($page, [
            'doc' => $document
        ]);
    }

    /**
     * Feature page
     * @param Request $request
     * @param string $type
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function genericTypePage(Request $request, string $type, string $slug)
    {
        $document = $this->contentProvider->getSimpleType($type, $slug);

        if ($request->has("debug")) dd($document);

        return view('repeatable_'.$type, [
            'doc' => $document
        ]);
    }
    public function client(Request $request, string $slug)
    {
        return $this->genericTypePage($request, 'client', $slug);
    }

    public function fonctionnalite(Request $request, string $slug)
    {
        return $this->genericTypePage($request, 'feature', $slug);
    }

    public function domaine(Request $request, string $slug)
    {
        $document = $this->contentProvider->getSimpleType('domaine', $slug);

        // Get business case
        $case = null;
        if ($document->business_case_button_link->link_type != "Any") {
            $uid = $document->business_case_button_link->uid;
            $case = $this->contentProvider->getSimpleType('client', $uid);
        }

        if ($request->has("debug")) dd($document, $case);

        return view('repeatable_domaine', [
            'doc' => $document,
            'case' => $case
        ]);
    }

    public function post(Request $request, string $slug)
    {
        $document = $this->contentProvider->getSimpleType('blog_post', $slug);

        // Get related posts
        // TODO : use fetch links ?
        // https://prismic.io/docs/php/query-the-api/fetch-linked-document-fields
        $ids = [];
        foreach ($document->related_posts as $post) {
            $ids[] = $post->post->id;
        }
        $related_posts = $this->contentProvider->getPostsByIDs($ids);

        if ($request->has("debug")) dd($document, $related_posts);

        return view('repeatable_blog_post', [
            'doc' => $document,
            'posts' => $related_posts
        ]);
    }
    public function listPosts(Request $request)
    {
        // page
        $page = $request->get("page", 1);

        // category
        if ($request->has("c")) {
            $category = $request->get("c", "all");
        } else {
            $category = $request->get("category", "all");
        }

        $params = [
            'page' => $page,
            'limit' => 7,
            'tags' => $category == "all" ? [] : [$category],
        ];

        $response = $this->contentProvider->getPosts($this->locale, $params);
        if ($response->page != $page) {
            // Don't return results if there is no results, idiot!
            return response(null, 204);
        }
        $next = $page < $response->total_pages ? $page+1 : -1;

        if ($request->has("debug")) dd($params, $response, $next);

        return view('components.list_card_post', [
            'posts' => $response->results,
            'next' => $next
        ]);
    }


    /**
     * @param Request $request
     * @param null|string $slug
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function glossaire(Request $request, ?string $slug = null)
    {
        $glossaire = $this->contentProvider->getGlossaire($this->locale);

        if (count($glossaire) == 0) {
            abort(404, "Glossary is empty :/");
        }

        $item = null;
        if ($slug) {
            foreach ($glossaire as $word) {
                if ($word->uid == $slug) {
                    $item = $word->data;
                    $item->uid = $word->uid;
                    $item->alternate_languages = $word->alternate_languages;

                    $word->selected = true;
                } else {
                    $word->selected = false;
                }
            }
            if (null == $item) {
                abort(404, "Missing definition for " . $slug);
            }
        }
        else {
            $route = route('glossaire_mot', ['slug' => $glossaire[0]->uid]);
            return response(null, 302)->header('Location', $route);
        }

        if ($request->has("debug")) dd($glossaire, $slug, $item);

        return view('repeatable_glossaire', [
            'glossaire' => $glossaire,
            'doc' => $item,
            'slug' => $slug
        ]);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supportPage(Request $request)
    {
        $document = $this->contentProvider->getSimplePage('page_support', $this->locale);

        $categories = [];
        $data = $this->contentProvider->getSupportCategories($this->locale);
        foreach ($data as $c) {
            $categories[$c->uid] = $c;
        }

        $posts = [];
        $data = $this->contentProvider->getSupportPosts($this->locale);
        foreach ($data as $p) {
            $posts[$p->data->support_category->uid][$p->data->support_subcategory][] = $p;
        }

        if ($request->has("debug")) dd($document, $categories, $posts);

        return view('page_support', [
            'doc' => $document,
            'categories' => $categories,
            'posts' => $posts
        ]);
    }

    /**
     * @param Request $request
     * @param string $cat
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supportCat(Request $request, string $cat)
    {

        $support = $this->contentProvider->getSimplePage('page_support', $this->locale);
        $document = $this->contentProvider->getSimpleType('support_categorie2', $cat);

        $categories = $this->contentProvider->getSupportCategories($this->locale);

        $posts = [];
        $data = $this->contentProvider->getSupportPosts($this->locale, $document->id);
        foreach ($data as $p) {
            $posts[$p->data->support_subcategory][] = $p;
        }

        if ($request->has("debug")) dd($document, $posts);

        return view('repeatable_support_cat', [
            'doc' => $document,
            'categories' => $categories,
            'support' => $support,
            'posts' => $posts
        ]);
    }

    /**
     * @param Request $request
     * @param string $cat
     * @param string $slug
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function supportPost(Request $request, string $cat, string $slug)
    {
        $document = $this->contentProvider->getSimpleType('support_post2', $slug);

        $support = $this->contentProvider->getSimplePage('page_support', $this->locale);
        $categories = $this->contentProvider->getSupportCategories($this->locale);

        // Redirect to right route
        if ($cat !== $document->support_category->uid) {
            $url = route("support_post", [
                'cat' => $document->support_category->uid,
                'slug' => $document->uid
            ]);
            return response(null, 302)->header('Location', $url);
        }

        $categorie = null;
        foreach ($categories as $c) {
            if ($c->id == $document->support_category->id) {
                $document->support_category->data = $c->data;
                $categorie = $c->data;
            }
        }

        // Store viewed posts in cookies
        $json = Cookie::get('support_posts');
        Debugbar::info("JSON", $json);
        $ids = $json ? json_decode($json) : [];
        array_filter($ids, function($val) use ($document) {
            return $val != $document->id;
        });
        $ids[] = $document->id;
        $ids = array_slice($ids, -5);
        //setcookie('support_posts', json_encode($ids), time() + 86400, '/');
        Cookie::queue('support_posts', json_encode($ids));

        // Get viewed posts
        $viewed_posts = $this->contentProvider->getPostsByIDs($ids);

        // Get related posts
        $ids = [];
        //dd($document);
        foreach ($document->related_posts as $post) {
            if (property_exists($post->post, 'id'))
                $ids[] = $post->post->id;
        }
        $related_posts = $this->contentProvider->getPostsByIDs($ids);


        if ($request->has("debug")) dd($document, $cat, $categories);

        return view('repeatable_support_post', [
            'doc' => $document,
            'cat' => $categorie,
            'categories' => $categories,
            'support' => $support,
            'viewed_posts' => $viewed_posts,
            'related_posts' => $related_posts,
        ]);
    }



    /**
     * Action for Prismic preview
     * - Get token from Prismic
     * - Set cookie so that next api call to this document will retrieve draft version instead of published version
     * - Redirect to the document
     * @param Request $request
     * @return redirect to preview page
     */
    public function preview(Request $request)
    {
        $token = $request->input('token');
        $url = $this->contentProvider->getPreviewUrl($token);
        return response(null, 302)->header('Location', $url);
    }

    public function inscription(Request $request, MailSupportService $support)
    {
        $name = implode(' ', [$request->post("firstname"), $request->post("lastname")]);
        $email = $request->post("email", "--");
        $tel = $request->post("tel", "--");
        $to = config('mail.to.sales');
        $subject = "[Inscription]";
        $message = <<<EOL
Nouvelle inscription
Nom : $name
Email : $email
Téléphone : $tel
EOL;
        $support->mail($to, $subject, $message);

        return response(null, 302)->header('Location', route('page_home'));
    }
}



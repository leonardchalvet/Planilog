<?php

namespace App\Http\Services;

use Prismic\Api;
use Prismic\Exception\RequestFailureException;
use Prismic\Predicates;
use Prismic\Document;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Cache;


class PrismicContentProvider
{

    private $api;
    /**
     * @var PrismicLinkResolver
     */
    private $linkResolver;

    /**
     * PrismicContentProvider constructor.
     * @param PrismicLinkResolver $linkResolver
     */
    public function __construct(PrismicLinkResolver $linkResolver)
    {
        $url = config('services.prismic.api');
        $token = config('services.prismic.token');
        $this->api = Api::get($url, $token);
        $this->linkResolver = $linkResolver;
    }


    /**
     * @param string $pageType
     * @param string $locale
     * @param array|null $params
     * @return null|\stdClass
     */
    private function get(string $pageType, string $locale, ?array $params = [])
    {
        $predicates = [];
        $predicates[] = Predicates::at('document.type', $pageType);

        $tags = $params['tags'] ?? null;
        if ($tags) {
            $predicates[] = Predicates::at('document.tags', $tags);
        }

        $options = [];
        $options['lang'] = $locale;

        $order = $params['order'] ?? null;
        if ($order) {
            $options['orderings'] = $order;
        }

        $limit = $params['limit'] ?? null;
        if ($limit) {
            $options['pageSize'] = $limit;
        }

        $page = $params['page'] ?? null;
        if ($page) {
            $options['page'] = $page;
        }

        // (support post categorie)
        $cat = $params['categorie'] ?? null;
        if ($cat) {
            $predicates[] = Predicates::any('my.support_post2.support_category', [$cat]);
        }

        /*
        $filters = $params['filters'] ?? null;
        if ($filters) {
            foreach ($filters as $filter => $tags) {
                if ($tags) {
                    $predicates[] = Predicates::any('document.tags', $tags);
                }
            }
        }
        */

        /*
        $search = $params['search'] ?? null;
        if ($search) {
            foreach ($search as $k => $v) {
                if ($v) {
                    $predicates[] = Predicates::any('my.article.'.$k, $v);
                }
            }
        }
        */


        /** @var Document $document */
        Debugbar::startMeasure('prismic', "Prismic API [$pageType]");
        $response = null;
        try {
            //dd($options, $params, $predicates);
            $response = $this->api->query($predicates, $options);
        }
        catch (RequestFailureException $e) {
            dd($predicates, $options, $e);
        }
        Debugbar::stopMeasure('prismic');

        return $response;
    }

    /**
     * Get Prismic content for simple pages
     * @param string $pageType
     * @param string $locale
     * @return mixed
     */
    public function getSimplePage(string $pageType, string $locale)
    {
        $response = $this->get($pageType, $locale);

        if (count($response->results) == 0) {
            abort(404, "$pageType ($locale) not found");
        }
        /** @var Document $document */
        $document = $response->results[0];

        $document->data->document_id = $document->id;
        $document->data->alternate_languages = $document->alternate_languages;

        return $document->data;
    }

    /**
     * Get Prismic content for layouts. Keep in cache for 10 minutes.
     * @param string $pageType
     * @param string $locale
     * @return mixed
     */
    public function getLayout(string $pageType, string $locale)
    {
        $layout = Cache::get($pageType.'-'.$locale, null);

        if (!$layout) {
            $response = $this->get($pageType, $locale);
            if (count($response->results) == 0) {
                abort(500, "Content type '$pageType' missing for the locale '$locale'");
            }
            /** @var Document $document */
            $document = $response->results[0];
            $layout = $document->data;

            Cache::put($pageType.'-'.$locale, $layout, now()->addMinutes(10));
            Debugbar::info("Load $pageType from API");
        }
        else {
            Debugbar::info("Load $pageType from Cache");
        }

        return $layout;
    }


    /**
     * Get local url for preview
     * @param string $token : some prismic token
     * @return string : the local url to go to
     */
    public function getPreviewUrl(string $token)
    {
        return $this->api->previewSession($token, $this->linkResolver, '/');
    }


    /**
     * @param string $locale
     * @param array|null $params
     * @return mixed
     */
    public function getPosts(string $locale, ?array $params = [])
    {
        $response = $this->get('blog_post', $locale, [
            "tags" => $params['tags'] ?? null,
            "order" => "[my.blog_post.post_date desc]",
            "limit" => $params['limit'] ?? null,
            "page" => $params['page'] ?? null
        ]);

        if (count($response->results) == 0) {
            Debugbar::warning("No article [".implode(',', $params['tags'])." / $locale] found");
        }
        return $response;
    }


    /**
     * @param array $ids
     * @return array
     */
    public function getPostsByIDs(array $ids)
    {
        /** @var Document $document */
        Debugbar::startMeasure('prismic', "Prismic API [posts by ids]");
        $response = $this->api->getByIDs($ids);
        Debugbar::stopMeasure('prismic');

        return $response->results ?? [];
    }

    /**
     * @param $type
     * @param $slug
     * @return mixed
     */
    public function getSimpleType($type, $slug)
    {
        /** @var Document $document */
        Debugbar::startMeasure('prismic', "Prismic API [$type: $slug]");
        $document = $this->api->getByUID($type, $slug);
        Debugbar::stopMeasure('prismic');

        if (null == $document) {
            abort(404, "$type $slug not found");
        }

        $document->data->id = $document->id;
        $document->data->uid = $document->uid;
        $document->data->tags = $document->tags;
        $document->data->lang = substr($document->lang, 0, 2);
        $document->data->alternate_languages = $document->alternate_languages;
        return $document->data;
    }

    /**
     * Get glossary words list
     * @param string $locale
     * @return mixed
     */
    public function getGlossaire(string $locale)
    {
        $response = $this->get('glossaire', $locale, [
            //"tags" => $params['tags'] ?? null,
            "order" => "[my.glossaire.word]",
            "limit" => 1000,
            //"page" => $params['page'] ?? null
        ]);

        if (count($response->results) == 0) {
            Debugbar::warning("No glossaire item");
        }

        return $response->results;
    }

    public function getSupportCategories(string $locale)
    {
        $response = $this->get('support_categorie2', $locale, [
            //"tags" => $params['tags'] ?? null,
            "order" => "[my.support_categorie2.support_order]",
            "limit" => 1000,
            //"page" => $params['page'] ?? null
        ]);

        if (count($response->results) == 0) {
            Debugbar::warning("No support category item");
        }

        return $response->results;
    }
    public function getSupportPosts(string $locale, ?string $cat = null)
    {
        $response = $this->get('support_post2', $locale, [
            "categorie" => $cat,
            //"tags" => $params['tags'] ?? null,
            "order" => "[my.support_post2.support_title]",
            "limit" => 1000,
            //"page" => $params['page'] ?? null
        ]);

        if (count($response->results) == 0) {
            Debugbar::warning("No support post item");
        }

        return $response->results;
    }
}


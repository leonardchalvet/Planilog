<?php

namespace App\Http\Services;

use Prismic\Api;
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
     * @return \Prismic\Prismic
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

        $filters = $params['filters'] ?? null;
        if ($filters) {
            foreach ($filters as $filter => $tags) {
                if ($tags) {
                    $predicates[] = Predicates::any('document.tags', $tags);
                }
            }
        }

        $search = $params['search'] ?? null;
        if ($search) {
            foreach ($search as $k => $v) {
                if ($v) {
                    $predicates[] = Predicates::any('my.article.'.$k, $v);
                }
            }
        }


        /** @var Document $document */
        Debugbar::startMeasure('prismic', "Prismic API [$pageType]");
        $response = $this->api->query($predicates, $options);
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

        $document->data->$pageType->document_id = $document->id;
        return $document->data->$pageType;
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
            $layout = $document->data->$pageType;

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
     * @param array $tags
     * @param string $locale
     * @param array|null $params
     * @return mixed
     */
    public function getArticles(array $tags, string $locale, ?array $params = [])
    {
        $response = $this->get('article', $locale, [
            "tags" => $tags,
            "tags2" => $tags,
            "order" => "[my.article.article_date desc]",
            "limit" => $params['limit'] ?? null,
            "page" => $params['page'] ?? null,
            "search" => $params['search'] ?? null,
            "filters" => $params['filters'] ?? null
        ]);

        if (count($response->results) == 0) {
            Debugbar::warning("No article [".implode(',', $tags)." / $locale] found");
        }

        return $response->results;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getArticle($slug)
    {
        /** @var Document $document */
        Debugbar::startMeasure('prismic', "Prismic API [article: $slug]");
        $document = $this->api->getByUID('article', $slug);
        Debugbar::stopMeasure('prismic');

        if (null == $document) {
            abort(404, "Article $slug not found");
        }

        $document->data->article->uid = $document->uid;
        $document->data->article->tags = $document->tags;
        $document->data->article->lang = substr($document->lang, 0, 2);
        return $document->data->article;
    }
}


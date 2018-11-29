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
        try {
            $response = $this->api->query($predicates);
            //dd($predicates, $options, $response);
        }
        catch (RequestFailureException $e) {
            dd($e);
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

        $document->data->uid = $document->uid;
        $document->data->tags = $document->tags;
        $document->data->lang = substr($document->lang, 0, 2);
        $document->data->alternate_languages = $document->alternate_languages;
        return $document->data;
    }
}


<?php

namespace App\Http\Services;


use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Services\PrismicLinkResolver;

class AlternateLangResolver
{
    /**
     * @var LinkResolver
     */
    private $linkResolver;
    private $locales;

    /**
     * AlternateLangResolver constructor.
     * @param PrismicLinkResolver $linkResolver
     */
    public function __construct(PrismicLinkResolver $linkResolver)
    {
        $this->linkResolver = $linkResolver;
        $this->locales = array_flip(Config::get('laravellocalization.prismic_locales'));
    }

    public function getAlternateLang(array $alternate_languages)
    {
        $response = [];
        $curentLocale = LaravelLocalization::getCurrentLocale(); // en, fr...
        $route = Route::currentRouteName();

        // For each laravel locales (en, fr...)
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {

            // Default url is current url
            $url = null;
            $hreflang = null;
            $params = Route::current()->parameters();

            // Don't translate current url in current locale
            if ($key !== $curentLocale) {
                // Check if current page has alternate language defined (in prismic)
                // For each prismic locales (en-us, fr-fr...)
                foreach ($alternate_languages as $alt) {
                    // If there is a match
                    if (($this->locales[$alt->lang] ?? null) == $key) {
                        // Then we translate the route's params
                        $here = true;
                        $hreflang = $alt->lang;
                        if (property_exists($alt, 'uid')) $params['slug'] = $alt->uid;
                        if (isset($params['cat'])) $params['cat'] = 'xxx';
                        break; // Don't check others prismic locales
                    }
                }
                // If there is no match, remove slug (to go to default page)
                // eg: /en/blog/some-english-article-not-in-french => /fr/blog
                if (!$hreflang) {
                    $params['slug'] = "";
                }
            }

            $url = LaravelLocalization::getURLFromRouteNameTranslated($key, 'routes.'.$route, $params);
            //Debugbar::info($key . " " . $route . " -> " . $url, $params);

            $response[$key] = [
                "locale_code" => $key,
                "locale_name" => $locale['native'],
                "hreflang"    => $hreflang,
                "url"         => $url,
            ];

        }

        return $response;
    }
}
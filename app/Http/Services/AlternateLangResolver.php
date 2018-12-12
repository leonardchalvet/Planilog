<?php

namespace App\Http\Services;


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

        // For each laravel locales (en, fr...)
        foreach (LaravelLocalization::getSupportedLocales() as $key => $locale) {

            // Default url is current url
            $url = null;
            $hreflang = null;

            // Current locale url is already current locale url -> let $url null
            if ($key != $curentLocale) {
                // Check if there is a alternate language document defined in Prismic
                // For each prismic locales (en-us, fr-fr...)
                foreach ($alternate_languages as $alt) {
                    // If there is a match
                    if (($this->locales[$alt->lang] ?? null) == $key) {
                        //dump($alt, $key);
                        $hreflang = $alt->lang;
                        $url = $this->linkResolver->resolve($alt);
                        break; // Don't check others prismic locales
                    }
                }
                // Get prefix url if there is no alternate language in the doc
                // eg: /en/blog/some-english-article-not-in-french => /fr/blog
                $url = $url ?? $url = Route::current()->compiled->getStaticPrefix();
            }

            // "convert" link to asked locale
            $url = LaravelLocalization::getLocalizedURL($key, $url);

            $response[] = [
                "url" => $url,
                "hreflang" => $hreflang,
                "locale_name" => $locale['native'],
                "locale_code" => $key,
            ];
        }

        return $response;
    }
}
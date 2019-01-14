<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Config;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Prismic\LinkResolver;
use Barryvdh\Debugbar\Facade as Debugbar;
use Route;

class PrismicLinkResolver extends LinkResolver
{


    private $locale;
    private $locales;
    /**
     * PrismicLinkResolver constructor.
     */
    public function __construct()
    {
        $this->locale = LaravelLocalization::getCurrentLocale();
        $this->locales = array_flip(Config::get('laravellocalization.prismic_locales'));
    }


    /**
     * Returns the application-specific URL related to this document link
     *
     * @param object $link The document link
     *
     * @return string The URL of the link
     */
    public function resolve($link) :?string
    {
        //dd($link);
        $url = "/";
        if (property_exists($link, 'isBroken') && $link->isBroken === true) {
            $url = '/404';
        }


        // LINK
        if (property_exists($link, 'link_type')) {
            if ($link->link_type == "Any") {
                //Debugbar::warning("Missing link URL " . print_r($link, true));
                $url = "#";
            }
            elseif (substr($link->link_type, 0, 5) == "page_") {
                // Direct route to page
                if (Route::has($link->link_type)) {
                    $url = route($link->link_type);
                }
            }
            elseif ($link->link_type == "Web") {
                // Web link
                $url = $link->url;
                return $url; // DON'T TRANSLATE THIS, IDIOT!
            }
            elseif ($link->link_type == "Document") {
                $url = $this->resolve2($link);
            }

        }

        // DOCUMENT
        elseif (property_exists($link, 'type')) {
            $url = $this->resolve2($link);
        }

        // Localized link
        $locale = $this->locale; // default
        $url1 = $url;
        if (property_exists($link, 'lang') && isset($this->locales[$link->lang])) {
            $locale = $this->locales[$link->lang];
        }
        elseif (property_exists($link, 'lang') && in_array($link->lang, $this->locales)) {
            $locale = $link->lang;
        }
        $url = LaravelLocalization::getLocalizedURL($locale, $url);

        //Debugbar::info($link, $url);
        //dd($link, $locale, $this->locales, $url);
        return $url;
    }


    private function resolve2($link)
    {
        $url = "/";
        
        if (substr($link->type, 0, 5) == "page_") {
            // Direct route to page
            if (Route::has($link->type)) {
                $url = route($link->type);
            }
        }
        elseif ($link->type == "glossaire") {
            $url = route("glossaire_mot", ['slug' => $link->uid]);
        }
        elseif ($link->type == "simple_page") {
            $url = route($link->type, ['slug' => $link->uid]);
        }
        elseif ($link->type == "domaine") {
            $url = route($link->type, ['slug' => $link->uid]);
        }
        elseif ($link->type == "feature") {
            $url = route("fonctionnalite", ['slug' => $link->uid]);
        }
        elseif ($link->type == "client") {
            $url = route($link->type, ['slug' => $link->uid]);
        }
        elseif ($link->type == "blog_post") {
            $url = route($link->type, ['slug' => $link->uid]);
        }
        elseif ($link->type == "support_post") {
            $url = route($link->type, ['slug' => $link->uid]);
        }
        elseif ($link->type == "support_categorie2") {
            $url = route("support_cat", ['cat' => $link->uid]);
        }
        elseif ($link->type == "support_post2") {
            $url = route("support_post", ['cat' => 'xxx', 'slug' => $link->uid]);
        }
        return $url;
    }
}

<?php

namespace App\Http\Services;

use Prismic\LinkResolver;
use Route;

class PrismicLinkResolver extends LinkResolver
{

    /**
     * Returns the application-specific URL related to this document link
     *
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
            if (substr($link->link_type, 0, 5) == "page_") {
                // Direct route to page
                if (Route::has($link->link_type)) {
                    $url = route($link->link_type);
                }
            }
            elseif ($link->link_type == "Web") {
                // Web link
                $url = $link->url;
            }

        }

        // DOCUMENT
        elseif (property_exists($link, 'type')) {
            if (substr($link->type, 0, 5) == "page_") {
                // Direct route to page
                if (Route::has($link->type)) {
                    $url = route($link->type);
                }
            }

        }

        return $url;


        /*
        elseif (property_exists($link, 'type')) {
            if (substr($link->link_type, 0, 5) == "page_") {
                // Direct route to page
                if (Route::has($link->link_type)) {
                    $url = route($link->link_type);
                }
            }
        }
        elseif (substr($link->link_type, 0, 5) == "page_") {
            // Direct route to page
            if (Route::has($link->link_type)) {
                $url = route($link->link_type);
            }
        }
        elseif ($link->link_type == "article") {
            // Direct route to post
            $tags = $link->tags ?? [];
            if (in_array('customer', $tags)) {
                $url = route('post_customers', ['slug' => $link->uid]);
            }
            else if (in_array('press', $tags)) {
                $url = route('post_press', ['slug' => $link->uid]);
            }
            else {
                $url = '/404';
            }
        }
        elseif ($link->link_type == "Web") {
            // Web link
            $url = $link->url;
        }
        elseif ($link->link_type === 'Link.document') {
            // Document
            $doc = $link->value->document;
            if ($doc->link_type == 'article') {
                // Article
                if (in_array("customer", $doc->tags)) {
                    $url = route('post_customers', ['slug' => $doc->uid]);
                }
                else if (in_array("press", $doc->tags)) {
                    $url = route('post_press', ['slug' => $doc->uid]);
                }
                else if (in_array("hub", $doc->tags)) {
                    $url = route('post_hub', ['slug' => $doc->uid]);
                }
            }
            elseif ($doc->link_type == "software") {
                // Direct route to software
                $url = route('post_integrations', ['slug' => $doc->uid]);
            }
            else {
                // Page
                $url = route($doc->link_type);
            }
        }
        elseif ($link->link_type === 'Link.image') {
            // Image (hosted on prismic)
            $url = $link->value->image->url;
        }
        elseif ($link->link_type === 'Link.file') {
            // Simple file (hosted on prismic)
            $url = $link->value->file->url;
        }

        return $url;
        */
    }
}

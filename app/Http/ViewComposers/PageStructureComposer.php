<?php

namespace app\Http\ViewComposers;

use App\Http\Services\PrismicContentProvider;
use App\Http\Services\PrismicLinkResolver;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PageStructureComposer
{

    private $locale;

    /** @var PrismicContentProvider */
    private $contentProvider;
    /**
     * @var PrismicLinkResolver
     */
    private $linkResolver;

    /**
     * PageStructureComposer constructor.
     * @param PrismicLinkResolver $linkResolver
     * @param PrismicContentProvider $contentProvider
     */
    public function __construct(PrismicLinkResolver $linkResolver, PrismicContentProvider $contentProvider)
    {
        $this->locale = config('laravellocalization.prismic_locales')[LaravelLocalization::getCurrentLocale()];
        $this->contentProvider = $contentProvider;
        $this->linkResolver = $linkResolver;
    }

    /**
     * Some usefull variables for all pages
     * @param View $view
     */
    public function composeAll(View $view)
    {
        // Link resolver
        $view->with('linkResolver', $this->linkResolver);

        // Get translation from prismic
        //$translations = $this->contentProvider->getLayout('translations', $this->locale);
        //$view->with('translations', $translations);
    }

    /**
     * Bind data for header to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function composeHeader(View $view)
    {
        $header = $this->contentProvider->getLayout('header', $this->locale);
        $view->with('header', $header);
    }

    /**
     * Bind data for footer to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function composeFooter(View $view)
    {
        $footer = $this->contentProvider->getLayout('footer', $this->locale);
        $view->with('footer', $footer);
    }
}
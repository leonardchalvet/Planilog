<?php

namespace app\Http\ViewComposers;

use App\Http\Services\AlternateLangResolver;
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
     * @var AlternateLangResolver
     */
    private $alternateLangResolver;

    /**
     * PageStructureComposer constructor.
     * @param PrismicLinkResolver $linkResolver
     * @param PrismicContentProvider $contentProvider
     * @param AlternateLangResolver $alternateLangResolver
     */
    public function __construct(PrismicLinkResolver $linkResolver,
                                PrismicContentProvider $contentProvider,
                                AlternateLangResolver $alternateLangResolver
    )
    {
        $this->locale = config('laravellocalization.prismic_locales')[LaravelLocalization::getCurrentLocale()];
        $this->contentProvider = $contentProvider;
        $this->linkResolver = $linkResolver;
        $this->alternateLangResolver = $alternateLangResolver;
    }

    /**
     * Some usefull variables for all pages
     * @param View $view
     */
    public function composeAll(View $view)
    {
        // Link resolver
        $view->with('linkResolver', $this->linkResolver);
        $view->with('alternateLangResolver', $this->alternateLangResolver);

        // Get translation from prismic
        //$translations = $this->contentProvider->getLayout('translations', $this->locale);
        //$view->with('translations', $translations);

        // Get header (for signup link)
        $header = $this->contentProvider->getLayout('header', $this->locale);
        $view->with('header', $header);
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
    public function composeFooterCTA(View $view)
    {
        $footer_cta = $this->contentProvider->getLayout('footer_cta', $this->locale);
        $view->with('footer_cta', $footer_cta);
    }
}
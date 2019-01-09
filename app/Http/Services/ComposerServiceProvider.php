<?php

namespace app\Http\Services;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', 'App\Http\ViewComposers\PageStructureComposer@composeAll');
        View::composer('layouts/header', 'App\Http\ViewComposers\PageStructureComposer@composeHeader');
        View::composer('layouts/footer', 'App\Http\ViewComposers\PageStructureComposer@composeFooter');
        View::composer('layouts/footer_cta', 'App\Http\ViewComposers\PageStructureComposer@composeFooterCTA');

        View::composer('components/header_banner', 'App\Http\ViewComposers\PageStructureComposer@composeHeader');
        View::composer('components/header_cookies', 'App\Http\ViewComposers\PageStructureComposer@composeHeader');

        View::composer('errors/404', 'App\Http\ViewComposers\PageStructureComposer@composeError');
        View::composer('errors/500', 'App\Http\ViewComposers\PageStructureComposer@composeError');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
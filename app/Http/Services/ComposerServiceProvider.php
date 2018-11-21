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
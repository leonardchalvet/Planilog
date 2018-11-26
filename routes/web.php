<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Used by Prismic for previews
Route::get('/preview', ['uses' => 'PrismicController@preview']);

/*
 * Groups for localized routes
 * https://github.com/mcamara/laravel-localization
 */
Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localize' ]
],
function () {

    Route::get(
        '/',
        ['uses' => 'PrismicController@genericPage', 'page' => 'page_home']
    )->name('page_home');

    Route::get(
        LaravelLocalization::transRoute('routes.tarifs'),
        ['uses' => 'PrismicController@genericPage', 'page' => 'page_tarifs']
    )->name('page_tarifs');

    // DOMAINES
    Route::get(
        LaravelLocalization::transRoute('routes.domaine'),
        ['uses' => 'PrismicController@domaine']
    )->name('domaine');

    // FEATURES
    /*
    Route::get(
        LaravelLocalization::transRoute('routes.fonctionnalite'),
        ['uses' => 'PrismicController@genericTypePage', 'type' => 'fonctionnalite']
    )->name('fonctionnalite');
    */

    // CLIENTS
    Route::get(
        LaravelLocalization::transRoute('routes.client'),
        ['uses' => 'PrismicController@client']
    )->name('client');

});

// Github webhook
Route::post('git-webhook', function () {
    app('debugbar')->disable();

    // test :
    //curl -i -X POST -H 'Content-Type: application/json' -d '{"toto": "tata"}' http://planilog.elune.ovh/git-webhook
    $data = json_decode(file_get_contents('php://input'), true);

    $ref = $data["ref"] ?? "none";
    if ($ref != "refs/heads/master") {
        return response(null, 200);
    }

    shell_exec("echo 1 > /tmp/planilog.webhook.github");
    return response(null, 200);
});


// Test error page
Route::get('500', function () {
    throw new \Exception('TEST PAGE. This simulated error exception allows testing of the 500 error page.');
});

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
        LaravelLocalization::transRoute('routes.page_tarifs'),
        ['uses' => 'PrismicController@genericPage', 'page' => 'page_tarifs']
    )->name('page_tarifs');

    Route::get(
        LaravelLocalization::transRoute('routes.page_cookies'),
        ['uses' => 'PrismicController@genericPage', 'page' => 'page_cookies']
    )->name('page_cookies');

    Route::get(
        LaravelLocalization::transRoute('routes.page_contact_commercial'),
        ['uses' => 'PrismicController@contactPage']
    )->name('page_contact_commercial');
    // Formulaire
    Route::post(
        LaravelLocalization::transRoute('routes.page_contact_assistance'),
        ['uses' => 'PrismicController@contactForm']
    );
    Route::get(
        LaravelLocalization::transRoute('routes.page_contact_assistance'),
        ['uses' => 'PrismicController@genericPage', 'page' => 'page_contact_assistance']
    )->name('page_contact_assistance');

    // DOMAINES
    Route::get(
        LaravelLocalization::transRoute('routes.domaine'),
        ['uses' => 'PrismicController@domaine']
    )->name('domaine');

    // FONCTIONNATLIES
    Route::get(
        LaravelLocalization::transRoute('routes.fonctionnalite'),
        ['uses' => 'PrismicController@fonctionnalite']
    )->name('fonctionnalite');

    Route::redirect(LaravelLocalization::transRoute('routes.fonctionnalite_root'), '/', 302);
    Route::redirect(LaravelLocalization::transRoute('routes.domaine_root'), '/', 302);

    // CLIENTS
    Route::get(
        LaravelLocalization::transRoute('routes.client'),
        ['uses' => 'PrismicController@client']
    )->name('client');

    // BLOG
    Route::get(
        LaravelLocalization::transRoute('routes.page_blog'),
        ['uses' => 'PrismicController@genericPage', 'page' => 'page_blog']
    )->name('page_blog');
    // ARTICLES LIST
    Route::get(
        'list-posts',
        ['uses' => 'PrismicController@listPosts']
    )->name('list_posts');
    // ARTICLE
    Route::get(
        LaravelLocalization::transRoute('routes.blog_post'),
        ['uses' => 'PrismicController@post']
    )->name('blog_post');

    // GLOSSAIRE
    Route::get(
        LaravelLocalization::transRoute('routes.page_glossaire'),
        ['uses' => 'PrismicController@glossaire']
    )->name('page_glossaire');
    Route::get(
        LaravelLocalization::transRoute('routes.glossaire_mot'),
        ['uses' => 'PrismicController@glossaire']
    )->name('glossaire_mot');


    // SUPPORT
    Route::get(
        LaravelLocalization::transRoute('routes.page_support'),
        ['uses' => 'PrismicController@supportPage']
    )->name('page_support');
    Route::get(
        LaravelLocalization::transRoute('routes.support_cat'),
        ['uses' => 'PrismicController@supportCat']
    )->name('support_cat');
    Route::get(
        LaravelLocalization::transRoute('routes.support_post'),
        ['uses' => 'PrismicController@supportPost']
    )->name('support_post');
});


// Formulaire d'inscription
Route::post('/trial', ['uses' => 'PrismicController@inscription'])->name('inscription');


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

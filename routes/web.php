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
        LaravelLocalization::transRoute('routes.page_contact_commercial'),
        ['uses' => 'PrismicController@contactPage']
    )->name('page_contact_commercial');
    // Formulaire
    Route::post(
        LaravelLocalization::transRoute('routes.page_contact_commercial'),
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
    // FONCTIONNATLIES
    Route::get(
        LaravelLocalization::transRoute('routes.tarif'),
        ['uses' => 'PrismicController@tarif']
    )->name('tarif');

    Route::redirect(LaravelLocalization::transRoute('routes.fonctionnalite_root'), '/', 301);
    Route::redirect(LaravelLocalization::transRoute('routes.domaine_root'), '/', 301);
    Route::redirect(LaravelLocalization::transRoute('routes.client_root'), '/', 301);
    Route::redirect(LaravelLocalization::transRoute('routes.simple_page_root'), '/', 301);

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

    // GENERIC PAGES
    Route::get(
        LaravelLocalization::transRoute('routes.simple_page'),
        ['uses' => 'PrismicController@simplePage']
    )->name('simple_page');

});


// Formulaire d'inscription
Route::post('/trial', ['uses' => 'PrismicController@inscription'])->name('inscription');


// Github webhook
Route::post('/git-webhook', ['uses' => 'GitController@githubWebhook']);


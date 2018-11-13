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

});

// Github webhook
// curl -i -X POST -H 'Content-Type: application/json' -d '{"name": "New item", "year": "2009"}' http://planilog.elune.ovh/git-webhook
// curl -i -X POST -H 'Content-Type: application/json' -d '{"name": "New item", "year": "2009"}' http://planilog.local/git-webhook
Route::post('git-webhook', function () {
    app('debugbar')->disable();

    $data = json_decode(file_get_contents('php://input'), true);
    print_r($data);

    if ($data["hook"]["config"]["secret"] != "reok2aadophih0zie9oN") {
        return response(null, 403);
    }

    if ($data["hook"]["config"]["secret"] != "reok2aadophih0zie9oN") {
        return response(null, 200);
    }


    shell_exec("touch /tmp/planilog.webhook.github && chmod 777 /tmp/planilog.webhook.github");
    return response(null, 200);
});


// Test error page
Route::get('500', function () {
    throw new \Exception('TEST PAGE. This simulated error exception allows testing of the 500 error page.');
});

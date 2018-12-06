<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Add some blade directive
         * NOTE: you need to run "php artisan view:clear" if directives are edited to reload them
         */

        Blade::directive('simpleText', function ($arguments) {
            // lol! Blade directives cannot use multiple parameters?
            list($doc, $field) = explode(',',str_replace(['(',')',' ', '\''], '', $arguments));

            return  '<?= isset('.$doc.'->'.$field.') ? nl2br('.$doc.'->'.$field.') : ""; ?>';
        });

        Blade::directive('richText', function ($arguments) {
            // lol! Blade directives cannot use multiple parameters?
            $arguments = explode(',',str_replace(['(',')',' ', '\''], '', $arguments));
            list($doc, $field) = $arguments;
            $class = $arguments[2] ?? null;

            // RichText::asHtml($doc->cover_intro->value, $linkResolver))
            if ($class) {
                // Add class to paragraph
                return '<?= isset(' . $doc . '->' . $field . ') ? str_replace("<p>", "<p class=\''.$class.'\'>", RichText::asHtml(' . $doc . '->' . $field . ', $linkResolver)) : ""; ?>';
            }
            else {
                return '<?= isset(' . $doc . '->' . $field . ') ? RichText::asHtml(' . $doc . '->' . $field . ', $linkResolver) : ""; ?>';
            }
        });

        // Same as richText but for articles, with extra parameter $htmlSerializer
        Blade::directive('richTextArticle', function ($arguments) {
            // lol! Blade directives cannot use multiple parameters?
            list($doc, $field) = explode(',',str_replace(['(',')',' ', '\''], '', $arguments));

            // RichText::asHtml($doc->cover_intro->value, $linkResolver, $htmlSerializer))
            // Also, remove empty paragraph
            return '<?= isset(' . $doc . '->' . $field . ') ? str_replace("<p></p>", "", RichText::asHtml(' . $doc . '->' . $field . '->value, $linkResolver, $htmlSerializer)) : ""; ?>';
        });

        Blade::directive('imageSrc', function ($arguments) {
            // lol! Blade directives cannot use multiple parameters?
            list($doc, $field) = explode(',',str_replace(['(',')',' ', '\''], '', $arguments));

            return  '<?= isset('.$doc.'->'.$field.') && isset('.$doc.'->'.$field.'->url) ? '.$doc.'->'.$field.'->url : ""; ?>';
        });
        Blade::directive('linkSrc', function ($arguments) {
            // lol! Blade directives cannot use multiple parameters?
            list($doc, $field) = explode(',',str_replace(['(',')',' ', '\''], '', $arguments));

            return  '<?= isset('.$doc.'->'.$field.') ? $linkResolver->resolve('.$doc.'->'.$field.') : ""; ?>';
        });
        Blade::directive('linkTarget', function ($arguments) {
            // lol! Blade directives cannot use multiple parameters?
            list($doc, $field) = explode(',',str_replace(['(',')',' ', '\''], '', $arguments));

            return  '<?= (isset('.$doc.'->'.$field.') && isset('.$doc.'->'.$field.'->target)) ? "target=\"".'.$doc.'->'.$field.'->target."\"" : ""; ?>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            // For IDE helpers
            // run "php artisan clear-compiled && php artisan ide-helper:generate" to generate helpers
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}

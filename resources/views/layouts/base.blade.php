<!doctype html>
<html lang="{{ app()->getLocale() }}" xmlns:og="http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />

    {{-- STYLE --}}
    <link type="text/css" rel="stylesheet" href="@yield('style')">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('og_title')" />
    <meta property="og:description" content="@yield('og_description')" />
    <meta property="og:type" content="@yield('content_type', 'website')" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:image" content="@yield('og_image')" />
    <meta property="og:image:secure_url" content="@yield('og_image')" />
    <meta property="og:locale" content="{{ app()->getLocale() }}" />

    {{-- FAVICON
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="194x194" href="{{ asset('img/favicon/favicon-194x194.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#f5f5f5">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('img/favicon/mstile-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    --}}

    {{-- alternate languages --}}
    {{-- Erk, c'est moche :( --}}
    <?php $locales = array_flip(Config::get('laravellocalization.prismic_locales')); ?>
    @foreach($doc->alternate_languages as $alt)
        <link rel="alternate"
              href="{{ LaravelLocalization::getLocalizedURL($locales[$alt->lang], $linkResolver->resolve($alt)) }}"
              hreflang="<?= $alt->lang ?>" />
    @endforeach

    {{-- canonical url --}}
    @if (isset($lang) && $lang != LaravelLocalization::getCurrentLocale())
        {{-- if language is defined (on articles) --}}
        <link rel="canonical" href="{{ LaravelLocalization::getLocalizedURL($lang) }}" />
    @else
        {{-- else, canonical url is current url --}}
        <link rel="canonical" href="{{ URL::current() }}" />
    @endif

</head>

<body>

@include('layouts.header')

@yield('content')

@include('layouts.footer')


@yield('js')


{{-- DEBUG --}}
<style>
    @keyframes blink { 50% { outline: 1px solid red; } }
    /*.emptyLink{ animation: blink 2s step-end infinite alternate; }*/
    .emptyLink { outline: 2px solid #6eff64; }
</style>
<script>$('a[href="#"]').addClass("emptyLink");</script>

{{--  Prismic Toolbar for previews
<script>
    window.prismic = { endpoint: '{{ Config::get('services.prismic.api') }}' };
</script>
<script src="https://static.cdn.prismic.io/prismic.min.js"></script>
--}}

</body>
</html>


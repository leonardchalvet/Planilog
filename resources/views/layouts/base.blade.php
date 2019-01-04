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
    @foreach($alternateLangResolver->getAlternateLang($doc->alternate_languages) as $alt)
        @continue($alt["hreflang"] == null)
        <link rel="alternate" href="{{ $alt["url"] }}" hreflang="{{ $alt["hreflang"] }}" />
    @endforeach
    <!-- <link rel="canonical" href="{{ URL::current() }}" /> -->

</head>

<body>



@include('layouts.header')

@yield('content')

@include('layouts.footer')


@yield('js')


<script src="{{ asset("js/js.cookie.js") }}"></script>
@include('components.header_banner')
@include('components.header_cookies')


{{-- DEBUG --}}
<style>
    @keyframes blink { 50% { outline: 1px solid red; } }
    /*.emptyLink{ animation: blink 2s step-end infinite alternate; }*/
    .emptyLink:not(.logo) { outline: 2px solid #6eff64; }
    .prout {
        font-size: 16px;
        font-family: OpenSans-Regular;
    }
</style>
<script>
    $('a[href="#"]').addClass("emptyLink");
    $('a[href="{{ LaravelLocalization::getLocalizedURL(null, "/") }}"]').addClass("emptyLink");
</script>

{{-- trial form --}}
<script>
    $("form.ajaxForm").submit(function(e) {
        // prevent Default functionality
        e.preventDefault();
        // get the action-url of the form
        var actionurl = e.currentTarget.action;
        // disable button
        $(this).find("button").addClass("active").prop("disabled",true);
        // post form
        $.post(actionurl, $(this).serialize(), function(data) {
            // Nothing to do here
        });
    });
</script>


{{--  Prismic Toolbar for previews --}}
<script>
    window.prismic = { endpoint: '{{ Config::get('services.prismic.api') }}' };
</script>
<script src="https://static.cdn.prismic.io/prismic.min.js"></script>

</body>
</html>


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


    {{-- FAVICON --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('img/favicon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('img/favicon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('img/favicon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('img/favicon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('img/favicon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('img/favicon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('img/favicon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('img/favicon/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon-196x196.png') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon-128.png') }}" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('mstile-144x144.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ asset('mstile-70x70.png') }}" />
    <meta name="msapplication-square150x150logo" content="{{ asset('mstile-150x150.png') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ asset('mstile-310x150.png') }}" />
    <meta name="msapplication-square310x310logo" content="{{ asset('mstile-310x310.png') }}" />

    {{-- alternate languages --}}
    @foreach($alternateLangResolver->getAlternateLang($doc->alternate_languages) as $alt)
        @continue($alt["hreflang"] == null)
        <link rel="alternate" href="{{ $alt["url"] }}" hreflang="{{ $alt["hreflang"] }}" />
    @endforeach
    <link rel="canonical" href="{{ LaravelLocalization::getLocalizedURL() }}">


</head>

<body>



@include('layouts.header')

@yield('content')

@include('layouts.footer')


@include('components.google_tag_manager')
@yield('js')
<script src="{{ asset("js/js.cookie.js") }}"></script>
@include('components.header_banner')
@include('components.header_cookies')

<!-- Drip -->
<script type="text/javascript">
  var _dcq = _dcq || [];
  var _dcs = _dcs || {};
  _dcs.account = '6665262';

  (function() {
    var dc = document.createElement('script');
    dc.type = 'text/javascript'; dc.async = true;
    dc.src = '//tag.getdrip.com/6665262.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(dc, s);
  })();
</script>
<!-- end Drip -->

<!-- Albacross -->
<script type="text/javascript">
 (function(a,l,b,c,r,s){_nQc=c,r=a.createElement(l),s=a.getElementsByTagName(l)[0];r.async=1;
 r.src=l.src=("https:"==a.location.protocol?"https://":"http://")+b;s.parentNode.insertBefore(r,s);
 })(document,"script","serve.albacross.com/track.js","89360617");
</script>
<!-- END: Albacross -->


{{-- Show missing links --}}
<style>
    @keyframes blink { 50% { outline: 1px solid red; } }
    /*.emptyLink{ animation: blink 2s step-end infinite alternate; }*/
    .emptyLink:not(.logo) { outline: 2px solid #6eff64; }
</style>
<script>
    $('a[href="#"]').addClass("emptyLink");
    $('a[href="{{ LaravelLocalization::getLocalizedURL(null, "/") }}"]').addClass("emptyLink");
</script>

{{-- ajax forms --}}
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
<script type="text/javascript" src="https://clearbitjs.com/v1/x/forms.js"></script>
<script src="https://static.cdn.prismic.io/prismic.min.js"></script>

</body>
</html>


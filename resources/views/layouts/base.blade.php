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

<!-- Segment for www.planilog.com -->
<script>
  !function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on"];analytics.factory=function(t){return function(){var e=Array.prototype.slice.call(arguments);e.unshift(t);analytics.push(e);return analytics}};for(var t=0;t<analytics.methods.length;t++){var e=analytics.methods[t];analytics[e]=analytics.factory(e)}analytics.load=function(t,e){var n=document.createElement("script");n.type="text/javascript";n.async=!0;n.src="https://cdn.segment.com/analytics.js/v1/"+t+"/analytics.min.js";var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(n,a);analytics._loadOptions=e};analytics.SNIPPET_VERSION="4.1.0";
  analytics.load("Q75bZihyzaVCvyOG9evAGrSTFE4J46Hk");
  analytics.page();
  }}();
</script>
<!-- END: Segment -->

<!-- Hotjar Tracking Code for www.planilog.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1365974,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<!-- END: Hotjar -->


<!-- Crisp -->
<script type="text/javascript">
window.$crisp=[];window.CRISP_WEBSITE_ID="8edf0053-091e-4629-81d7-2c2ca36066b9";(function(){d=document;s=d.createElement("script");
s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();
</script>
<!-- END: Crisp -->

<!-- Heap web analytics -->
<script type="text/javascript">
    window.heap=window.heap||[],heap.load=function(e,t){window.heap.appid=e,window.heap.config=t=t||{};var r=t.forceSSL||"https:"===document.location.protocol,a=document.createElement("script");a.type="text/javascript",a.async=!0,a.src=(r?"https:":"http:")+"//cdn.heapanalytics.com/js/heap-"+e+".js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(a,n);for(var o=function(e){return function(){heap.push([e].concat(Array.prototype.slice.call(arguments,0)))}},p=["addEventProperties","addUserProperties","clearEventProperties","identify","resetIdentity","removeEventProperty","setEventProperties","track","unsetEventProperty"],c=0;c<p.length;c++)heap[p[c]]=o(p[c])};
      heap.load("2188196716");
</script>
<!-- END: Heap -->

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




<!-- ActiveCampaign Conversation -->
<script type="text/javascript">
    (function(e,t,o,n,p,r,i){e.visitorGlobalObjectAlias=n;e[e.visitorGlobalObjectAlias]=e[e.visitorGlobalObjectAlias]||function(){(e[e.visitorGlobalObjectAlias].q=e[e.visitorGlobalObjectAlias].q||[]).push(arguments)};e[e.visitorGlobalObjectAlias].l=(new Date).getTime();r=t.createElement("script");r.src=o;r.async=true;i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)})(window,document,"https://diffuser-cdn.app-us1.com/diffuser/diffuser.js","vgo");
    vgo('setAccount', '66437612');
    vgo('setTrackByDefault', true);

    vgo('process');
</script>
<!-- END: ActiveCampaign -->







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


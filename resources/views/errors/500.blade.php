<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $doc->seo_page_title }}</title>
    <link type="text/css" rel="stylesheet" href="/css/lost.css">

</head>

<body>
<main>
    <div class="head">
        <div class="wrapper">
            <a href="{{route('page_home')}}">
                <img src="{{ asset('img/common/logo.png') }}">
            </a>
        </div>
    </div>

    <section id="section-page">
        <img class="shape" src="{{ asset('img/home/sectionCover/shape.svg') }}">
        <div class="wrapper">
            <h1>500</h1>
            <p>@simpleText($doc, text_500)</p>
            <a class="btn" href="{{route('page_home')}}">
                <div class="btn-text">@simpleText($doc, link)</div>
                <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
            </a>
        </div>
    </section>
</main>
</body>
</html>
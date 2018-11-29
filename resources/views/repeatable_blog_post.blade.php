<?php
use Prismic\Dom\richText;
?>

@extends('layouts.base', ['doc' => $doc])

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/post.css'))
@section('header_class', 'style-dark')

@section('content')

    <?php
    if (LaravelLocalization::getCurrentLocale() == "fr") {
    setlocale(LC_TIME, 'fr_FR');
    }
    else {
    setlocale(LC_TIME, 'en_US');
    }
    ?>


    <main>

        <section id="section-post">
            <img class="shape" src="{{ asset('img/home/sectionCover/shape.svg') }}">
            <div class="wrapper">
                <div class="head">

                    <div class="categorie">
                        <?= implode(', ', $doc->tags) ?>
                    </div>

                    <h1>
                        @simpleText($doc, post_title)
                    </h1>

                    <div class="container-user">
                        <div class="pp" style="background-image: url(@imageSrc($doc, post_author_image));"></div>
                        <p>
                            @simpleText($doc, post_published_by)
                            <strong>@simpleText($doc, post_author)</strong>
                            @simpleText($doc, post_published_at)
                            <?php
                            $date = \Carbon\Carbon::parse($doc->post_date);
                            $date = $date->formatLocalized("%d %b %Y");
                            ?>
                            <strong><?= $date ?></strong>
                        </p>
                    </div>
                    <div class="cover" style="background-image: url(@imageSrc($doc, post_image));"></div>
                </div>


                <div class="content">

                    @foreach ($doc->body as $el)

                        @switch($el->slice_type)

                            @case("texte")
                                @richText($el->primary, texte)
                                @break

                            @case("citation")
                                <div class="container-quote">
                                    <img class="obj" src="{{ asset('img/business/icn-quote.svg') }}">
                                    <p>@simpleText($el->primary, quote)</p>
                                    <div class="name">@simpleText($el->primary, author)</div>
                                </div>
                                @break

                            @case("bouton")
                                <button>
                                    <a href="@linkSrc($el->primary, link)" @linkTarget($el->primary, link)>
                                        <span class="btn-text">@simpleText($el->primary, button)</span>
                                        <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                                    </a>
                                </button>
                                @break

                            @case("youtube")
                                <iframe src="https://www.youtube.com/embed/@simpleText($el->primary, youtube_video_id)"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                </iframe>
                                @break

                        @endswitch

                    @endforeach





                    <div class="container-rs">
                        <a href="">
                            <img src="{{ asset('img/blog/icn-facebook.svg') }}">
                        </a>
                        <a href="">
                            <img src="{{ asset('img/blog/icn-twitter.svg') }}">
                        </a>
                        <a href="">
                            <img src="{{ asset('img/blog/icn-linkedin.svg') }}">
                        </a>
                        <a href="">
                            <img src="{{ asset('img/blog/icn-hyperlink.svg') }}">
                        </a>
                    </div>
                </div>
            </div>
        </section>


        @if (count($posts) > 0)
        <section id="section-relatedPost">
            <div class="wrapper">
                <h2>@simpleText($doc, related_title)</h2>
                <div class="container-el">

                    @foreach($posts as $post)
                        <?php $data = $post->data ?>
                        <div class="el">
                            <div class="cover">
                                <div class="background" style="background-image: url(@imageSrc($data, post_image));"></div>
                                <div class="container-rs">
                                    <a href="">
                                        <img src="{{ asset('img/blog/icn-facebook.svg') }}">
                                    </a>
                                    <a href="">
                                        <img src="{{ asset('img/blog/icn-twitter.svg') }}">
                                    </a>
                                    <a href="">
                                        <img src="{{ asset('img/blog/icn-linkedin.svg') }}">
                                    </a>
                                    <a href="">
                                        <img src="{{ asset('img/blog/icn-hyperlink.svg') }}">
                                    </a>
                                </div>
                            </div>
                            <div class="text">
                                <div class="category"><?= implode(', ', $post->tags) ?></div>
                                <h3>
                                    @simpleText($data, post_title)
                                </h3>
                                @richText($data, post_excerpt)
                            </div>
                            <div class="foot">
                                <div class="author">@simpleText($data, post_author)</div>
                                <div class="sep"></div>
                                <?php
                                $date = \Carbon\Carbon::parse($data->post_date);
                                $date = $date->formatLocalized("%d %b %Y");
                                ?>
                                <div class="date"><?= $date ?></div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </section>
        @endif

    </main>

    <?php setlocale(LC_TIME, ''); // reset locale ?>

@endsection


@section('js')
    <script src="{{ asset("js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("js/header.js") }}"></script>
@endsection

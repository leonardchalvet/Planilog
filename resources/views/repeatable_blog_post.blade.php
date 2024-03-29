<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base', ['doc' => $doc])

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/post.css'))
@section('header_class', 'style-dark')

@section('container_title', 'Blog')
@section('container_link', route('page_blog'))

@section('content')

    <?php
    if (LaravelLocalization::getCurrentLocale() == "fr") {
        setlocale(LC_TIME, 'fr_FR');
    } else {
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

                    @richText($doc, post_excerpt)

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

                    @foreach ($doc->body as $slice)
                        @include('components.content_text', ['slice', $slice])
                    @endforeach

                    @component('components.share_links')
                        @slot('title')
                            @simpleText($doc, post_title)
                        @endslot
                        @slot('url')
                            {{ route('blog_post', ['slug' => $doc->uid]) }}
                        @endslot
                    @endcomponent
                </div>
            </div>
        </section>


        @if (count($posts) > 0)
        <section id="section-relatedPost">
            <div class="wrapper">
                <h2>@simpleText($doc, related_title)</h2>
                <div class="container-el">

                    @foreach($posts as $post)
                        @include('components.card_post', ['post', $post])
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
    <script src="{{ asset("js/post.js") }}"></script>
@endsection

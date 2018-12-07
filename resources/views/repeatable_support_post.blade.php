<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base', ['doc' => $doc])

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/support-post.css'))
@section('header_class', 'style-dark')

@section('content')

    <main>

        <section id="section-cover">
            <div class="wrapper">
                <div class="container-title">
                    <div class="container-rslt">
                        <div class="text">
                            @simpleText($cat, support_title)
                        </div>
                        <img src="{{ asset('img/support-list/arrow.svg') }}">
                    </div>
                    <div class="container-dropdown">
                        <div class="container-el">
                            @foreach ($categories as $c)
                                <?php $data = $c->data ?>
                                <a class="el" href="{{ route('support_cat', ['cat' => $c->uid]) }}">
                                    <div class="icn">
                                        <img src="@imageSrc($data, support_icon)">
                                    </div>
                                    <div class="text">
                                        @simpleText($data, support_title)
                                    </div>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-path">
            <div class="wrapper">
                <div class="container-el">

                    <a class="el" href="{{ route('page_support') }}">
                        Support
                    </a>

                    <img src="{{ asset('img/common/arrow-grey.svg') }}">

                    <a class="el" href="{{ route('support_cat', ['cat' => $doc->support_category->uid]) }}">
                        @simpleText($cat, support_title)
                    </a>

                    <img src="{{ asset('img/common/arrow-grey.svg') }}">

                    <a class="el" href="{{ route('support_cat', ['cat' => $doc->support_category->uid]) }}">
                        @simpleText($doc, support_subcategory)
                    </a>

                    <img src="{{ asset('img/common/arrow-grey.svg') }}">

                    <a class="el">
                        @simpleText($doc, support_title)
                    </a>
                </div>
            </div>
        </section>

        <section id="section-post">
            <div class="wrapper">

                @foreach ($doc->body as $slice)
                    @include('components.content_text', ['slice', $slice])
                @endforeach

            </div>
        </section>

        <section id="section-relatedArticles">
            <div class="wrapper">
                <div class="container-col">

                    @if (count($related_posts) > 0)
                    <div class="col">
                        <h3>@simpleText($support, related_posts)</h3>
                        <ul>
                            @foreach($related_posts as $post)
                                <li>
                                    <a href="{{ route('support_post', [
                                                'cat' => $post->data->support_category->uid,
                                                'slug' => $post->uid]) }}">
                                        @simpleText($post->data, support_title)
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (count($viewed_posts) > 0)
                    <div class="col">
                        <h3>@simpleText($support, viewed_posts)</h3>
                        <ul>
                            @foreach($viewed_posts as $post)
                                <li>
                                    <a href="{{ route('support_post', [
                                                'cat' => $post->data->support_category->uid,
                                                'slug' => $post->uid]) }}">
                                        @simpleText($post->data, support_title)
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div>
            </div>
        </section>

        @component('components.support_more')
            @slot('text')
                @simpleText($support, cover_more)
            @endslot
            @slot('button')
                @simpleText($support, cover_button)
            @endslot
            @slot('mail')
                @simpleText($support, cover_button_mail)
            @endslot
        @endcomponent

    </main>

@endsection


@section('js')
    <script src="{{ asset("js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("js/header.js") }}"></script>
    <script src="{{ asset("js/support-post.js") }}"></script>
@endsection

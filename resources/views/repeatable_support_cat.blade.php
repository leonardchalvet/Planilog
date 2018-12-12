<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base', ['doc' => $doc])

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/support-list.css'))
@section('header_class', 'style-white')

@section('content')

    <main>

        <section id="section-cover">
            <div class="wrapper">
                <div class="container-title">
                    <div class="container-rslt">
                        <div class="text">
                            {{-- first word in <span> --}}
                            <?= nl2br(preg_replace('/([^[:space:]]*)(.*)/', "<span>$1</span>$2", $doc->support_title)); ?>
                        </div>
                        <img src="{{ asset('img/support-list/arrow.svg') }}">
                    </div>
                    <div class="container-dropdown">
                        <div class="container-el">
                            @foreach ($categories as $cat)
                                <?php $data = $cat->data ?>
                                <a class="el" href="{{ route('support_cat', ['cat' => $cat->uid]) }}">
                                    <div class="icn">
                                        <img src="@imageSrc($data, support_icon)">
                                    </div>
                                    <div class="text">
                                        @simpleText($data, support_title)
                                    </div>
                                </a>
                            @endforeach
                            {{-- Carte spécifique glossaire --}}
                            <a class="el" href="{{ route('glossaire') }}">
                                <div class="icn">
                                    <img src="{{ asset('img/support/icn-search.svg') }}">
                                </div>
                                <div class="text">
                                    @simpleText($support, glossaire_title)
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-list">
            <div class="wrapper">
                <div class="container-list">
                    @foreach($posts as $name => $sub)
                        <div class="list">
                            <h3>{{ $name }}</h3>
                            <div class="container-el">
                                @foreach($sub as $post)
                                    <?php $data = $post->data ?>
                                    <div class="el">
                                        <a href="{{ route('support_post', ['cat' => $doc->uid, 'slug' => $post->uid]) }}">
                                            @simpleText($data, support_title)
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
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
    <script src="{{ asset("js/support-list.js") }}"></script>
@endsection

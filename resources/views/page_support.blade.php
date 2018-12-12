<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base')

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/support.css'))
@section('header_class', 'style-white')

@section('content')

    <main>

        <section id="section-cover">
            <div class="wrapper">
                <h1>
                    @simpleText($doc, cover_title)
                </h1>
                <div class="container-search">
                    <div class="container-input">
                        <div class="icn">
                            <img src="{{ asset('img/support/search.svg') }}">
                        </div>
                        <input id="liveSearch" type="text" placeholder="@simpleText($doc, cover_search)">
                    </div>
                    <div class="container-dropdown">
                        <div class="container-el" id="liveList">

                            @foreach($posts as $slug => $cat)
                                <?php $data = $categories[$slug]->data; ?>
                                <div class="el liveCat">
                                    <div class="head">
                                        <div class="icn">
                                            <img src="@imageSrc($data, support_icon)">
                                        </div>
                                        <div class="title">
                                            @simpleText($data, support_title)
                                        </div>
                                    </div>
                                    <div class="container-ul">
                                        @foreach($cat as $sub => $items)
                                            <div class="list liveCatElt liveSubCat">
                                                <div class="title">
                                                    {{ $sub }}
                                                </div>
                                                <ul>
                                                    @foreach($items as $post)
                                                        <?php $p = $post->data ?>
                                                        <li class="liveSubCatElt">
                                                            <a href="{{ route('support_post', [
                                                                        'cat' => $slug,
                                                                        'slug' => $post->uid]) }}">
                                                                @simpleText($p, support_title)
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-ftr">
            <div class="wrapper">
                <div class="container-el">

                    @foreach($categories as $cat)
                        <?php $data = $cat->data ?>
                        <a class="el" href="{{ route('support_cat', ['cat' => $cat->uid]) }}">
                            <div class="icn">
                                <img src="@imageSrc($data, support_icon)">
                            </div>
                            <h3>
                                @simpleText($data, support_title)
                            </h3>
                            @richText($data, support_desc)
                        </a>
                    @endforeach

                    {{-- Carte spécifique glossaire --}}
                    <a class="el" href="{{ route('glossaire') }}">
                        <div class="icn">
                            <img src="{{ asset('img/support/icn-search.svg') }}">
                        </div>
                        <h3>
                            @simpleText($doc, glossaire_title)
                        </h3>
                        @richText($doc, glossaire_desc)
                    </a>

                </div>
            </div>
        </section>

        @component('components.support_more')
            @slot('text')
                @simpleText($doc, cover_more)
            @endslot
            @slot('button')
                    @simpleText($doc, cover_button)
            @endslot
            @slot('mail')
                    @simpleText($doc, cover_button_mail)
            @endslot
        @endcomponent

    </main>

@endsection


@section('js')
    <script src="{{ asset("js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("js/header.js") }}"></script>
    <script src="{{ asset("js/support.js") }}"></script>
    <script>
        $(document).ready(function(){
            {{-- LIVE SEARCH --}}
            $(".container-dropdown").hide();
            $("#liveSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".container-dropdown").hide();

                if (value.length >= 3) {

                    $(".container-dropdown").show();

                    $("#liveList .liveSubCatElt").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    });

                    $("#liveList .liveSubCat").show();
                    $("#liveList .liveCat").show();

                    {{-- Masquage des sous-categories vides --}}
                    $("#liveList .liveSubCat").each(function () {
                        if ($(this).find('.liveSubCatElt:visible').length == 0) {
                            $(this).hide();
                        }
                    });
                    {{-- Masquage des categories vides --}}
                    $("#liveList .liveCat").each(function () {
                        if ($(this).find('.liveCatElt:visible').length == 0) {
                            $(this).hide();
                        }
                    });
                }
            });
        });
    </script>
@endsection

<?php
use Prismic\Dom\richText;
?>

@extends('layouts.base', ['doc' => $doc])

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/glossaire.css'))
@section('header_class', 'style-dark')

@section('content')

    <main>

        <section id="section-glossaire">
            <div class="wrapper">
                <div class="container-list">
                    <div class="container-input">
                        <div class="icn">
                            <img src="{{ asset('img/glossaire/search.svg') }}">
                        </div>
                        <input id="liveSearch" type="text" placeholder="Rechercher">
                    </div>
                    <div class="container-el">
                        <ul id="liveList">
                            @foreach($glossaire as $word)
                                <li>
                                    <a href="{{ route('glossaire_mot', ['slug' => $word->uid]) }}">
                                        @simpleText($word->data, word)
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="container-text">

                    <h1>@simpleText($doc, word)</h1>
                    @foreach ($doc->body as $slice)
                        @include('components.content_text', ['slice', $slice])
                    @endforeach

                    @component('components.share_links')
                        @slot('title')
                            @simpleText($doc, post_title)
                        @endslot
                        @slot('url')
                            {{ route('glossaire_mot', ['slug' => $doc->uid]) }}
                        @endslot
                    @endcomponent

                </div>
            </div>
        </section>

    </main>

@endsection


@section('js')
    <script src="{{ asset("js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("js/header.js") }}"></script>
    <script>
        $(document).ready(function(){
            {{-- LIVE SEARCH --}}
            $("#liveSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#liveList li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection

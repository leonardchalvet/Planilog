<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base')

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/cookies.css'))
@section('header_class', '')

@section('content')

    <main>

        <section id="section-cookies">
            <div class="wrapper">
                <h2>@simpleText($doc, title)</h2>

                @richText($doc, desc)

                <a href="{{ route('page_home') }}" class="btn" id="acceptCookiesButton">
                    <span class="btn-text">
                        @simpleText($doc, button)
                    </span>
                </a>
            </div>
        </section>

    </main>

@endsection


@section('js')
    <script src="{{ asset("js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("js/header.js") }}"></script>
    <script>
        $(window).on('load', function() {
            var c = Cookies.get('cookies_policy') || "off";
            $("#section-cookies").on('click', '#acceptCookiesButton', function() {
                Cookies.set('cookies_policy', 'on');
            });
        });
    </script>
@endsection

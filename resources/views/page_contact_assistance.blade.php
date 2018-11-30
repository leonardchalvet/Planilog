<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base')

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/contact-assistance.css'))
@section('header_class', 'style-dark')

@section('content')

    <main>

        <section id="section-contact">

            <img class="shape" src="{{ asset('img/home/sectionCover/shape.svg') }}">

            <div class="wrapper">
                <div class="container-text">
                    <h1>
                        @simpleText($doc, cover_title)
                    </h1>
                    @richText($doc, cover_paragraph, paragraph)
                </div>
                <div class="container-el">
                    <div class="el">
                        <div class="icn">
                            <img src="{{ asset('img/contact-assistance/icon-1.svg') }}">
                        </div>
                        <h3>@simpleText($doc, el_1_title)</h3>
                        @richText($doc, el_1_desc)
                        <a href="@linkSrc($doc, el_1_link)">FAQ</a>
                    </div>
                    <div class="el">
                        <div class="icn">
                            <img src="{{ asset('img/contact-assistance/icon-2.svg') }}">
                        </div>
                        <h3>@simpleText($doc, el_2_title)</h3>
                        @richText($doc, el_2_desc)
                        <a href="mailto:@simpleText($doc, el_2_link)">
                            @simpleText($doc, el_2_link)
                        </a>
                    </div>
                    <div class="el">
                        <div class="icn">
                            <img src="{{ asset('img/contact-assistance/icon-3.svg') }}">
                        </div>
                        <h3>@simpleText($doc, el_3_title)</h3>
                        @richText($doc, el_3_desc)
                        <a href="tel:<?= preg_replace('/[^0-9\+]/', '', $doc->el_3_link) ?>">
                            @simpleText($doc, el_3_link)
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection


@section('js')
    <script src="{{ asset("js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("js/header.js") }}"></script>
@endsection

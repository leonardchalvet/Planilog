<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base', ['doc' => $doc])

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/features.css'))
@section('header_class', '')

@section('content')

    <style>
        #section-cover .container-text h2,
        #section-cover .container-text h1 span{
            color: @simpleText($doc, fct_color);
        }
    </style>

    <main>
        <section id="section-cover">
            <img class="shape" src="{{ asset('img/home/sectionCover/shape.svg') }}">
            <div class="wrapper">
                <div class="container-text">
                    <h2>@simpleText($doc, fct_name)</h2>
                    <h1>
                        <?= str_replace(["[", "]"], ["<span>", "</span>"], nl2br($doc->fct_title)); ?>
                    </h1>
                    <p>
                    @richText($doc, fct_desc)
                    <a class="btn" href="@linkSrc($doc, fct_button_link)" @linkTarget($doc, fct_button_link)>
                        <span class="btn-text">@simpleText($doc, fct_button)</span>
                        <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                    </a>
                </div>
                <div class="container-illu">
                    <iframe src="https://player.vimeo.com/video/@simpleText($doc, fct_video)"
                            frameborder="0"
                            webkitallowfullscreen
                            mozallowfullscreen
                            allowfullscreen></iframe>
                </div>
            </div>
        </section>


        <?php $modeCol = count($doc->options) == 2; ?>
        <section id="section-features" @if($modeCol) class="style-col" @endif>
            <div class="wrapper">
                <div class="container-el">
                    @if($modeCol) <div class="col-el"> @endif
                    @foreach($doc->options[0]->items as $el)
                        <div class="el">
                            <img class="icn" src="@imageSrc($el, icon)">
                            <h3>
                                @simpleText($el, option)
                            </h3>
                            @richText($el, desc)
                        </div>
                    @endforeach
                    @if($modeCol)
                    </div>
                    <div class="col-el">
                        @foreach($doc->options[1]->items as $el)
                            <div class="el">
                                <img class="icn" src="@imageSrc($el, icon)">
                                <h3>
                                    @simpleText($el, option)
                                </h3>
                                @richText($el, desc)
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>


        <section id="section-bnd">
            <div class="background"></div>
            <div class="wrapper">
                <div class="container-text">
                    <h2>@simpleText($doc, see_title)</h2>
                    @richText($doc, see_desc)
                </div>
                <div class="container-el">
                    @foreach($doc->features as $el)
                        <div class="el">
                            <div class="content">
                                <img class="icn" src="@imageSrc($el, icon)">
                                <h3>
                                    @simpleText($el, title)
                                </h3>
                                <a class="btn" href="@linkSrc($el, link)">
                                    <span class="btn-text">@simpleText($doc, see_button)</span>
                                    <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        @include('layouts.footer_cta')

    </main>


@endsection


@section('js')
    <script src="{{ asset("js/jquery-3.3.1.min.js") }}"></script>
    <script src="https://player.vimeo.com/api/player.js"></script>
    <script src="{{ asset("js/header.js") }}"></script>
    <script src="{{ asset("js/features.js") }}"></script>
@endsection

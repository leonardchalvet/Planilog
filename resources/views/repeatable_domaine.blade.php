<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base', ['doc' => $doc])

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/domaine.css'))
@section('header_class', 'style-dark')

@section('content')


    <main class="domaine-production">

        <section id="section-cover">
            <img class="shape" src="{{ asset('img/home/sectionCover/shape.svg') }}">
            <div class="wrapper">
                <div class="container-cover">
                    <div class="container-text">
                        <h1>
                            @simpleText($doc, domaine_title)
                        </h1>
                        @richText($doc, domaine_desc)
                    </div>
                    <div class="container-illu">
                        <img src="@imageSrc($doc, domaine_img)">
                    </div>
                </div>
            </div>
        </section>

        <section id="section-ftr">
            <div class="wrapper">
                <div class="container-text">
                    <h2>@simpleText($doc, content_title)</h2>
                    @richText($doc, content_desc)
                </div>
                <div class="container-el">
                    @foreach($doc->content_items as $item)
                        <div class="el">
                            <div class="icn"></div>
                            <h3>
                                @simpleText($item, title)
                            </h3>
                            @richText($item, desc)
                        </div>
                    @endforeach
                </div>
                <div class="container-btn">
                    <a href="@linkSrc($doc, content_button_link)" @linkTarget($doc, content_button_link)>
                        <span class="btn-text">@simpleText($doc, content_button)</span>
                        <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                    </a>
                </div>
            </div>
        </section>

        {{--
        <section id="section-case">
            <div class="wrapper">
                <div class="container-text">
                    <div class="icn">
                        <img src="{{ asset('img/domaine/Lisi.png') }}">
                    </div>
                    <div class="title">
                        CAS CLIENTS
                    </div>
                    <h3>
                        CMI Services
                    </h3>
                    <p>
                        Présent dans plus de 23 pays, avec 3400 collaborateurs dans le monde, et un chiffre d’affaires
                        de 253 millions d’euros, CMI Services contribue pour 27% au chiffre global du Groupe CMI.
                    </p>
                    <a class="btn" href="#">
                        <span class="btn-text">LIRE LE BUSINESS CASE</span>
                        <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                    </a>
                </div>
                <div class="container-stats">
                    <div class="container-img" style="background-image: url(img/img-test/background-4.jpg);"></div>
                    <div class="container-el">
                        <div class="el">
                            <h4>PRODUCTIVITÉ</h4>
                            <div class="container-num">
                                <div class="num">
                                    + 2
                                </div>
                                <div class="obj">
                                    %
                                </div>
                            </div>
                            <p>
                                35 000 heures de sous-traitance et d’intérim économisées
                            </p>
                        </div>
                        <div class="el">
                            <h4></h4>
                            <div class="container-num">
                                <div class="num">
                                    25
                                </div>
                                <div class="obj">
                                    %
                                </div>
                            </div>
                            <p>
                                Réduction du temps de traitement sur le pointage estimé
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        --}}

        <section id="section-avantage">
            <div class="wrapper">
                <div class="container-text">
                    <h2>@simpleText($doc, benefit_title)</h2>
                    @richText($doc, benefit_desc)
                </div>
                <div class="container-el">
                    @foreach($doc->benefits as $item)
                        <div class="el">
                            <div class="icn"></div>
                            <h3>
                                @simpleText($item, title)
                            </h3>
                            @richText($item, desc)
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
    <script src="{{ asset("js/header.js") }}"></script>
@endsection

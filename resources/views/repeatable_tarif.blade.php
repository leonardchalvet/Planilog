<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base', ['doc' => $doc])

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/tarifs.css'))
@section('header_class', '')

@section('content')

    <main>


    <section id="section-cover">

        <img class="shape" src="{{ asset('img/home/sectionCover/shape.svg') }}">

        <div class="wrapper">

            <div class="container-text">
                <h1>
                    @simpleText($doc, tarifs_title)
                </h1>
                @richText($doc, tarifs_desc_1)
            </div>

        </div>

    </section>

    <section id="section-tarifs">
        <div class="wrapper">
            <div class="container-el">

                @foreach($doc->tarif_bloc as $tarif)
                <div class="el">
                    <!--<img class="icn" src="{{ asset('img/tarifs/sectionTarifs/icn-1.svg') }}">-->
                    <img class="icn" src="@imageSrc($tarif, tarif_bloc_picto)">
                    <h3 class="title">@simpleText($tarif, tarif_bloc_title)</h3>
                    @richText($tarif, tarif_bloc_paragraph, paragraph)
                    <div class="container-price">
                        <span class="price">
                            @simpleText($tarif, tarif_bloc_price)
                        </span>
                        <span class="dvs">
                            €
                        </span>
                    </div>
                    <div class="desc-1">
                        @simpleText($tarif, tarif_bloc_price_desc_1)
                    </div>
                    <div class="desc-2">
                        @simpleText($tarif, tarif_bloc_price_desc_2)
                    </div>
                    <a class="btn"
                       href="@linkSrc($tarif, tarif_bloc_price_link)"
                       @linkTarget($tarif, tarif_bloc_price_link)>
                        <span class="btn-text">@simpleText($tarif, tarif_bloc_price_button)</span>
                        <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                    </a>

                    <ul>
                        @foreach(explode("\n", $tarif->tarif_bloc_options) as $option)
                            <li>
                                <?= $option ?>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach

            </div>
            @richText($doc, tarifs_desc_2, text)
        </div>
    </section>

    <section id="section-try">
        <div class="wrapper">
            <div class="container-text">
                <h2 class="title">@simpleText($doc, free_title)</h2>
                @richText($doc, free_desc, paragraph)
                <form action="@linkSrc($header, header_menu_essai_link)">
                    <div class="container-input">
                        <button class="btn">
                            <span class="btn-text">@simpleText($doc, free_input_button)</span>
                            <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                            <img class="btn-check" src="{{ asset('img/common/check.svg') }}">
                        </button>
                    </div>
                </form>
            </div>
            <div class="container-li">
                <ul>
                    @foreach($doc->free_options as $option)
                        <li>
                            @simpleText($option, option)
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section id="section-faq">
        <div class="wrapper">
            <div class="container-text">
                <img src="{{ asset('img/tarifs/sectionFaq/icn-title.svg') }}">
                <h2>@simpleText($doc, faq_title)</h2>
            </div>
            <div class="container-li">

                @foreach($doc->body as $faqSection)
                    <div class="li">
                    <h3>
                        @simpleText($faqSection->primary, title)
                    </h3>
                    <div class="container-el">

                        @foreach($faqSection->items as $faq)
                        <div class="el">
                            <div class="title">
                                <h4>
                                    @simpleText($faq, question)
                                </h4>
                                <img src="{{ asset('img/common/arrow-black.svg') }}">
                            </div>
                            @richText($faq, réponse)
                        </div>
                        @endforeach

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    </main>

@endsection


@section('js')
    <script src="{{ asset("js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("js/header.js") }}"></script>
    <script src="{{ asset("js/tarifs.js") }}"></script>
@endsection

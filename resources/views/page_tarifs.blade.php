<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base')

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
                <div class="el">
                    <img class="icn" src="{{ asset('img/tarifs/sectionTarifs/icn-1.svg') }}">
                    <h3 class="title">@simpleText($doc, tarif_standard_title)</h3>
                    @richText($doc, tarif_standard_paragraph, paragraph)
                    <div class="container-price">
                        <span class="price">
                            @simpleText($doc, tarif_standard_price)
                        </span>
                        <span class="dvs">
                            €
                        </span>
                    </div>
                    <div class="desc-1">
                        @simpleText($doc, tarif_standard_price_desc_1)
                    </div>
                    <div class="desc-2">
                        @simpleText($doc, tarif_standard_price_desc_2)
                    </div>
                    <a class="btn"
                       href="@linkSrc($doc, tarif_standard_price_link)"
                       @linkTarget($doc, tarif_standard_price_link)">
                        <span class="btn-text">@simpleText($doc, tarif_standard_price_button)</span>
                        <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                    </a>
                    <ul>
                        @foreach($doc->tarif_standard_options as $option)
                            <li>
                                @simpleText($option, option)
                            </li>
                        @endforeach
                    </ul>
                </div>


                <div class="el">
                    <img class="icn" src="{{ asset('img/tarifs/sectionTarifs/icn-2.svg') }}">
                    <h3 class="title">@simpleText($doc, tarif_business_title)</h3>
                    @richText($doc, tarif_business_paragraph, paragraph)
                    <div class="container-price">
                        <span class="price">
                            @simpleText($doc, tarif_business_price)
                        </span>
                        <span class="dvs">
                            €
                        </span>
                    </div>
                    <div class="desc-1">
                        @simpleText($doc, tarif_business_price_desc_1)
                    </div>
                    <div class="desc-2">
                        @simpleText($doc, tarif_business_price_desc_2)
                    </div>
                    <a class="btn"
                       href="@linkSrc($doc, tarif_business_price_link)"
                       @linkTarget($doc, tarif_business_price_link)">
                        <span class="btn-text">@simpleText($doc, tarif_business_price_button)</span>
                        <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                    </a>
                    <ul>
                        @foreach($doc->tarif_business_options as $option)
                            <li>
                                @simpleText($option, option)
                            </li>
                        @endforeach
                    </ul>
                </div>



                <div class="el">
                    <img class="icn" src="{{ asset('img/tarifs/sectionTarifs/icn-3.svg') }}">
                    <h3 class="title">@simpleText($doc, tarif_premium_title)</h3>
                    @richText($doc, tarif_premium_paragraph, paragraph)
                    <div class="container-price">
                        <span class="price">
                            @simpleText($doc, tarif_premium_price)
                        </span>
                        <span class="dvs">
                            €
                        </span>
                    </div>
                    <div class="desc-1">
                        @simpleText($doc, tarif_premium_price_desc_1)
                    </div>
                    <div class="desc-2">
                        @simpleText($doc, tarif_premium_price_desc_2)
                    </div>
                    <a class="btn"
                       href="@linkSrc($doc, tarif_premium_price_link)"
                       @linkTarget($doc, tarif_premium_price_link)">
                        <span class="btn-text">@simpleText($doc, tarif_premium_price_button)</span>
                        <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                    </a>
                    <ul>
                        @foreach($doc->tarif_premium_options as $option)
                            <li>
                                @simpleText($option, option)
                            </li>
                        @endforeach
                    </ul>
                </div>


            </div>
            @richText($doc, tarifs_desc_1, text)
        </div>
    </section>

    <section id="section-try">
        <div class="wrapper">
            <div class="container-text">
                <h2 class="title">@simpleText($doc, free_title)</h2>
                @richText($doc, free_desc, paragraph)
                <p class="title-label">
                    @simpleText($doc, free_input_label)
                </p>
                <form>
                    <div class="container-input">
                        <input type="text" placeholder="@simpleText($doc, free_input_placeholder)">
                        <button class="btn">
                            <span class="btn-text">@simpleText($doc, free_input_button)</span>
                            <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
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

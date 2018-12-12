<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base', ['doc' => $doc])

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/businesscase.css'))
@section('header_class', '')

@section('content')

    <main>
        
        <section id="section-1">
            <div class="wrapper">
                <div class="container-text">
                    <div class="container-pres">
                        <h2>@simpleText($doc, case_title)</h2>
                        <h1>@simpleText($doc, case_business)</h1>
                        @richText($doc, case_desc)
                        <a class="btn"
                           href="@linkSrc($doc, case_button_link)"
                           @linkTarget($doc, case_button_link)>
								<span class="btn-text">
									@simpleText($doc, case_button)
								</span>
                            <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                        </a>
                    </div>

                    <div class="container-cm-text">
                        <div class="icn"></div>
                        <div class="text">
                            <h3>@simpleText($doc, text_1_title)</h3>
                            @richText($doc, text_1_desc)
                        </div>
                    </div>
                </div>
                <div class="container-img" style="background-image: url(@imageSrc($doc, case_cover));"></div>
            </div>
        </section>

        <section id="section-2">
            <div class="wrapper">
                <div class="container-num">
                    <div class="container-el">
                        @foreach($doc->kpis as $kpi)
                            <div class="el">
                                <h4>
                                    @simpleText($kpi, title)
                                </h4>
                                <div class="num">
                                    @simpleText($kpi, value)
                                </div>
                                <div class="desc">
                                    @simpleText($kpi, desc)
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="container-text">
                    <div class="container-cm-text">
                        <div class="icn"></div>
                        <div class="text">
                            <h3>@simpleText($doc, text_2_title)</h3>
                            @richText($doc, text_2_desc)
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-3">
            <div class="wrapper">
                <div class="container-text">
                    <div class="container-cm-text">
                        <div class="icn"></div>
                        <div class="text">
                            <h3>@simpleText($doc, text_3_title)</h3>
                            @richText($doc, text_3_desc)
                        </div>
                    </div>
                </div>
                <div class="container-quote">
                    <img class="obj" src="{{ asset('img/business/icn-quote.svg') }}">
                    <div class="quote">
                        @richText($doc, quote_text)
                    </div>
                    <div class="name">
                        @simpleText($doc, quote_author)
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

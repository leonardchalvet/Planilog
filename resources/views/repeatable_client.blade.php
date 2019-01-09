<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base', ['doc' => $doc])

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/businesscase-template.css'))
@section('header_class', '')

@section('content')

    <main>

        <section id="section-pres">
            <img class="shape" src="{{asset('img/home/sectionCover/shape.svg') }}">
            <div class="wrapper">
                <h2>@simpleText($doc, case_title)</h2>
                <h1>@simpleText($doc, case_business)</h1>
                @richText($doc, case_desc)
                <a class="btn"
                   href="@linkSrc($doc, case_button_link)"
                        @linkTarget($doc, case_button_link)>
								<span class="btn-text">
									@simpleText($doc, case_button)
								</span>
                    <img class="btn-arrow" src="{{ asset('img/business/arrow.svg') }}">
                </a>
            </div>
        </section>

        <section id="section-el">
            <div class="wrapper">
                <div class="container-el">

                    @foreach ($doc->body as $slice)

                        @switch($slice->slice_type)

                            @case("text_img")
                            <div class="el">
                                <div class="container-text">
                                    @richText($slice->primary, text)
                                </div>
                                <div class="container-obj">
                                    <div class="obj-img" style="background-image: url(@imageSrc($slice->primary, img)">
                                    </div>
                                </div>
                            </div>
                            @break

                            @case("text_kpis")
                            <div class="el">
                                <div class="container-text">
                                    @richText($slice->primary, text)
                                </div>
                                <div class="container-obj">
                                    <div class="obj-num">
                                        <div class="container-el">
                                            @foreach ($slice->items as $kpi)
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
                                </div>
                            </div>
                            @break


                            @case("text_quote")
                            <div class="el">
                                <div class="container-text">
                                    @richText($slice->primary, text)
                                </div>
                                <div class="container-obj">
                                    <div class="obj-quote">
                                        <img src="{{asset('img/business/icn-quote.svg') }}">
                                        <div class="quote">
                                            @richText($slice->primary, quote_text)
                                        </div>
                                        <div class="name">
                                            @simpleText($slice->primary, quote_author)
                                        </div>
                                        <div class="post">
                                            @richText($slice->primary, quote_desc)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @break

                        @endswitch

                    @endforeach

                </div>
            </div>
        </section>

    </main>


@endsection


@section('js')
    <script src="{{ asset("js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("js/header.js") }}"></script>
@endsection

<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base')

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/home.css'))
@section('header_class', '')

@section('content')

    <main>

        <section id="section-cover">

            <img class="shape" src="{{ asset('img/home/sectionCover/shape.svg') }}">
            <div class="wrapper">
                <div class="container-cover">
                    <div class="container-text">
                        <h1>
                            @simpleText($doc, cover_title)
                        </h1>
                        @richText($doc, cover_paragraph)
                        <a class="btn signup-button">
                            <span class="btn-text">@simpleText($doc, cover_button_text)</span>
                            <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                        </a>
                    </div>
                    <div class="container-illu">
                        <img class="background" src="@imageSrc($doc, cover_img)">
                    </div>
                </div>
                <div class="container-logo">
                    @foreach ($doc->cover_list_logos as $logo)
                        <img src="@imageSrc($logo, cover_logo)">
                    @endforeach
                </div>
            </div>
        </section>

        <section id="section-ftr">
            <div class="wrapper">
                <div class="container-text">
                    <div class="title">
                        <img class="icn" src="{{ asset('img/home/sectionFtr/icn-title.svg') }}">
                        <h2>
                            @simpleText($doc, section_ftr_title)
                        </h2>
                    </div>
                    @richText($doc, section_ftr_paragraph)
                </div>
                <?php $video_id = 1; ?>
                <div class="container-ftr">
                    <div class="container-el">
                        @foreach ($doc->section_ftr_container_el as $outil)
                            <div class="el active" data-video="video-<?= $video_id++ ?>">
                                <div class="head">
                                    <div class="icn">
                                        <img src="@imageSrc($outil, section_ftr_el_icon)">
                                        <img src="@imageSrc($outil, section_ftr_el_icon_nw)">
                                    </div>
                                    <h3>
                                        @simpleText($outil, section_ftr_el_title)
                                    </h3>
                                </div>
                                <div class="text">
                                    @richText($outil, section_ftr_el_paragraph)
                                    <a class="btn"
                                       href="@linkSrc($outil, section_ftr_el_link)"
                                       @linkTarget($outil, section_ftr_el_link)>
                                        <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <?php $video_id = 1; ?>
                    <div class="container-video">
                        @foreach ($doc->section_ftr_container_el as $outil)
                            <div class="video video-<?= $video_id++ ?>">
                                <iframe src="https://player.vimeo.com/video/@simpleText($outil, section_ftr_el_video)?api=1&background=1&mute=0"
                                        frameborder="0"
                                        webkitallowfullscreen
                                        mozallowfullscreen
                                        allowfullscreen></iframe>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section id="section-modules">
            <div class="wrapper">
                <div class="container-text">
                    <img class="icn" src="{{ asset('img/home/sectionModules/icn-title.svg') }}">
                    <h2>@simpleText($doc, section_modules_title)</h2>
                    @richText($doc, section_modules_paragraph)
                </div>
                <div class="container-el">
                    @foreach ($doc->section_modules_container_el as $module)
                        <div class="el">
                            <div class="icn">
                                <img src="@imageSrc($module, section_modules_el_icon)">
                            </div>
                            <h3>@simpleText($module, section_modules_el_title)</h3>
                            @richText($module, section_modules_el_paragraph)
                            <a class="btn"
                               href="@linkSrc($module, section_modules_el_button_link)"
                               @linkTarget($module, section_modules_el_button_link)>
                                <div class="btn-text">@simpleText($module, section_modules_el_button_text)</div>
                                <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <img class="obj" src="{{ asset('img/home/sectionModules/shape.svg') }}">
        </section>

        <section id="section-resultats">
            <div class="wrapper">
                <div class="container-text">
                    <div class="container-rsm">
                        <img class="icn" src="{{ asset('img/home/sectionResultats/icn-title.svg') }}">
                        <h2>
                            @simpleText($doc, section_resultats_title)
                        </h2>
                        @richText($doc, section_resultats_paragraph)
                    </div>
                    <div class="container-el">
                        @foreach ($doc->section_resultats_container_el as $el)
                            <div class="el">
                                <div class="container-num">
                                    <div class="num">
                                        @simpleText($el, section_resultats_el_num)
                                    </div>
                                    <div class="obj">
                                        @simpleText($el, section_resultats_el_obj)
                                    </div>
                                </div>
                                @richText($el, section_resultats_el_paragraph)
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="container-illu" style="background-image: url(@imageSrc($doc, section_resultats_img)"></div>
            </div>
        </section>

        <section id="section-apprentissage">
            <div class="wrapper">
                <div class="container-title">
                    <img class="icn" src="{{ asset('img/home/sectionApprentissage/icn-title.svg') }}">
                    <h2>
                        @simpleText($doc, section_apprentissage_title)
                    </h2>
                    <a class="btn"
                       href="@linkSrc($doc, section_apprentissage_button_link)"
                       @linkTarget($doc, section_apprentissage_button_link)>
                        <div class="btn-text">@simpleText($doc, section_apprentissage_button_text)</div>
                        <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                    </a>
                </div>
                <div class="container-text">
                    @richText($doc, section_apprentissage_paragraph)
                </div>
            </div>
        </section>

        <section id="section-quotes">
            <div class="obj">
                <div class="text">
                    @simpleText($doc, section_quotes_title)
                </div>
            </div>
            <div class="background"></div>
            <div class="wrapper">
                <div class="container-el">
                    <?php $i = 1; ?>
                    @foreach ($doc->section_quotes_container_el as $quote)
                        <div class="el" data-step="step-<?= $i++ ?>">
                            <div class="head">
                                <div class="container-logo">
                                    <img src="@imageSrc($quote, section_quotes_el_img)">
                                </div>
                                <div class="cdr">
                                    <div class="name">@simpleText($quote, section_quotes_el_name)</div>
                                    <div class="job">
                                        @simpleText($quote, section_quotes_el_job)
                                        <br>
                                        @simpleText($quote, section_quotes_el_place)
                                    </div>
                                </div>
                            </div>

                            <div class="container-quote">
                                @richText($quote, section_quotes_el_paragraph, q)
                            </div>
                            @if (!empty($quote->section_quotes_el_link))
                            <a href="@linkSrc($quote, section_quotes_el_target)"
                               class="prout" style="color: white"
                               @linkTarget($quote, section_quotes_el_target)>
                                @simpleText($quote, section_quotes_el_link)
                            </a>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="container-step">
                    <?php $i = 1; ?>
                    @foreach ($doc->section_quotes_container_el as $quote)
                        <div class="step step-<?= $i++ ?>"></div>
                    @endforeach
                </div>

                <div class="container-nav">
                    <div class="nav">
                        <img src="{{ asset('img/common/arrow-black.svg') }}">
                    </div>
                    <div class="nav">
                        <img src="{{ asset('img/common/arrow-black.svg') }}">
                    </div>
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
    <script src="{{ asset("js/index.js") }}"></script>
@endsection

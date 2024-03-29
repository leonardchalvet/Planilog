<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base')

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/contact-commercial.css'))
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
                    <a class="btn" href="tel:<?= preg_replace('/[^0-9\+]/', '', $doc->cover_support_tel) ?>">
                        <img src="{{ asset('img/contact-commercial/icn-phone.svg') }}">
                        <div class="btn-text">
                            @simpleText($doc, cover_support_tel)
                        </div>
                    </a>
                    <p class="hr">@simpleText($doc, cover_support_time)</p>
                    @richText($doc, cover_assistance, link)
                </div>
                <form class="ajaxForm" method="post" action="{{ route('page_contact_commercial') }}">
                    @csrf
                    <input type="hidden" name="subject" value="contact">
                    <div class="container-input">
                        <div class="input">
                            <div class="title">@simpleText($doc, field_name)</div>
                            <input type="text" name="name" required>
                        </div>
                        <div class="input">
                            <div class="title">@simpleText($doc, field_email)</div>
                            <input type="email" name="email" required>
                        </div>
                        <div class="input">
                            <div class="title">@simpleText($doc, field_tel)</div>
                            <input type="tel" name="tel" required>
                        </div>
                        <div class="input">
                            <div class="title">@simpleText($doc, field_com)</div>
                            <input type="text" name="societe" required>
                        </div>
                        <div class="textarea">
                            <div class="title">@simpleText($doc, field_question)</div>
                            <textarea name="question"></textarea>
                        </div>
                    </div>
                    <div class="container-rcl">
                        <div class="title">@simpleText($doc, label_contact)</div>
                        <div class="container-radio">
                            <input id="input-radio" name="contact-type" type="hidden">
                            <div class="radio" data-radio="e-mail">
                                <div class="content">
                                    <div class="btn-radio">
                                        <div class="rd"></div>
                                    </div>
                                    <div class="text">@simpleText($doc, field_contact_email)</div>
                                </div>
                            </div>
                            <div class="radio" data-radio="téléphone">
                                <div class="content">
                                    <div class="btn-radio">
                                        <div class="rd"></div>
                                    </div>
                                    <div class="text">@simpleText($doc, field_contact_tel)</div>
                                </div>
                                <div class="container-checkbox">
                                    <input id="input-checkbox" name="contact-time" type="hidden">
                                    <div class="checkbox" data-checkbox="matin">
                                        <div class="checkbox-btn">
                                            <img src="{{ asset('img/contact-commercial/check.svg') }}">
                                        </div>
                                        <div class="text">@simpleText($doc, field_contact_tel_am)</div>
                                    </div>
                                    <div class="checkbox" data-checkbox="après-midi">
                                        <div class="checkbox-btn">
                                            <img src="{{ asset('img/contact-commercial/check.svg') }}">
                                        </div>
                                        <div class="text">@simpleText($doc, field_contact_tel_pm)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button>
                            <span class="btn-text">ENVOYER</span>
                            <img class="btn-check" src="{{ asset('img/common/check.svg') }}">
                        </button>
                    </div>

                </form>

            </div>
        </section>

    </main>

@endsection


@section('js')
    <script src="{{ asset("js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("js/header.js") }}"></script>
    <script src="{{ asset("js/contact-commercial.js") }}"></script>
@endsection

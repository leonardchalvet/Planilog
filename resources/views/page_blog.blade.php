<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base')

@section('title', $doc->seo_page_title)
@section('description', $doc->seo_page_description)
@section('og_title', $doc->seo_og_title ?? $doc->seo_page_title)
@section('og_description', $doc->seo_og_description ?? $doc->seo_page_description)
@section('og_image', property_exists($doc->seo_og_image, 'url') ? $doc->seo_og_image->url : "")

@section('style', asset('css/blog.css'))
@section('header_class', '')
@section('container_title', 'Blog')

@section('content')
    
    <main>

        <section id="section-blog">
            <img class="shape" src="{{ asset('img/home/sectionCover/shape.svg') }}">
            <div class="wrapper">
                <div class="container-filter">
                    <a href="{{ route('page_blog') }}"
                       class="filter"
                       style="text-decoration: none"
                       data-category="all">
                        @simpleText($doc, category_all)
                    </a>
                    @foreach($doc->categories as $category)
                        <a href="{{ route('page_blog') }}?c=@simpleText($category, name)"
                           class="filter"
                           style="text-decoration: none"
                           data-category="@simpleText($category, name)">
                            @simpleText($category, name)
                        </a>
                    @endforeach
                </div>

                <div class="container-el">
                    {{-- To load first posts directly with the page --}}
                    {!! App::make('App\Http\Controllers\PrismicController')->listPosts(Request::instance()) !!}
                </div>

                <div class="container-more" id="nextButton" data-page="1" data-category="{{ Request::get('c', 'all') }}">
                    <a class="btn">
                        <div class="btn-text">@simpleText($doc, more_link)</div>
                        <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
                    </a>
                </div>
            </div>
        </section>

    </main>

@endsection


@section('js')
    <script src="{{ asset("js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("js/header.js") }}"></script>
    <script>
        var posts_url="{{ route('list_posts') }}";
        var gogo=true;
    </script>
    <script src="{{ asset("js/blog2.js") }}"></script>
@endsection

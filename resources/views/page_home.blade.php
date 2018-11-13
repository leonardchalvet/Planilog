<?php
use Prismic\Dom\RichText;
?>

@extends('layouts.base')

@section('title', $doc->seo_page_title->value)
@section('description', $doc->seo_page_description->value)
@section('bodyclass', 'home')

@section('content')

    [CONTENT]

@endsection

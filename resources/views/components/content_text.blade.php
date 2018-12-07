<?php
use Prismic\Dom\RichText;
?>

@switch($slice->slice_type)

    @case("texte")
    @richText($slice->primary, texte)
    @break

    @case("citation")
    <div class="container-quote">
        <img class="obj" src="{{ asset('img/business/icn-quote.svg') }}">
        <p>@simpleText($slice->primary, quote)</p>
        <div class="name">@simpleText($slice->primary, author)</div>
    </div>
    @break

    @case("bouton")
    <button>
        <a href="@linkSrc($slice->primary, link)" @linkTarget($slice->primary, link)>
            <span class="btn-text">@simpleText($slice->primary, button)</span>
            <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
        </a>
    </button>
    @break

    @case("youtube")
    <iframe src="https://www.youtube.com/embed/@simpleText($slice->primary, youtube_video_id)"
            frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
    </iframe>
    @break

    @case("notification")
    <div class="notif @simpleText($slice->primary, type)">
        @if ($slice->primary->type == "warning")
            <img class="icn" src="{{ asset('img/common/notif-warning.svg') }}">
        @else
            <img class="icn" src="{{ asset('img/common/notif-info.svg') }}">
        @endif
        @richText($slice->primary, message)
    </div>
    @break

@endswitch

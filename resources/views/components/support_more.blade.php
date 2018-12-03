<?php
use Prismic\Dom\RichText;
?>
<section id="section-banner">
    <div class="wrapper">
        <h2>
            {{ $text }}
        </h2>
        <a class="btn" href="mailto:{{ $mail }}">
            <span class="btn-text">{{ $button }}</span>
            <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
        </a>
    </div>
</section>

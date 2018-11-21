<?php
use Prismic\Dom\RichText;
?>

<section id="section-start">
    <div class="wrapper">
        <h2>@simpleText($footer_cta, footer_cta_title)</h2>
        @richText($footer_cta, footer_cta_paragraph)
        <a class="btn" href="@linkSrc($footer_cta, footer_cta_button_link)">
			<span class="btn-text">
				@simpleText($footer_cta, footer_cta_button_text)
			</span>
            <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
        </a>
        <div class="text">
            @richText($footer_cta, footer_cta_contact_paragraph)
        </div>
    </div>
    <img class="laptop" src="{{ asset('img/common/start-laptop.png') }}">
</section>

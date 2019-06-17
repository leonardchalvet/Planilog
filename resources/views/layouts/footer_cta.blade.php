<?php
use Prismic\Dom\RichText;
?>

<section id="section-start">
    <div class="wrapper">
        <h2>@simpleText($footer_cta, footer_cta_title)</h2>
        @richText($footer_cta, footer_cta_paragraph)
        <a class="btn clearbit-overlay" data-form-id="90f550a2-09f6-4dc3-8179-c5fc5563f4e5" data-theme="default"
           href="@linkSrc($header, header_menu_essai_link)"
                @linkTarget($header, header_menu_login_link)>
			<span class="btn-text">
				@simpleText($footer_cta, footer_cta_button_text)
			</span>
            <img class="btn-arrow" src="{{ asset('img/common/arrow-white.svg') }}">
        </a>
        <div class="text clearbit-overlay" data-form-id="62740498-591d-48e4-a3d6-d644ad545524" data-theme="default">
            @richText($footer_cta, footer_cta_contact_paragraph)
        </div>
    </div>
    <img class="laptop" src="{{ asset('img/common/start-laptop.png') }}">
</section>

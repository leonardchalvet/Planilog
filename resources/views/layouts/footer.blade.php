<?php
use Prismic\Dom\RichText;
?>

<footer>
    <div class="wrapper">
        <div class="logo">
            <a href="{{ route('page_home') }}">
                <img src="@imageSrc($footer, footer_logo)">
            </a>
        </div>
        <div class="container-ul">
            <ul>
                <li>@simpleText($footer, footer_menu_outils)</li>
                @foreach($footer->footer_outils_container_el as $el)
                    <li>
                        <a href="@linkSrc($el, footer_outils_el_link)" @linkTarget($el, footer_outils_el_link)>
                            @simpleText($el, footer_outils_el_title)
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul>
                <li>@simpleText($footer, footer_menu_domaines)</li>
                @foreach($footer->footer_domaines_container_el as $el)
                    <li>
                        <a href="@linkSrc($el, footer_domaines_el_link)" @linkTarget($el, footer_domaines_el_link)>
                            @simpleText($el, footer_domaines_el_title)
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul>
                <li>@simpleText($footer, footer_menu_company)</li>
                @foreach($footer->footer_company_container_el as $el)
                    <li>
                        <a href="@linkSrc($el, footer_company_el_link)" @linkTarget($el, footer_company_el_link)>
                            @simpleText($el, footer_company_el_title)
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul>
                <li>@simpleText($footer, footer_menu_contact)</li>
                <li>
                    <div class="container-contact">
                        <div class="pp" style="background-image: url(@imageSrc($footer, footer_menu_contact_image))"></div>
                        <div class="text">
                            @richText($footer, footer_menu_contact_paragraph)
                            <a href="mailto:@simpleText($footer, footer_menu_contact_link)">
                                @simpleText($footer, footer_menu_contact_text)
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>


        <div class="foot">

            {{-- Language selector --}}
            <div class="container-lg">
                <div class="lg">
                    <span>{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                    <img src="{{ asset('img/common/arrow-blue.svg') }}">
                </div>
                <div class="dropdown">
                    @foreach($alternateLangResolver->getAlternateLang($doc->alternate_languages) as $alt)
                        <a class="ch-lg" href="{{ $alt["url"] }}">
                            {{ $alt["locale_name"] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="cpr">
                © 2018 Planilog All rights reserved
            </div>
            <div class="container-rs">
                @foreach($footer->footer_social_medias as $el)
                    <a class="rs" href="@linkSrc($el, social_link)" @linkTarget($el, social_link)>
                        <img src="@imageSrc($el, social_icon)">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>

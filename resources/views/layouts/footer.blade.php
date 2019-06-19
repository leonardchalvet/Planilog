<?php
use Prismic\Dom\RichText;
?>

<footer>
    <div class="wrapper">
        <div class="logo">
            <a href="{{ route('page_home') }}" class="logo">
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
                            <a class="clearbit-overlay" data-form-id="62740498-591d-48e4-a3d6-d644ad545524" data-theme="default">
                                @simpleText($footer, footer_menu_contact_text)
                            </a>
                        </div>
                    </div>
                    <div class="container-tel">
                        <img src="{{ asset('img/common/icn-phone-red.svg') }}">
                        <a href="tel:@simpleText($footer, footer_menu_contact_tel)">
                            @simpleText($footer, footer_menu_contact_tel)
                        </a>
                    </div>
                </li>
            </ul>
        </div>


        <div class="foot">

            {{-- Language selector --}}
            <div class="container-lg">
                <div class="lg">
                    <span style="text-transform: capitalize">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                    <img src="{{ asset('img/common/arrow-blue.svg') }}">
                </div>
                <div class="dropdown">
                    @foreach($alternateLangResolver->getAlternateLang($doc->alternate_languages) as $alt)
                        <a class="ch-lg logo"
                           href="{{ $alt["url"] }}"
                           style="text-transform: capitalize">
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

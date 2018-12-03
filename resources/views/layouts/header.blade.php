<?php
use Prismic\Dom\RichText;
?>

<header id="header-desktop">
    <div class="wrapper">
        <a class="logo @yield('header_class')" href="{{ route('page_home') }}">
            <img src="@imageSrc($header, header_logo)">
        </a>
    </div>

    <div class="container-head">
        <ul class="container-link">
            <li class="li-dropdown li-dropdown-1">
                <div class="container-text">
                    <div class="title">@simpleText($header, header_menu_outils)</div>
                    <img class="arrow" src="{{ asset('img/common/arrow-red.svg') }}">
                </div>
                <div class="dropdown">
                    <div class="content">
                        <div class="container-el">
                            @foreach($header->header_outils_container_el as $outil)
                                <a class="el"
                                   href="@linkSrc($outil, header_outils_el_link)"
                                   @linkTarget($outil, header_outils_el_link)>
                                    <img class="icn" src="@imageSrc($outil, header_outils_el_icon)">
                                    <div class="text">
                                        <h3>@simpleText($outil, header_outils_el_title)</h3>
                                        @richText($outil, header_outils_el_paragraph)
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </li>
            <li class="li-dropdown li-dropdown-2">
                <div class="container-text">
                    <div class="title">@simpleText($header, header_menu_modules)</div>
                    <img class="arrow" src="{{ asset('img/common/arrow-red.svg') }}">
                </div>
                <div class="dropdown">
                    <div class="content">
                        <div class="container-el">
                            @foreach($header->header_modules_container_el as $module)
                            <a class="el"
                               href="@linkSrc($module, header_modules_el_button_link)"
                               @linkTarget($module, header_modules_el_button_link)>
                                <img class="icn" src="@imageSrc($module, header_modules_el_icon)">
                                <div class="text">
                                    <h3>@simpleText($module, header_modules_el_title)</h3>
                                    @richText($module, header_modules_el_paragraph)
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="container-text">
                    <a class="title"
                       href="@linkSrc($header, header_menu_tarifs_link)"
                       @linkTarget($header, header_menu_tarifs_link)>
                    @simpleText($header, header_menu_tarifs)
                    </a>
                </div>
            </li>
            <li>
                <div class="container-text">
                    <a class="title"
                       href="@linkSrc($header, header_menu_contact_link)"
                       @linkTarget($header, header_menu_contact_link)>
                        @simpleText($header, header_menu_contact)
                    </a>
                </div>
            </li>
        </ul>
        <div class="container-action">
            <a class="signin"
               href="@linkSrc($header, header_menu_login_link)"
                    @linkTarget($header, header_menu_login_link)>
                @simpleText($header, header_menu_login)
            </a>
            <a class="signup">
				<span class="text">
					@simpleText($header, header_menu_essai)
				</span>
            </a>
        </div>
    </div>
</header>

<div id="lightbox-subscribe">

    <div class="background"></div>

    <div class="container-subscribe">
        <div class="container-form">
            <h2>
                @simpleText($header, form_title)
            </h2>
            <form action="{{ route('inscription') }}" method="post">
                @csrf
                <div class="container-input">
                    <div class="input">
                        <div class="title">@simpleText($header, form_name)</div>
                        <input type="text" name="lastname">
                    </div>
                    <div class="input">
                        <div class="title">@simpleText($header, form_name2)</div>
                        <input type="text" name="firstname">
                    </div>
                    <div class="input">
                        <div class="title">@simpleText($header, form_email)*</div>
                        <input type="email" name="email" required>
                    </div>
                    <div class="input">
                        <div class="title">@simpleText($header, form_tel)</div>
                        <input type="tel" name="tel">
                    </div>
                </div>
                @richText($header, form_cgu)
                <button>
					<span class="btn-text">
						@simpleText($header, form_button)
					</span>
                </button>
            </form>
        </div>
        <div class="container-desc">
            <div class="close">
                <img src="{{ asset('img/common/icn-cross.svg') }}">
            </div>
            <div class="icn">
                <img src="{{ asset('img/common/icn-subscribe.svg') }}">
            </div>
            @richText($header, form_desc)
        </div>
    </div>

</div>

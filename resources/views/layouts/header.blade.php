<?php
use Prismic\Dom\RichText;
?>

<header id="header-desktop" class="@yield('header_class')">
    <div class="wrapper">
        <a class="logo" href="{{ route('page_home') }}">
            <img src="@imageSrc($header, header_logo)">
            <img src="@imageSrc($header, header_logo_white)">
        </a>
        @hasSection('container_title')
            <a class='container-titlePage' href="@yield('container_link')">@yield('container_title')</a>
        @endif
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
                       href="{{ route('page_tarifs') }}">
                    @simpleText($header, header_menu_tarifs)
                    </a>
                </div>
            </li>
            <li>
                <div class="container-text">
                    <a class="title"
                       href="{{ route('page_contact_commercial') }}">
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
            <a class="signup signup-button">
				<span class="text">
					@simpleText($header, header_menu_essai)
				</span>
            </a>
        </div>
    </div>
</header>


<header id="header-mobile" class="@yield('header_class')">
    <div class="head">
        <div class="wrapper">
            <a class="logo" href="{{ route('page_home') }}">
                <img src="@imageSrc($header, header_logo)">
                <img src="@imageSrc($header, header_logo_white)">
            </a>
            <div class="container-action">
                <div class="container-text">
                    <div class="text open">MENU</div>
                    <div class="text close">FERMER</div>
                </div>
                <div class="container-burger">
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="container-link">
        <div class="wrapper">
            <div class="list-link">
                <div class="link">
                    <a>
                        <span>@simpleText($header, header_menu_outils)</span>
                        <img class="arrow" src="{{ asset('img/common/arrow-red.svg') }}">
                    </a>
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
                <div class="link">
                    <a>
                        <span>@simpleText($header, header_menu_modules)</span>
                        <img class="arrow" src="{{ asset('img/common/arrow-red.svg') }}">
                    </a>
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
                <div class="link">
                    <a href="@linkSrc($header, header_menu_tarifs_link)"
                            @linkTarget($header, header_menu_tarifs_link)>
                        <span>@simpleText($header, header_menu_tarifs)</span>
                    </a>
                </div>
                <div class="link">
                    <a href="@linkSrc($header, header_menu_contact_link)"
                            @linkTarget($header, header_menu_contact_link)>
                        <span>@simpleText($header, header_menu_contact)</span>
                    </a>
                </div>
            </div>
            <div class="container-action">
                <a class="signin" href="@linkSrc($header, header_menu_login_link)"
                        @linkTarget($header, header_menu_login_link)>
                    <span>@simpleText($header, header_menu_login)</span>
                </a>
                <a class="signup signup-button">
                    @simpleText($header, header_menu_essai)
                </a>
            </div>
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
            <form class="ajaxForm" action="{{ route('inscription') }}" method="post">
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
                    <img class="btn-check" src="{{ asset('img/common/check.svg') }}">
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

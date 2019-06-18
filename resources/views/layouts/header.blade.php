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
            <li class="li-dropdown li-dropdown-3">
                <div class="container-text">
                    <div class="title">Centre d’aide</div>
                    <img class="arrow" src="img/common/arrow-red.svg" alt="">
                </div>
                <div class="dropdown">
                    <div class="content">
                        <div class="container-el">
                            <a class="el" href="#">
                                <img class="icn" src="img/common/icn-compte.svg" alt="">
                                <div class="text">
                                    <h3>Comptes et paramêtres</h3>
                                    <p>
                                        Présentation de votre compte administrateur Planilog, de la gestion des droits d’accès à la personnalisation de l’interface utilisateur.
                                    </p>
                                </div>
                            </a>
                            <a class="el" href="#">
                                <img class="icn" src="img/common/icn-demarrage.svg" alt="">
                                <div class="text">
                                    <h3>Démarrage rapide</h3>
                                    <p>
                                        Guide de démarrage conçue pour vous accompagner dans la prise en main de votre outil de planification GANTT. Disponible dès la version d’essai gratuit.   
                                    </p>
                                </div>
                            </a>
                            <a class="el" href="#">
                                <img class="icn" src="img/common/icn-configuration.svg" alt="">
                                <div class="text">
                                    <h3>Configuration de Planilog</h3>
                                    <p>
                                        Découvrez l’ensemble des options de configuration disponibles à partir de votre compte utilisateur.   
                                    </p>
                                </div>
                            </a>
                            <a class="el" href="#">
                                <img class="icn" src="img/common/icn-connect.svg" alt="">
                                <div class="text">
                                    <h3>Planilog Connect</h3>
                                    <p>
                                        Tout ce dont vous avez besoin de savoir à propos de l’importation, l’exportation et la migration de données.         
                                    </p>
                                </div>
                            </a>
                            <a class="el" href="#">
                                <img class="icn" src="img/common/icn-premium.svg" alt="">
                                <div class="text">
                                    <h3>Fonctions premium</h3>
                                    <p>
                                        Découvrez l’ensemble des options de configuration disponibles à partir de votre compte utilisateur.        
                                    </p>
                                </div>
                            </a>
                            <a class="el" href="#">
                                <img class="icn" src="img/common/icn-facturation.svg" alt="">
                                <div class="text">
                                    <h3>Facturation et abonnement</h3>
                                    <p>
                                        Tout ce dont vous avez besoin de savoir à propos de l’importation, l’exportation et la migration de données.              
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="container-action">
            <a class="signin"
               href="@linkSrc($header, header_menu_login_link)"
                    @linkTarget($header, header_menu_login_link)>
                @simpleText($header, header_menu_login)
            </a>
            <a class="signup clearbit-overlay" data-form-id="90f550a2-09f6-4dc3-8179-c5fc5563f4e5" data-theme="default"
                    @linkTarget($header, header_menu_login_link)>
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
                <a class="signup clearbit-overlay" data-form-id="90f550a2-09f6-4dc3-8179-c5fc5563f4e5" data-theme="default">
                    @simpleText($header, header_menu_essai)
                </a>
            </div>
        </div>
    </div>
</header>

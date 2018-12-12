<?php
use Prismic\Dom\RichText;
?>

@if ($header->banner_status == "actif")
<div id="banner" style="display: none">
    <div class="text">
        @richText($header, banner_message)
        <!-- <img src="{{ asset('img/common/arrow-white-2.svg') }}"> -->
    </div>
    <div class="cross">
        <img src="{{ asset('img/common/icn-cross.svg') }}">
    </div>
</div>


<script>
    $(window).on('load', function() {
        var s = Cookies.get('info_banner') || "on";
        var c = Cookies.get('cookies_policy') || "off";
        if (s === "on") {
            $("#banner").show();
            $("#header-desktop").addClass("banner-active");
            $("#header-mobile").addClass("banner-active");
        }
        $("#banner").on('click', '.cross', function() {
           if (c !== "off") {
               Cookies.set('info_banner', 'off');
           }
        });
    });
</script>
@endif

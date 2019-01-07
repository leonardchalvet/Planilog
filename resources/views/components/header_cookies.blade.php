<?php
use Prismic\Dom\RichText;
?>
<div id="cookies" style="display:none;">
    <div class="wrapper">
        <div class="text">
            @richText($header, cookies_message)
        </div>
        <a class="btn logo" href="{{ Request::url() }}" id="acceptCookiesButton">
            <span class="btn-text">@simpleText($header, cookies_button)</span>
        </a>
    </div>
</div>

<script>
    $(window).on('load', function() {
        var c = Cookies.get('cookies_policy') || "off";

        if (c === "off") {
            $("#cookies").show();
        }

        $("#cookies").on('click', '#acceptCookiesButton', function(e) {
            e.preventDefault();
            Cookies.set('cookies_policy', 'on');
        });
    });
</script>

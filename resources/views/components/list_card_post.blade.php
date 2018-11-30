<?php
use Prismic\Dom\richText;
if (LaravelLocalization::getCurrentLocale() == "fr") {
    setlocale(LC_TIME, 'fr_FR');
} else {
    setlocale(LC_TIME, 'en_US');
}
?>
@foreach($posts as $post)
    @include('components.card_post', ['post', $post])
@endforeach
<?php setlocale(LC_TIME, ''); // reset locale ?>

<div style="display: none"
     class="paginator"
     data-next="{{ $next }}">
</div>

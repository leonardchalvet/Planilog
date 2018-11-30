<?php
use Prismic\Dom\richText;
$data = $post->data
?>
<div class="el">
    <div class="cover">
        <a href="{{ route('post', ['slug' => $post->uid]) }}"
           class="background"
           style="background-image: url(@imageSrc($data, post_image));">
        </a>
        @component('components.share_links')
            @slot('title')
                @simpleText($doc, post_title)
            @endslot
            @slot('url')
                {{ route('post', ['slug' => $post->uid]) }}
            @endslot
        @endcomponent
    </div>
    <div class="text">
        <div class="category"><?= implode(', ', $post->tags) ?></div>
        <h3>
            @simpleText($data, post_title)
        </h3>
        @richText($data, post_excerpt)
    </div>
    <div class="foot">
        <div class="author">@simpleText($data, post_author)</div>
        <div class="sep"></div>
        <?php
        $date = \Carbon\Carbon::parse($data->post_date);
        $date = $date->formatLocalized("%d %b %Y");
        ?>
        <div class="date"><?= $date ?></div>
    </div>
</div>
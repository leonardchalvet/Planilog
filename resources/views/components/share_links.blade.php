<div class="container-rs">
    <a class="rs-link"
       onclick="
               var el = document.createElement('input');
               el.value = '{{ $url }}';
               el.setAttribute('readonly', '');
               el.style.position = 'absolute';
               el.style.left = '-9999px';
               document.body.appendChild(el);
               el.select();
               document.execCommand('Copy');
               document.body.removeChild(el);
               return false;">
        <img src="{{ asset('img/blog/icn-hyperlink.svg') }}">
        <span class="dropdown">votre lien a été copié</span>
    </a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"
       onclick="window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
        <img src="{{ asset('img/blog/icn-facebook.svg') }}">
    </a>
    <a href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ $url }}"
       onclick="window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
        <img src="{{ asset('img/blog/icn-twitter.svg') }}">
    </a>
    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $url }}&title={{ $title }}"
       onclick="window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
        <img src="{{ asset('img/blog/icn-linkedin.svg') }}">
    </a>
</div>

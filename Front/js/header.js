$(window).on('load', function() {

    $window = $(window);

	$window.scroll(function() {
	    if ( $window.scrollTop() >= 1 ) {
	        $('#header-desktop').addClass('scroll');
	        $('#header-mobile').addClass('scroll');
	    } else {
	    	$('#header-desktop').removeClass('scroll');
	    	$('#header-mobile').removeClass('scroll');
	    };
	});

	$('#header-desktop .li-dropdown').click(function(){
		if ($(this).hasClass('show')) {
			$('#header-desktop .li-dropdown').removeClass('show');
			setTimeout(function() {
				$('#header-desktop .li-dropdown .dropdown').removeClass('displayBlock');
			}, 250);
		} else {
			$('#header-desktop .li-dropdown').removeClass('show');
			$('#header-desktop .li-dropdown .dropdown').removeClass('displayBlock');
			
			$(this).find('.dropdown').addClass('displayBlock').outerWidth();
			$(this).addClass('show');
		}
	})

	$('main').click(function(){
		$('#header-desktop .li-dropdown').removeClass('show');
		$('#header-desktop .li-dropdown .dropdown').removeClass('displayBlock');
	})

	$('#header-desktop .container-head .container-action .signup').click(function(){ openLightboxSubscribe(); })
	$('#header-mobile .container-link .container-action .signup').click(function(){ openLightboxSubscribe(); })

	function openLightboxSubscribe() {
		$('#lightbox-subscribe').addClass('displayBlock').outerWidth();
		$('#lightbox-subscribe').addClass('show').outerWidth();
	}

	$('#header-mobile .head .wrapper .container-action').click(function(){
		$('#header-mobile').toggleClass('open');
		$('body').toggleClass('block');
	})

	$('#header-mobile .container-link .wrapper .list-link .link').click(function(){
		$('#header-mobile .container-link .wrapper .list-link .link').removeClass('active');
		$(this).addClass('active');
	})

	$('#lightbox-subscribe .container-subscribe .container-desc .close').click(function(){
		$('#lightbox-subscribe').removeClass('displayBlock show');
	})

	$('#banner .cross').click(function(){
		$('#banner').addClass('hide');
		$('#header-desktop').removeClass('banner-active');
		$('#header-mobile').removeClass('banner-active');
	})

	$('#cookies .wrapper .btn').click(function(){
		$('#cookies').addClass('hide');
	})

	$('footer .foot .container-lg').click(function(){
		$(this).find('.dropdown').fadeToggle(250);
	})

	if (window.matchMedia("(max-width: 700px)").matches) {
		$('#cookies .wrapper .btn').insertAfter('#cookies .wrapper .text a');
	};
})
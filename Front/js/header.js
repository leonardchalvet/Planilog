$(window).on('load', function() {

    $window = $(window);

	$window.scroll(function() {
	    if ( $window.scrollTop() >= 1 ) {
	        $('#header-desktop').addClass('scroll');
	    } else {
	    	$('#header-desktop').removeClass('scroll');
	    };
	});

	$('#header-desktop .li-dropdown').click(function(){
		if ($(this).hasClass('show')) {
			$('#header-desktop .li-dropdown').removeClass('show');
			setTimeout(function() {
				$('#header-desktop .li-dropdown .dropdown').removeClass('displayBlock');
			}, 250);
		} else {
			$(this).find('.dropdown').addClass('displayBlock').outerWidth();
			$(this).addClass('show');
		}
		
	})

	$('#header-desktop .container-head .container-action .signup').click(function(){
		$('#lightbox-subscribe').addClass('displayBlock').outerWidth();
		$('#lightbox-subscribe').addClass('show').outerWidth();
	})

	$('#lightbox-subscribe .container-subscribe .container-desc .close').click(function(){
		$('#lightbox-subscribe').removeClass('displayBlock show');
	})

	$('#banner .cross').click(function(){
		$('#banner').addClass('hide');
		$('#header-desktop').removeClass('banner-active');
	})

	$('#cookies .wrapper .btn').click(function(){
		$('#cookies').addClass('hide');
	})
})
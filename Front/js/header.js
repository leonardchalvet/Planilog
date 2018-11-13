$(window).on('load', function() {

    $window = $(window);

	$window.scroll(function() {
	    if ( $window.scrollTop() >= 1 ) {
	        $('#header-desktop').addClass('scroll');
	    } else {
	    	$('#header-desktop').removeClass('scroll');
	    };
	});

	$('.li-dropdown').click(function(){
		if ($(this).hasClass('show')) {
			$('.li-dropdown').removeClass('show');
			setTimeout(function() {
				$('.li-dropdown .dropdown').removeClass('displayBlock');
			}, 250);
		} else {
			$(this).find('.dropdown').addClass('displayBlock').outerWidth();
			$(this).addClass('show');
		}
		
	})
})
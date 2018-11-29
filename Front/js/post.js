$(window).on('load', function() {

	$('.rs-link').click(function(){
		$(this).find('.dropdown').fadeIn(250);
		setTimeout(function() {
			$('.rs-link .dropdown').fadeOut(250);
		}, 3000);
	})

})
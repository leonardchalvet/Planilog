$(window).on('load', function() {

	$('.rs-link').click(function(){
		$('.rs-link .dropdown').fadeIn(250);
		setTimeout(function() {
			$('.rs-link .dropdown').fadeOut(250);
		}, 4000);
	})

})
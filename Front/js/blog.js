$(window).on('load', function() {
	$('#section-blog .container-filter .filter').click(function(){
		$('#section-blog .container-filter .filter').removeClass('active');
		$('#section-blog .container-el').removeClass('anim');
		$(this).addClass('active');
		setTimeout(function() {
			$('#section-blog .container-el').addClass('anim');
		}, 50);
	})

	$('#section-blog .container-filter .filter:nth-child(1)').click();
})
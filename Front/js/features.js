$(window).on('load', function() {

	var iframe = $('#section-cover iframe');
	var player = new Vimeo.Player(iframe);
	player.play();

})
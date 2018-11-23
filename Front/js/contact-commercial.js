$(window).on('load', function() {

	$('#section-contact form .container-rcl .container-radio .radio').click(function(){
		$('#section-contact form .container-rcl .container-radio .radio').removeClass('active');
		$(this).addClass('active');
	})

	$('#section-contact form .container-rcl .container-radio .radio .container-checkbox .checkbox').click(function(){
		$('#section-contact form .container-rcl .container-radio .radio .container-checkbox .checkbox').removeClass('active');
		$(this).addClass('active');
	})

})
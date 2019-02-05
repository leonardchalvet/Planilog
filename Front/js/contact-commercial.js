$(window).on('load', function() {

	$('#section-contact form .container-rcl .container-radio .radio').click(function(){
		var elval = $(this).data('radio');
		$('#input-radio').val(elval);
		$('#section-contact form .container-rcl .container-radio .radio').removeClass('active');
		$(this).addClass('active');
	})

	$('#section-contact form .container-rcl .container-radio .radio .container-checkbox .checkbox').click(function(){
		var elval = $(this).data('checkbox');
		$('#input-checkbox').val(elval);
		$('#section-contact form .container-rcl .container-radio .radio .container-checkbox .checkbox').removeClass('active');
		$(this).addClass('active');
	})

})



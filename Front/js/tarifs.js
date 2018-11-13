$(window).on('load', function() {

	$('#section-faq .container-li .li .container-el .el .title').click(function(){

		if ($(this).closest('.el').hasClass('active')) {
			$('#section-faq .container-li .li .container-el .el').removeClass('active');
			$(this).closest('.el').removeClass('active');

		} else {
			$('#section-faq .container-li .li .container-el .el').removeClass('active');
			$(this).closest('.el').addClass('active');
		}
	})
	
})
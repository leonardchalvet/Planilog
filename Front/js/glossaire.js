$(window).on('load', function() {

	if (window.matchMedia("(max-width: 700px)").matches) {

		$('#section-glossaire .wrapper .container-list .container-input').click(function(){
			$('#section-glossaire .wrapper .container-list .container-el').addClass('show');
		})

		$('body').on('click', function(event) { 
		    if (!$(event.target).closest('#section-glossaire .wrapper .container-list').length) {
				$('#section-glossaire .wrapper .container-list .container-el').removeClass('show');
		    }
		});

	}
})
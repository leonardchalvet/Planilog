$(window).on('load', function() {

	if (window.matchMedia("(min-width: 700px)").matches) {

		$('#section-blog .container-filter .filter').click(function(){
			if(!$(this).hasClass('active')) {
				$('#section-blog .container-filter .filter').removeClass('active');
				$('#section-blog .container-el').removeClass('anim');
				$(this).addClass('active');
				setTimeout(function() {
					$('#section-blog .container-el').addClass('anim');
				}, 50);
			}
		})

	}
	else {

		$('#section-blog .container-filter .filter').click(function(){
			if($(this).is(":first-child"))
				$(this).toggleClass('show');
		})

		$('#section-blog .container-filter .filter').click(function(){
			if(!$(this).hasClass('active')) {
				$('#section-blog .container-filter .filter').removeClass('active show');
				$('#section-blog .container-el').removeClass('anim');
				$(this).addClass('active');

				$('#section-blog .container-filter').prepend($(this));

				if($('#section-blog .container-filter .filter:first-child').text().trim() != "Tous") {
					$('#section-blog .container-filter .filter').each(function(){
						if($(this).text().trim() == "Tous") {
							$('#section-blog .container-filter .filter:nth-child(2)').before($(this));
						}
					})
				}

				setTimeout(function() {
					$('#section-blog .container-el').addClass('anim');
				}, 50);
			}
		})

		$('body').on('click', function(event) { 
		    if (!$(event.target).closest('#section-blog .container-filter').length) {
				$('#section-blog .container-filter .filter').removeClass('show');
		    }
		});

	}

	$('#section-blog .container-filter .filter:nth-child(1)').click();
})
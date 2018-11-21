$(window).on('load', function() {

	function sectionFtrCaroussel(Delay, Section, El, Video){
		
		El = Section + ' ' + El;
		Video = Section + ' ' + Video;

		var valDelay = 0;
		var numberEl = $(El).length;
		var countEl;
		
		var drtc;

		function prg(drtc){

			var elVideo = Video;

			if (drtc === 'next') {
				countEl++;
			} else if (drtc === 'prev') {
				countEl--;
			};

			if (countEl <= numberEl && countEl >= 1) {

				$(El).css({
				  '-webkit-transform' : 'translateY(0px)',
				  '-moz-transform'    : 'translateY(0px)',
				  '-ms-transform'     : 'translateY(0px)',
				  '-o-transform'      : 'translateY(0px)',
				  'transform'         : 'translateY(0px)'
				});

				$(El + '.active').removeClass('active');
				$(elVideo).hide().removeClass('active');
				$(elVideo + 'video').get(0);
				
				$(El + ':nth-child('+countEl+')').addClass('active');
				
				$(elVideo + '.' + $(El + '.active').data('video')).fadeIn(350).addClass('active');
				$(elVideo + '.active video').get(0).play();

				var transformDistance = $(El + '.active .text').height()/2;

				$(El + '.active').nextAll().css({
				  '-webkit-transform' : 'translateY(' + transformDistance + 'px' + ')',
				  '-moz-transform'    : 'translateY(' + transformDistance + 'px' + ')',
				  '-ms-transform'     : 'translateY(' + transformDistance + 'px' + ')',
				  '-o-transform'      : 'translateY(' + transformDistance + 'px' + ')',
				  'transform'         : 'translateY(' + transformDistance + 'px' + ')'
				});
				$(El + '.active').css({
				  '-webkit-transform' : 'translateY(-' + transformDistance + 'px' + ')',
				  '-moz-transform'    : 'translateY(-' + transformDistance + 'px' + ')',
				  '-ms-transform'     : 'translateY(-' + transformDistance + 'px' + ')',
				  '-o-transform'      : 'translateY(-' + transformDistance + 'px' + ')',
				  'transform'         : 'translateY(-' + transformDistance + 'px' + ')'
				});
				$(El + '.active').prevAll().css({
				  '-webkit-transform' : 'translateY(-' + transformDistance + 'px' + ')',
				  '-moz-transform'    : 'translateY(-' + transformDistance + 'px' + ')',
				  '-ms-transform'     : 'translateY(-' + transformDistance + 'px' + ')',
				  '-o-transform'      : 'translateY(-' + transformDistance + 'px' + ')',
				  'transform'         : 'translateY(-' + transformDistance + 'px' + ')'
				});


				clearInterval(interval);
				interval = setInterval(function() {
			      prg('next');
			    }, valDelay);

			} else if (countEl < 1) {
				countEl = numberEl;
				prg();
			} else {
				countEl = 1;
				prg();
			};
			
		};

		function init(){	    
			$(El + ':nth-child(1)').addClass('active');
			$(Video + ':nth-child(1)').addClass('active');
		};

		init();

		$(El).click(function(){
			var index = $(this).index() + 1;
			countEl=index;
			prg();
			
		})

		var interval = setInterval(function() {
	    	prg('next');
	    }, valDelay);

	    valDelay = Delay;

	};

	sectionFtrCaroussel(
		10000,
		'#section-ftr',  
		".container-el .el", 
		".container-video .video"
	);

	

	function sectionQuotesCaroussel(Delay, Section, El, Step, Nav){

		El = Section + ' ' + El;
		Step = Section + ' ' + Step;
		Nav = Section + ' ' + Nav;

		var valDelay = 0;
		var numberEl = $(El).length;
		var countEl;
		
		var drtc;

		function prg(drtc){

			var elStep = Step;

			if (drtc === 'next') {
				countEl++;
			} else if (drtc === 'prev') {
				countEl--;
			};

			if (countEl <= numberEl && countEl >= 1) {
				$(El + '.active').removeClass('active').hide();

				$(elStep + '.active').removeClass('active');
				
				$(El + ':nth-child('+countEl+')').show();
				setTimeout(function() {
					$(El + ':nth-child('+countEl+')').addClass('active');
					$('.' + $(El + '.active').data('step')).addClass('active');
				}, 50);

				clearInterval(interval);
				interval = setInterval(function() {
			      prg('next');
			    }, valDelay);
			} else if (countEl < 1) {
				countEl = numberEl;
				prg();
			} else {
				countEl = 1;
				prg();
			};
			
		};

		function init(){	    
			$(El + ':nth-child(1)').show().addClass('active');
			$(Step + ':nth-child(1)').addClass('active');
		};

		$(Nav + ':nth-child(1)').click(function(){
			clearInterval(interval);
			prg('next');
		})
		$(Nav + ':nth-child(2)').click(function(){
			clearInterval(interval);
			prg('prev');
		})

		init();

		var interval = setInterval(function() {
	    	prg('next');
	    }, valDelay);

	    valDelay = Delay;

	};

	sectionQuotesCaroussel(
		10000,
		'#section-quotes',  
		".container-el .el", 
		".container-step .step", 
		'.container-nav .nav'
	);


	function sectionModulesHoverBtn(){
		var width = $('#section-modules .container-el .el .btn .btn-text').width();
		var padding = $('#section-modules .container-el .el .btn').css('padding-left');
		var calcTranslate = (width + parseInt(padding)) / 2;

		$('#section-modules .container-el .el .btn').css({
		  '-webkit-transform' : 'translateX(-' + calcTranslate + 'px)',
		  '-moz-transform'    : 'translateX(-' + calcTranslate + 'px)',
		  '-ms-transform'     : 'translateX(-' + calcTranslate + 'px)',
		  '-o-transform'      : 'translateX(-' + calcTranslate + 'px)',
		  'transform'         : 'translateX(-' + calcTranslate + 'px)'
		});
	};

	sectionModulesHoverBtn();

	


})
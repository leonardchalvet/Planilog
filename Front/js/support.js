function dropdownHeight(){
	var dropdownOffset = $('#section-cover .wrapper .container-search .container-dropdown').offset();
	var windowsHeight = $(window).height();
	var maxHeight = windowsHeight - dropdownOffset.top - 50; 

	$('#section-cover .wrapper .container-search .container-dropdown').css('max-height', maxHeight);
}

$(window).on('load', function() {


	$(document).click(function(){
	  $('#section-cover .wrapper .container-search').removeClass('open');
	});

	$("#section-cover .wrapper .container-search .container-input input").click(function(e) {
	  $('#section-cover .wrapper .container-search').addClass('open');
	  e.stopPropagation();
	  dropdownHeight();
	});
	
})


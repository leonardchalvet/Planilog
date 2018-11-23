function dropdownHeight(){
	var dropdownOffset = $('#section-cover .wrapper .container-search .container-dropdown').offset();
	var windowsHeight = $(window).height();
	var maxHeight = windowsHeight - dropdownOffset.top - 50; 

	$('#section-cover .wrapper .container-search .container-dropdown').css('max-height', maxHeight);
}

$(window).on('load', function() {

	$("#section-cover .wrapper .container-search .container-input input").focusin(function() {
	  $('#section-cover .wrapper .container-search').addClass('open');
	  dropdownHeight();
	});
	$("#section-cover .wrapper .container-search .container-input input").focusout(function() {
	  $('#section-cover .wrapper .container-search').removeClass('open');
	});
})


$(document).ready( function(){
	$('.cms-menu-icon img').on('click', function(){
		$('.left-section').toggleClass('widthControl');
	});
	$('.mainRow').height( $(window).height() );
});	
$(window).resize( function(){
	$('.mainRow').height( $(window).height() );
});

	
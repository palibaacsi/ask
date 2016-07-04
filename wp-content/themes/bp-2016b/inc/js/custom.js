jQuery.noConflict();
jQuery( document ).ready(function( $ ) {
	$( ".mobile_nav_btn" ).click(function() {
  		$(".main_menu, .mobile_nav_btn").toggleClass("show");
	});
	$(window).scroll(function() {
		console.log($(window).scrollTop());
		if($(window).scrollTop() > 600){
			$('#up').addClass('show');
		}
		if($(window).scrollTop() < 601){
			$('#up').removeClass('show');
		}
	});
	$('.status-board-button').click(function(){
		$('.status-board').toggleClass('show');
	});
});
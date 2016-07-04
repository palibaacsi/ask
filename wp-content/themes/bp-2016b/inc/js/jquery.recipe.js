jQuery.noConflict();
jQuery(document).ready(function($) {
$("#print3x5").click(function() {
	$('#print3x5').addClass('active');
	$('#print4x6').removeClass('active');
	$('#printFull').removeClass('active');
	$('#recipeCard').removeClass('recipeFull recipe4x6').addClass('recipe3x5');
		
	});
$("#print4x6").click(function() {
	$('#print4x6').addClass('active');
	$('#print3x5').removeClass('active');
	$('#printFull').removeClass('active');
	$('#recipeCard').removeClass('recipeFull recipe3x5').addClass('recipe4x6');
		
	});
$("#printFull").click(function() {
	$('#printFull').addClass('active');
	$('#print4x6').removeClass('active');
	$('#print3x5').removeClass('active');
	$('#recipeCard').removeClass('recipe3x5 recipe4x6').addClass('recipeFull');
		
	});
});



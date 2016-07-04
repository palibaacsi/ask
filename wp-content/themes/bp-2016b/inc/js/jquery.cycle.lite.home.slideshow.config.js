jQuery.noConflict();
//slideshow
jQuery(document).ready(function ($) {
$('#slideshow')
	.cycle({ 
    	timeout: 6000,
		pager: '#slideshow-nav ul',
		pagerAnchorBuilder: function(idx, slide) { 
        	return '<li><a href="#"></a></li>'; 
    	}
    });
});
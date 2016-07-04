jQuery(document).ready(function(){
	jQuery('.dropdown-list .widget-content').hide();
	jQuery('.dropdown-list').hover(function(){
		jQuery('.widget-content', this).slideDown(100);
	},function(){
    	jQuery('.widget-content', this).slideUp(100);
    });
});
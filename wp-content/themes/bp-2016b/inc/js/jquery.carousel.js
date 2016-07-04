/**
* Author: Diego La Monica http://diegolamonica.info
* Detailed description of this work is available on http://diegolamonica.info/improving-jquery-infinite-carousel-part-1
* Based on original script described on http://jqueryfordesigners.com/demo/infinite-carousel.html
*/
(function($){
	$.fn.infiniteCarousel = function () {
		function repeat(str, num) {
			return new Array( num + 1 ).join( str );
		}
		
		return this.each(function () {
			var $wrapper = $('> div', this).css('overflow', 'hidden'),
				$slider = $wrapper.find('> ul'),
				$items = $slider.find('> li'),
				$single = $items.filter(':first'),
				singleWidth = $single.outerWidth(), 
				currentPage = 1;

			function recalculateAfterResize(){
				
				// Reset to the original carousel condition
				$('.empty', $wrapper).remove();
				$('.cloned', $wrapper).remove();
				$items = $slider.find('> li');
				$wrapper.visible = Math.floor($wrapper.innerWidth() / singleWidth),
				$wrapper.pages = Math.ceil($items.length / $wrapper.visible);
				// 1. Pad so that 'visible' number will always be seen, otherwise create empty items
				if (($items.length % $wrapper.visible) != 0) {
					$slider.append(repeat('<li class="empty" />', $wrapper.visible - ($items.length % $wrapper.visible)));
					$items = $slider.find('> li');
				}
				// 2. Top and tail the list with 'visible' number of items, top has the last section, and tail has the first
				$items.filter(':first').before($items.slice(- $wrapper.visible).clone().addClass('cloned'));
				$items.filter(':last').after($items.slice(0, $wrapper.visible).clone().addClass('cloned'));
				$items = $slider.find('> li'); // reselect
				$wrapper.scrollLeft(singleWidth * $wrapper.visible);
				$($slider).css('width', ($items.length+1) * singleWidth);
				page = 1;
			} 
	
			
			$(window).resize(recalculateAfterResize);
			if($(this).is(':visible')) recalculateAfterResize();
			
			// 4. paging function
			function gotoPage(page) {
				
				var dir = page < currentPage ? -1 : 1,
				n = Math.abs(currentPage - page),
				left = singleWidth * dir * $wrapper.visible * n;
				$wrapper.filter(':not(:animated)').animate({
					scrollLeft : '+=' + left
				}, 500, function () {
					if (page == 0) {
						$wrapper.scrollLeft(singleWidth * $wrapper.visible * $wrapper.pages);
						page = $wrapper.pages;
					} else if (page > $wrapper.pages) {
						$wrapper.scrollLeft(singleWidth * $wrapper.visible);
						// reset back to start position
						page = 1;
					} 
					
					currentPage = page;
				});                
	
				return false;
			}

			function gotoNext(){
				return gotoPage(currentPage+1);
			};
			
			function gotoPrev(){
				return gotoPage(currentPage-1);
			};
			
			$wrapper.after('<div class="stick-bottom"><a class="arrow back">&lt;</a><a class="arrow forward">&gt;</a></div>');
	
			$wrapper.touchwipe({
				wipeLeft: function(){
					gotoNext();
				},
				wipeRight: function(){
					gotoPrev();
				}
			});
			// 5. Bind to the forward and back buttons
			$('a.back', this).click(function () {
				return gotoPrev();                
			});
	
			$('a.forward', this).click(function () {
				return gotoNext();
			});
	
			// create a public interface to move to a specific page
			$(this).bind('goto', function (event, page) {
				gotoPage(page);
			});
		});  
	};
})(jQuery);
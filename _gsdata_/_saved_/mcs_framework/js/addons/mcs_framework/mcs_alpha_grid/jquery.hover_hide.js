(function ( $ ) {
	
	$.fn.hover_hide = function( options ) {
 
        var settings = $.extend({
            element: "",
			container: ""            
        }, options );

		$(".product-meta-wrapper").hide();
		this.addClass('hover_hide');
		return this.hover(
			function(){
				/*if(toggle_flag){*/
					$(this).find('.product-meta-wrapper').slideDown(200);
				/*}*/
				$('.product').not($(this)).stop(true, false).animate({opacity:0.6}, 70);
				var to;
				clearTimeout(to);
			},
			function(){
				/*if(toggle_flag){*/
					$(this).find('.product-meta-wrapper').slideUp(10);
				/*}*/
				$('.product').delay(10).animate({opacity:1}, 100);
				var to;
				to = setTimeout(function(){ },700);
		});
 
    };
	
}(jQuery));
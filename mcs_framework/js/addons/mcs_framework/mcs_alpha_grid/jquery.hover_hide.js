(function ( $ ) {
	
	$.fn.hover_hide = function( options ) {
 
        var settings = $.extend({
            element: "",
			container: ""            
        }, options );

		$(".product-meta").hide();
		this.addClass('hover_hide');
		var h=$(".product-wrapper").height();
		$(".hover_hide").css({"height":h});
		return this.hover(
			function(){
				/*if(toggle_flag){*/
					$(this).find('.product-meta').slideDown(200);
				/*}*/
				$('.product').not($(this)).stop(true, false).animate({opacity:0.6}, 70);
				var to;
				clearTimeout(to);
			},
			function(){
				/*if(toggle_flag){*/
					$(this).find('.product-meta').slideUp(10);
				/*}*/
				$('.product').delay(10).animate({opacity:1}, 100);
				var to;
				to = setTimeout(function(){ },700);
		});
 
    };
	
}(jQuery));
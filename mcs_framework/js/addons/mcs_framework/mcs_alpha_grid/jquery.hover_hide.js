(function ( $ ) {
	
	$.fn.hover_hide = function( options ) {
 
        var settings = $.extend({
            transition: "mcs_show",
			duration: 0            
        }, options );

		$(".product-meta").hide();
		this.addClass('hover_hide');
		var h=$(".product-wrapper").height();
		$(".hover_hide").css({"height":h});
		return this.hover(
			function(){
				switch(settings.transition)
				{
				case "mcs_slide":
					$(this).find('.product-meta').slideDown(settings.duration);
					break;
				case "mcs_show":
					$(this).find('.product-meta').show(settings.duration);
					break;
				}
				$(this).animate({"z-index":"250"});
				$('.product').not($(this)).stop(true, false).animate({opacity:0.6}, 70);
				var to;
				clearTimeout(to);
			},
			function(){
				switch(settings.transition)
				{
				case "mcs_slide":
					$(this).find('.product-meta').slideUp(settings.duration).animate({"z-index":"0"});
					break;
				case "mcs_show":
					$(this).find('.product-meta').hide(settings.duration).animate({"z-index":"0"});
					break;
				}
				/*$(this).delay(settings.duration).animate({"z-index":"0"});*/
				$('.product').delay(10).animate({opacity:1}, 100);
				var to;
				to = setTimeout(function(){ },700);
		});
 
    };
	
}(jQuery));
(function ( $ ) {
	
	$.fn.hover_hide = function( options ) {
 
        var settings = $.extend({
            transition: "mcs_show",
			duration: 0,
			hidden_elm:'.product-meta',
			fade_other_elms:true
        }, options );

		this.disable=function(){
			$('.hidden_elm').show();
			$(settings.hidden_elm).removeClass('hidden_elm');
			$(".hover_hide").css({"height":'auto'});
			this.removeClass('hover_hide');
			return false;
		}
		
		$(settings.hidden_elm).addClass('hidden_elm');
		$('.hidden_elm').hide();
		this.addClass('hover_hide');
		var h=$(".product-wrapper").height();
		$(".hover_hide").css({"height":h});
		return this.hover(
			function(){
				var that=$(this);
				switch(settings.transition)
				{
				case "mcs_slide":
					$(this).find('.hidden_elm').slideDown(settings.duration);
					break;
				case "mcs_show":
					$(this).find('.hidden_elm').show(settings.duration);
					break;
				case "mcs_fade":
					$(this).find('.hidden_elm').fadeIn(settings.duration);
					break;
				}
				$(this).css({"z-index":"250"});
				if(settings.fade_other_elms==true){
					$('.product').not($(this)).stop(true, false).animate({opacity:0.6}, 70);
				}
				var to;
				clearTimeout(to);
			},
			function(){
				var that=$(this);
				switch(settings.transition)
				{
				case "mcs_slide":
					$(this).find('.hidden_elm').stop().slideUp(settings.duration,function(){
						that.css({"z-index":"1"})
					});
					break;
				case "mcs_show":
					$(this).find('.hidden_elm').stop().hide(settings.duration,function(){
						that.css({"z-index":"1"})
					});
					break;
				case "mcs_fade":
					$(this).find('.hidden_elm').stop().fadeOut(settings.duration,function(){
						that.css({"z-index":"1"})
					});
					break;
				}
				if(settings.fade_other_elms==true){
					$('.product').delay(10).animate({opacity:1}, 100);
				}
				var to;
				to = setTimeout(function(){ },700);
		});
		
 
    };
	
	
}(jQuery));
(function ( $ ) {
	
	$.fn.hover_hide = function( options ) {
 
        var settings = $.extend({
            transition: "mcs_show",
			duration: 0,
			hidden_elm:'.mcs-grid-i-list__control',
			fade_other_elms:true
        }, options );

		this.disable=function(){
			$('.hidden_elm').show();
			$(settings.hidden_elm).removeClass('hidden_elm');
			$(this).removeAttr('style');
			this.removeClass('hover_hide');
			return false;
		}
		
		$(settings.hidden_elm).addClass('hidden_elm');
		$('.hidden_elm').hide();
		this.addClass('hover_hide');
		if(this.is(":visible")){
			var h=$(this).height();
			$(this).css({"height":h});
		}else{
			$(this).removeAttr('style');
		}
		return this.hover(
			function(){
				if($(this).is(":visible")){
					var h=$(this).height();
					$(this).css({"height":h});
				}else{
					$(this).removeAttr('style');
				}
				var hovered=$(this).closest('.mcs-grid-container');
				hovered.addClass('hovered');
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
					$('.hovered .hover_hide').not($(this)).stop(true, false).animate({opacity:0.6}, 70);
				}
				var to;
				clearTimeout(to);
			},
			function(){
				var that=$(this);
				var hovered=$(this).closest('.mcs-grid-container');
				hovered.removeClass('hovered');
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
					$('.hover_hide').delay(10).animate({opacity:1}, 100);
				}
				var to;
				to = setTimeout(function(){ },700);
		});
		
 
    };
	
	
}(jQuery));
(function ($) {
    $.fn.widthCheck = function (options) {	
		var defaults = {
            doOverLimit:function(){},
			doUnderLimit:function(){},
			widthLimit:767
        };
		var options = $.extend(defaults, options);
		
		return this.each(function () {
			var currentWidth = window.innerWidth || document.documentElement.clientWidth;
			
			check(currentWidth);
			
			jQuery(window).resize(function () {
				currentWidth = window.innerWidth || document.documentElement.clientWidth;
				
				check(currentWidth);
			});
			
			function check(currentWidth){
				if(currentWidth>options.widthLimit){
					$.isFunction( options.doOverLimit ) && options.doOverLimit.call( this );
					/*console.log("OK");*/
				}else{
					$.isFunction( options.doUnderLimit ) && options.doUnderLimit.call( this );
					/*console.log("NOT");*/
				}
			}
		});
		
	}
})(jQuery);
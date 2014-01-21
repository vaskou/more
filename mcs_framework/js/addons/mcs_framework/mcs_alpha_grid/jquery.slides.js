(function ($) {
 	
    $.fn.slides = function( options ) {
 
        var settings = $.extend({
            slide_element: ".slide",
			slides_container: ""
        }, options );
 
        var interv;
		
		function isIE () {
 			var myNav = navigator.userAgent.toLowerCase();
			return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
		}
		
		this.addClass('hover-container');
		
		if(settings.slides_container!=''){
			this.find(settings.slides_container).addClass('slides-container');
		}else{
			this.addClass('slides-container');
		}
			
		$('.slides-container').children().not('.progress-bar').addClass('slide');
		
		return this.hover(
		function(){
			if($(this).hasClass('slides-container')){
				$this=$(this);
			}else{
				$this=$(this).find('.slides-container');
			}
			
			if(!isIE() || isIE()>9){
				$this.children(settings.slide_element+':first').appendTo($this);
			}
			
			interv=setInterval(function() {
				$this.children(settings.slide_element+':first').hide(1,function(){
					$(this).appendTo($this).fadeIn();
				});
			}, 2000);
		},
		function(){
			clearInterval(interv);
		});
 
    };
	
	 
}( jQuery ));

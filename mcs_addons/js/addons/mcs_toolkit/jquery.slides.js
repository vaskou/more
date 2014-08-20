
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
		$('.slides-container').children(settings.slide_element+':first-child').toggleClass('top-slide');
		
		return this.hover(
		function(){
			if($(this).hasClass('slides-container')){
				$this=$(this);
			}else{
				$this=$(this).find('.slides-container');
			}
			
			$this.children(settings.slide_element).not('.top-slide').addClass('hidden-slide');
			
			interv=setInterval(function() {
				$top_slide=$this.children(settings.slide_element+'.top-slide');
				if($top_slide.next('.slide').length>0){
					$top_slide.toggleClass('top-slide hidden-slide').next('.slide').toggleClass('top-slide hidden-slide');
				}else{
					$top_slide.toggleClass('top-slide hidden-slide');
					$this.children(settings.slide_element+':first-child').toggleClass('top-slide hidden-slide');
				}
			}, 2000);
		},
		function(){
			clearInterval(interv);
		});
 
    };
	
	 
}( jQuery ));

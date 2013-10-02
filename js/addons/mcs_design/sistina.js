$(function(){
	
	initBindings();
	
	$( document ).ajaxComplete(function() 
	{
		initBindings();
	});
	
	function initBindings(){

/****************** Show/Hide .product-meta-wrapper on screen resize *************************/
		var toggle_flag;
		
		toggle_slide(767);
		
		function toggle_slide(screenWidth)
		{
			currentWidth = window.innerWidth || document.documentElement.clientWidth;
			if (currentWidth <= screenWidth) {
				toggle_flag=false;
				$(".product-meta-wrapper").show();
			} else {
				toggle_flag=true;
				$(".product-meta-wrapper").hide();
			}	
			if (currentWidth > screenWidth+1) {
				toggle_flag=true;
				$(".product-meta-wrapper").hide();
			} else {
				toggle_flag=false;
				$(".product-meta-wrapper").show();
			}
		}
		
		$(window).resize(function(){
			toggle_slide(767);
		});

/************** END Show/Hide .product-meta-wrapper on screen resize *************************/

/*********************************** Hover animation *****************************************/
			
		$('.mcs_sistina .product').hover(
		function(){
			if(toggle_flag){
				$(this).find('.product-meta-wrapper').slideDown(200);
			}
			$('.product').not($(this)).stop(true, false).animate({opacity:0.6}, 70);
			var to;
            clearTimeout(to);
		},
		function(){
			if(toggle_flag){
				$(this).find('.product-meta-wrapper').slideUp(10);
			}
			$('.product').delay(10).animate({opacity:1}, 100);
			var to;
            to = setTimeout(function(){ },700);
		});

/******************************* END Hover animation *****************************************/

		
		$('.mcs_sistina .products .multi_img').slides();
		
		$('.product-container').slides({
			element:'img',
			container:'.multi_img'
		});
		
		
	}
});
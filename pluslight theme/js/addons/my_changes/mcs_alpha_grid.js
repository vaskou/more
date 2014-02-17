$(function(){
	
	var flag=false;
	
	initBindings();
	
	$(document).ajaxStop(function() {
        if(flag){
			initBindings();
		}
		flag=true;
    });
	
	function initBindings(){
		$(".mcs_alpha_grid .product").widthCheck({
		doOverLimit:function(){
			$(".mcs_alpha_grid .product").unbind('mouseenter');
			$(".mcs_alpha_grid .product").unbind('mouseleave');
			$(".mcs_alpha_grid .product").hover(
			function(){
				$(this).find('.price-wrapper').animate({backgroundColor:"#e6e6e6"}, 250);
				$(this).find('.product_extra_info').animate({backgroundColor:"#e6e6e6"}, 250);
				$(this).find('.product-meta-wrapper').animate({backgroundColor:"#e6e6e6"}, 250);
			},
			function(){
				$(this).find('.price-wrapper').animate({backgroundColor:"#fff"}, 100);
				$(this).find('.product_extra_info').animate({backgroundColor:"#fff"}, 100);
				$(this).find('.product-meta-wrapper').animate({backgroundColor:"#fff"}, 100);
			});
		},
		doUnderLimit:function(){
			$(".mcs_alpha_grid .product").unbind('mouseenter');
			$(".mcs_alpha_grid .product").unbind('mouseleave');
		}});
	}
});
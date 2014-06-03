$(function(){
	if($("#mcs_helper").hasClass("mcs_responsive")){
		enquire.register("screen and (min-width:768px)",{
			match:function(){
				fn_product_page_height();
			}
		});
	}else{
		fn_product_page_height();	
	}
});

function fn_product_page_height()
{
	image_panel_height=$(".product-main-info .image-wrap").outerHeight(true);
	$(".product-main-info .product-info").css({"min-height":image_panel_height+"px"});
}
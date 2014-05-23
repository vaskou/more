$(function(){
	image_panel_height=$(".product-main-info .image-wrap").outerHeight(true);
	console.log(image_panel_height);
	$(".product-main-info .product-info").css({"min-height":image_panel_height+"px"});
});
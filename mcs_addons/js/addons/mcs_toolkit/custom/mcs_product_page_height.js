$(function(){
	enquire.register("screen and (min-width:768px)",{
		match:function(){
			$(window).resize(function(){
				fn_product_page_height();
			});
			fn_product_page_height();
		}
	});
	enquire.register("screen and (max-width:767px)",{
		match:function(){
			$(window).resize(function(){
				$(".ty-product-block__img-wrapper").css({"min-height":"0px"});
			});
		}
	});
	
});

function fn_product_page_height()
{
	product_image_height=$(".ty-product-block__img").outerHeight(true);
	product_info_height=$(".ty-product-block__left").outerHeight(true);
	if(product_image_height > product_info_height){
		max_height=product_image_height;
	}else{
		max_height=product_info_height;
	}
	$(".ty-product-block__img-wrapper").css({"min-height":max_height+"px"});
}
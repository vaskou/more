
$(function(){
	initBindings();
	$(document).ajaxStop(function() {
		initBindings();
	});

	function initBindings(){
		$(".ty-product-filters").hover(
		function(){
			$(this).children("li").children("ul").slideDown(500);
			$(this).children("li.ty-product-filters__extra-block").hide(500);
		},
		function(){
		});
	};
});
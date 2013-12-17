$(function(){
	$(".ddown > .col-1 > ul").hide();
	
	$(".ddown > .col-1").hover(
	function(){
		col=$(this);
		col.children("ul").slideDown(500);
	},
	function(){
		col=$(this);
		col.children("ul").stop().slideUp(1000);
	});
	
});
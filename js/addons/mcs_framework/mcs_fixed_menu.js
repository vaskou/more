$(function(){
	var top_panel_height=$(".tygh-top-panel").height();
	var header_height=$(".tygh-header").height();
	
	$(".tygh-header").addClass("menu-fixed");
	$(".tygh-content").css({"margin-top":header_height+1+"px"});
	
	
	$(window).scroll(function(){
		var top_distance=$(window).scrollTop();
		if(top_distance>top_panel_height){
			$(".menu-fixed").css({"top":0});
			$(".menu-fixed").addClass("scrolled-up");
		}else{
			$(".menu-fixed").css({"top":top_panel_height-top_distance});
			$(".menu-fixed").removeClass("scrolled-up");
		}
	});
});
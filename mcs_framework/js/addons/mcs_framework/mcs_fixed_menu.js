$(function(){
	if($('#mcs_helper').hasClass('mcs_computer')){
		$(".tygh-header").widthCheck({
		doOverLimit:function(){
			var top_panel_height=$(".tygh-top-panel > div").height();
			var header_height=$(".tygh-header").height();
			/*console.log(header_height);*/
			$(".tygh-header").addClass("menu-fixed");
			$(".tygh-content").css({"margin-top":header_height+"px"});
			$(".menu-fixed").css({"top":top_panel_height});
			$(".scrolled-up").css({"top":0});
			
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
		},
		doUnderLimit:function(){
			$(".tygh-header").removeClass("menu-fixed");
			$(".tygh-content").css({"margin-top":"0px"});
		},
		widthLimit:960});
	}
});
$(function(){
	$(".tygh-header").widthCheck({
	doOverLimit:function(){	
		var top_panel_height=$(".tygh-top-panel").height();
		var header_height=$(".menu-fixed .header-hide").height();
		var top_height=top_panel_height+header_height;
		
		$(window).scroll(function(){
			var top_distance=$(window).scrollTop();
			if(top_distance>top_height){
				$(".menu-fixed .header-hide").slideUp(500);
			}else{
				$(".menu-fixed .header-hide").slideDown(100);
			}
		});
	},
	doUnderLimit:function(){
		$(".header-hide").show();
	},
	widthLimit:960});
});
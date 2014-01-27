$(function(){
	$(".tygh-header").widthCheck({
	doOverLimit:function(){	
		var top_panel_height=$(".tygh-top-panel").height();
		var header_height=$(".menu-fixed .header-hide").height();
		var header_hidden=$(".menu-fixed .header-hide");
		var top_height=top_panel_height+header_height;
		
		$(window).scroll(function(){
			var top_distance=$(window).scrollTop();
			if(top_distance>top_height){
				$(header_hidden).css({"min-height":"0px"});
				$(header_hidden).slideUp(500);
			}else{
				$(header_hidden).slideDown(100);
			}
		});
	},
	doUnderLimit:function(){
		$(".header-hide").show();
	},
	widthLimit:960});
});
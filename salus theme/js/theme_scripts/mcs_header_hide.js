$(function(){
	if($('#mcs_helper').hasClass('mcs_computer')){
		$(".tygh-header").widthCheck({
		doOverLimit:function(){	
			var top_panel_height=$(".tygh-top-panel").height();
			var header_height=$(".menu-fixed .header-hide").height();
			var top_height=top_panel_height+header_height;
			
			$(window).scroll(function(){
				var top_distance=$(window).scrollTop();
				var header_hidden=$(".menu-fixed .header-hide");
				if(top_distance>top_height){
					$(header_hidden).css({"min-height":"0px"});
					$(header_hidden).slideUp(500);
				}else{
					$(header_hidden).slideDown(100,function(){
						var header_height=$(".tygh-header").height();
						$(".tygh-content").css({"margin-top":header_height+"px"});
					});
				}
				
			});
		},
		doUnderLimit:function(){
			$(window).scroll(function(){
				$(".tygh-content").css({"margin-top":"0px"});
			});
			$(".header-hide").show();
		},
		widthLimit:960});
	}
});

var header_hide_over_handler={
	setup:function(){
		fn_header_hide_over();
	},
	deferSetup:true
}

var header_hide_under_handler={
	setup:function(){
		fn_header_hide_under();
	},
	deferSetup:true
}

function fn_header_hide_over(){
	if($('#mcs_helper').hasClass('mcs_computer')){
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
	}
}

function fn_header_hide_under(){
	if($('#mcs_helper').hasClass('mcs_computer')){
		$(window).scroll(function(){
			$(".tygh-content").css({"margin-top":"0px"});
		});
		$(".header-hide").show();
	}
}
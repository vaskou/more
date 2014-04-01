var fixed_menu_over_handler={
	match:function(){
		fn_fixed_menu_over();
	},
	deferSetup:true
}

var fixed_menu_under_handler={
	match:function(){
		fn_fixed_menu_under();
	},
	deferSetup:true
}

function fn_fixed_menu_over(){
	if($('#mcs_helper').hasClass('mcs_computer')){
		var top_panel_height=$(".tygh-top-panel").outerHeight();
		var header_height=$(".tygh-header").outerHeight();
		
		$(".tygh-header").addClass("menu-fixed");
		$(".tygh-content").css({"margin-top":header_height+"px"});
		$(".menu-fixed").css({"top":top_panel_height});
		$(".scrolled-up").css({"top":0});
		
		$(window).resize(function(){
			top_panel_height=$(".tygh-top-panel").outerHeight();
			header_height=$(".tygh-header").outerHeight();
			$(".tygh-content").css({"margin-top":header_height+"px"});
		});
		
		$(window).scroll(function(){
			var header_height=$(".tygh-header").outerHeight();
			var top_distance=$(window).scrollTop();
			if(top_distance>top_panel_height){
				$(".menu-fixed").css({"top":0});
				$(".menu-fixed").addClass("scrolled-up");
			}else{
				$(".tygh-content").css({"margin-top":header_height+"px"});
				$(".menu-fixed").css({"top":top_panel_height-top_distance});
				$(".menu-fixed").removeClass("scrolled-up");
			}
		});
	}
}

function fn_fixed_menu_under(){
	if($('#mcs_helper').hasClass('mcs_computer')){
		$(window).scroll(function(){
			var top_panel_height=$(".tygh-top-panel").outerHeight();
			var top_distance=$(window).scrollTop();
			if(top_distance>top_panel_height){
				$(".tygh-header").addClass("scrolled-up");
			}else{
				$(".tygh-header").removeClass("scrolled-up");
			}
			$(".tygh-content").css({"margin-top":"0px"});
		});
		$(".tygh-header").removeClass("menu-fixed");
		$(".tygh-content").css({"margin-top":"0px"});
		
		$(window).resize(function(){
			$(".tygh-content").css({"margin-top":"0px"});
		});
	}
}
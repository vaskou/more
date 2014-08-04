$(function(){
	enquire.register("screen and (min-width:768px)",[
			menu_third_level_hide_over_handler
		]
	);
	enquire.register("screen and (max-width:767px)",[
			menu_third_level_hide_under_handler
		]
	);
});

var menu_third_level_hide_over_handler={
	match:function(){
		fn_menu_third_level_hide_over();
	}
};

var menu_third_level_hide_under_handler={
	match:function(){
		fn_menu_third_level_hide_under();
	}
};

function fn_menu_third_level_hide_over(){

	$(".ty-top-mine__submenu-col .ty-menu__submenu").hide();
	
	$(".ty-menu__submenu-item-header").hover(
	function(){
		$(this).siblings(".ty-menu__submenu").slideDown(500);
	},
	function(){
		$(this).siblings(".ty-menu__submenu").stop().slideUp(1000);
	});
}

function fn_menu_third_level_hide_under(){
	$(".ty-menu__submenu-item-header").unbind('mouseenter mouseleave');
	$(".ty-menu__submenu-item-header").siblings(".ty-menu__submenu").removeAttr('style');
}
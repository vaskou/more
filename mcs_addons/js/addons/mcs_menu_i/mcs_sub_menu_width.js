$(function(){
	enquire.register("screen and (min-width:768px) and (max-width:999px)",[
			mega_menu_width_768_handler
		]
	);
	enquire.register("screen and (min-width: 1000px) and (max-width:1199px)",[
			mega_menu_width_1000_handler
		]
	);
	enquire.register("screen and (min-width: 1200px)",[
			mega_menu_width_1200_handler
		]
	);
	enquire.register("screen and (max-width:767px)",[
			mega_menu_width_under_handler
		]
	);
});

var mega_menu_width_under_handler={
	match:function(){
		$(".ty-menu__item").not(".ty-menu__menu-btn").each(
		function(){
			var main=$(this).find(".ty-menu__submenu-items");
			main.removeAttr('style');
			main.children(".ty-top-mine__submenu-col").removeAttr('style');
		});
	}
};
var mega_menu_width_768_handler={
	match:function(){
		$(".ty-menu__item").not(".ty-menu__menu-btn").each(
		function(){
			var main=$(this).find(".ty-menu__submenu-items");
			mega_menu_width(main,768);
		});
		
	}
};
var mega_menu_width_1000_handler={
	match:function(){
		$(".ty-menu__item").not(".ty-menu__menu-btn").each(
		function(){
			var main=$(this).find(".ty-menu__submenu-items");
			mega_menu_width(main,1000);
		});
		
	}
};
var mega_menu_width_1200_handler={
	match:function(){
		$(".ty-menu__item").not(".ty-menu__menu-btn").each(
		function(){
			var main=$(this).find(".ty-menu__submenu-items");
			mega_menu_width(main,1200);
		});
		
	}
};

function mega_menu_width(main,width)
{
	if(width==768){
		amount=4;
	}else if(width==1000){
		amount=6;
	}else if(width==1200){
		amount=6;
	}
	var subitems=main.children(".ty-top-mine__submenu-col").length;
	if(subitems>=0){
		var divider=Math.ceil(subitems/amount);
		var cols=Math.ceil(subitems/divider);
		
		var col_width=Math.floor((width - 24 - (amount*10)) / amount);
		main.css({"width":col_width*cols+(cols*10)+"px"});
		main.children(".ty-top-mine__submenu-col").css({"width":col_width+"px"});
	}
}
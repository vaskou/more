$(function(){	
	$(".ty-menu__item").not(".ty-menu__menu-btn").hover(
	function(){
		var main=$(this).find(".ty-menu__submenu-items");
		if(!isEntirelyVisible(main)){
			main.css({"right":0});
		}
	},
	function(){
	});
	
	function isEntirelyVisible(main)
	{
		var l=main.offset().left + 1; //To (+1) einai hack
		var w=main.outerWidth();
		//console.log(l+" "+w);
        var mnuW = main.closest(".ty-menu__items").outerWidth();
        var mnuL = main.closest(".ty-menu__items").offset().left;
		//console.log((l+ w) +"<="+ (mnuW+mnuL ));
		if ( (l+ w) < mnuW+mnuL ) {
            return true;
        }else{
			return false;
		}
	};
});
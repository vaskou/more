$(function(){	
	$(".mcs-alpha-menu .dropdown-multicolumns > li").hover(
	function(){
		var main=$(this).children("ul");
		if(main.length<=0){
			main=$(this).children("div");
		}
		if(main.length<=0){
			return false;
		}
		main.removeClass('drop-left');
		if ( ! isEntirelyVisible(main) ) {
			$(this).addClass('static');
            main.addClass('drop-left');
        }
	},
	function(){
		$(this).removeClass('static');
		$(this).children("ul").removeClass('drop-left');
	});	
	
	function isEntirelyVisible(main)
	{
		var l=main.offset().left;
		var w=main.width();
		//console.log(l+" "+w);
        var mnuW = main.closest(".dropdown-multicolumns").width();
        var mnuL = main.closest(".dropdown-multicolumns").offset().left;
		//console.log((l+ w) +"<="+ (mnuW+mnuL ));
		if ( (l+ w) <= mnuW+mnuL ) {
            return true;
        }else{
			return false;
		}
	};
});
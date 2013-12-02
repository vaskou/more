$(function(){
	$(".ddown > .col-1 > ul").hide();
	
	$(".ddown > .col-1").hover(
	function(){
		col=$(this);
		col.children("ul").slideDown(500);
	},
	function(){
		col=$(this);
		col.children("ul").stop().delay(1000).slideUp(500);
	});
	
	
	
	$(".dropdown-multicolumns > li").hover(
	function(){
		var main=$(this).children("div");
		main.removeClass('drop-left');
		if ( ! isEntirelyVisible(main) ) {
			$(this).addClass('static');
            main.addClass('drop-left');
        }
	},
	function(){
		$(this).removeClass('static');
		$(this).children("div").removeClass('drop-left');
	});	
	
	function isEntirelyVisible(main)
	{
		var l=main.offset().left;
		var w=main.width();
		//console.log(l1+" "+w);
        var mnuW = main.closest("ul").width();
        var mnuL = main.closest("ul").offset().left;
		//console.log((l1+ w) +"<="+ (mnuW+mnuL ));
		if ( (l+ w) <= mnuW+mnuL ) {
            return true;
        }else{
			return false;
		}
	};
});
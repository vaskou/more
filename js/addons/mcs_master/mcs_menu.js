$(function(){
	$(".dropdown-multicolumns li").hover(
	function(){
		var elm = $('div:first', this);
        var off = elm .offset();
        var l = off.left;
        var w = elm.width();
        var mnuW = $(".top-menu").width();
        var mnuL = $(".top-menu").offset().left;

        var isEntirelyVisible = (l+ w <= mnuW+mnuL);
		if ( ! isEntirelyVisible ) {
            $(this).addClass('edge');
        }
	},
	function(){
		 $(this).removeClass('edge');
	});
	
});
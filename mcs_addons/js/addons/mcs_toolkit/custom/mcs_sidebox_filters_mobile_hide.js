$(function(){
	enquire.register("screen and (min-width:768px)",{
		match:function(){
			fn_restore_filters();
		}
	});
	enquire.register("screen and (max-width:767px)",{
		match:function(){
			fn_hide_filters();
		}
	});
	
	
});

function fn_hide_filters()
{
	$('.ty-product-filters__switch').each(function(){
		if($(this).hasClass('open')){
			$(this).addClass('mcs-open');
			//$(this).click();
			$(this).removeClass('open');
			$(this).next().hide();
		};
	});
}

function fn_restore_filters()
{
	$('.ty-product-filters__switch').each(function(){
		if($(this).hasClass('mcs-open')){
			$(this).removeClass('mcs-open');
			if($(this).hasClass('open')==false){
				//$(this).click();
				$(this).addClass('open');
				$(this).next().show();
			}
		};	
	});
}
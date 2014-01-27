$(function(){
	
	if($('#mcs_helper').hasClass('mcs_tablet')){
		var menu_buttons=$(".mcs-alpha-menu .dropdown-multicolumns >li > a.drop")
		$(menu_buttons).parent('li').hover(function() {
		
			$(this).children('a.drop').siblings().css('display','none');
		
		});
		
		$(menu_buttons).click( function() {
		   
			if($(this).siblings().css('display')=='none'){
				event.preventDefault();
				$(this).siblings().css('display','block')
		   
			}
		
		
		});
	}
	
});
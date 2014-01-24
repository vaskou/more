$(function(){
	
	if($('#mcs_helper').hasClass('mcs_tablet')){
		$('a.drop').parent('li').hover( function() {
		
			$(this).children('a.drop').siblings().css('display','none');
		
		});
		
		$('a.drop').click( function() {
		   
			if($(this).siblings().css('display')=='none'){
				event.preventDefault();
				$(this).siblings().css('display','block')
		   
			}
		
		
		});
	}
	
});
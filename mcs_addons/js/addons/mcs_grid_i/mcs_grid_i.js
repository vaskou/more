$(function(){
	
	var flag=false;
	
	initBindings();
	$(document).ajaxStop(function() {
        if(flag){
			initBindings();
		}
		flag=true;
    });
	
	function initBindings(){
		$('.mcs-grid-i-list__item').slides({
			slide_element:'a',
			slides_container:'.multi-img'
		});		
	};	
});
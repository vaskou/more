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
		$('.mcs_alpha_grid .product').slides({
			slide_element:'a',
			slides_container:'.multi_img'
		});		
	};	
});
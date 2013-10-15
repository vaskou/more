$(function(){
	
	initBindings();
	
	$( document ).ajaxComplete(function() 
	{
		initBindings();
	});
	
	function initBindings(){
		$('.mcs_enfold_grid .product').slides({
			slide_element:'a',
			slides_container:'.multi_img'
		});
	}	
});
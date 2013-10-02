$(function(){
		
	initBindings();
	
	$( document ).ajaxComplete(function() 
	{
		initBindings();
	});
	
	function initBindings(){
    	$('.mcs_hover .products > li').each( function() { $(this).hoverdir(); } );
		
		$('.mcs_hover .product').slides({
			element:'a',
			container:'.multi_img'
		});
	}
});

$(function(){
	
	$('.mcs-accordion-block').each(function(){
		$(this).children('.mcs-accordion-content').each(function(){
			content='<h3>'+$(this).attr('data-title')+'</h3>';
			$(this).before(content);
		});
		$(this).accordion({ heightStyle: "content" });
	});
	
});
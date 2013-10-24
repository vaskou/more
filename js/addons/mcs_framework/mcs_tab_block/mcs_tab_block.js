$(function(){
	
	$('.mcs-tab-block').each(function(){
		content='<ul>';
		$(this).children('.mcs-tab-content').each(function(){
			content+='<li><a id=mcs-tab-link-'+$(this).attr('data-snapping-id')+' href="#'+$(this).attr('id')+'">'+$(this).attr('data-title')+'</a></li>';
		});
		content+="</ul>";
		$(this).prepend(content);
		$(this).tabs();
	});
	
});
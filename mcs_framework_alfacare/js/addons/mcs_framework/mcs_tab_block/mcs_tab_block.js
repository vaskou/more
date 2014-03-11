
$(function(){
	
	$('.mcs-tab-block').each(function(){
		var strEvent='click';
		content='<ul>';
		$(this).children('.mcs-tab-content').each(function(){
			
			content+='<li><a href="#'+$(this).attr('id')+'">'+$(this).attr('data-title')+'</a></li>';
			
			if($(this).attr('data-hover')=='Y'){
				strEvent='mouseover';
			}
		});
		content+="</ul>";
		$(this).prepend(content);
		
		$(this).tabs({event:strEvent});
	});
	
});
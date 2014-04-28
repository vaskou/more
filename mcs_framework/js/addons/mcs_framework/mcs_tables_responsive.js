var tables_responsive_over_handler={
	match:function(){
		fn_tables_responsive_over();
	}
};

var tables_responsive_under_handler={
	match:function(){
		fn_tables_responsive_under();
	}
};

function fn_tables_responsive_over(){
	$(".table").each(function(){
		$(this).children("thead").show();
		
		$(this).find("tr").each(function(){
			$(this).removeClass('table-border');
			$(this).children('td').each(function(){
				$(this).children('h1.left').remove();
				
			});
		});
	});
}

function fn_tables_responsive_under(){
	$(".table").each(function(){
		var arr=new Array();
		i=0;
		
		$(this).children("thead").hide();

		if($(this).find('th').length > 0){
			$(this).find("th").each(function(){
				colspan=$(this).attr('colspan');
				title=$(this).text();
				arr[i++]=title;
				if(colspan>=2){
					k=0;
					while(k < (colspan-1)){
						arr[i++]=title;
						k++;
					}
				}
			});
		
			$(this).find("tr").each(function(){
				j=0;
				$(this).addClass('table-border');
				$(this).children('td').each(function(){
					$(this).prepend('<h1 class="left">'+arr[j++]+'</h1>');
				});
			});
		}
	});
}
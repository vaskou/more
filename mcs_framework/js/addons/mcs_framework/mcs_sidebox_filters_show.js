var sidebox_filters_show_over_handler={
	match:function(){
		fn_sidebox_filters_show_over();
	}
};

var sidebox_filters_show_under_handler={
	match:function(){
		fn_sidebox_filters_show_under();
	}
};

function fn_sidebox_filters_show_over(){
	initBindings();
	$(document).ajaxStop(function() {
		initBindings();
	});

	function initBindings(){
		$(".product-filters").hover(
		function(){
			$(this).children("ul").slideDown(500);
		},
		function(){
		});
	};
}

function fn_sidebox_filters_show_under(){
	$(".product-filters").children("ul").slideDown(500);
}

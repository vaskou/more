$(function(){
	
	var toggle_flag;
	
	toggle_sidebox(767);
	
	function toggle_sidebox(screenWidth)
	{
		currentWidth = window.innerWidth || document.documentElement.clientWidth;
		if (currentWidth >= screenWidth) {
			toggle_flag=false;
			$(".sidebox-body").show();
		} else {
			toggle_flag=true;
			$(".sidebox-body").hide();
		}	
		if (currentWidth < screenWidth+1) {
			toggle_flag=true;
			$(".sidebox-body").hide();
		} else {
			toggle_flag=false;
			$(".sidebox-body").show();
		}
	}
	
	$(window).resize(function(){
		toggle_sidebox(767);
	});
	
	
	$(".sidebox-title").click(function(){
		if(toggle_flag==true)
		{
			$(this).next().slideToggle();
		}
	});
	

});
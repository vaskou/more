
$(function(){
	
	$("body").widthCheck({
	doOverLimit:function(){
		$('.mcs-sidebox-hide .sidebox-title a').unbind('click');
		$('.mcs-sidebox-hide .sidebox-body').show();
		$(".sidebox-wrapper").removeClass("mcs-sidebox-hide");
	},
	doUnderLimit:function(){
		$(".sidebox-wrapper").addClass("mcs-sidebox-hide");
		$(".mcs-sidebox-hide .sidebox-title").unbind('click');
		$('.mcs-sidebox-hide .sidebox-body').hide();
		$('.mcs-sidebox-hide .sidebox-body.unhid').show();
		$(".mcs-sidebox-hide .sidebox-title").click(function(){
			$(this).next().toggleClass('unhid');
			$(this).toggleClass('unhid');
			if($(this).next().hasClass('unhid')==true){
				$(this).next().slideDown(500);	
			}else{
				$(this).next().slideUp(500);
			}
			
		});
		
	
		$('.mcs-sidebox-hide .sidebox-title a').click(function(event){
			event.preventDefault();
		});		
	},
	widthLimit:767});
	
});

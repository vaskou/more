{literal}
<script>
$(function(){
	$('.product_features_view .add-to-wish').click(function() {
		imgtofly = $(this).closest('.vs-grid-table').find('img.ty-pict');console.log(imgtofly);
		if(imgtofly.length==0){
			imgtofly = $(this).closest('.vs-grid-table').find('.ty-no-image');
		}
		$(document).ajaxComplete(function(event, request, settings) {
			var cart = $('.mcs-vendor-wishlist .ty-column10').children().last();
			response=$.parseJSON(request.responseText);
			notifications=response.notifications;
			if (notifications==false){
				$(cart).css({'opacity':'0'});
				if (imgtofly) {
					var imgclone = imgtofly.clone()
						.offset({ top:imgtofly.offset().top, left:imgtofly.offset().left })
						.css({'opacity':'0.7', 'position':'absolute', 'z-index':'1000'})
						.appendTo($('body'))
						.animate({
							'top':cart.offset().top + 10,
							'left':cart.offset().left + 30,
							'width':10,
							'height':10
						}, 1000, 'linear');
					imgclone.animate({'width':0, 'height':0}, 100, 'linear', function(){ $(this).detach() });
					var body = $("body,html");
					var top = $(window).scrollTop();
					if(top>0){
					       body.animate({scrollTop :0}, 1000,function(){ });
					}
				}
				$(cart).delay(900).animate({opacity:1},800,function(){});
			}
			$(document).unbind('ajaxComplete');
		});
		
	});
});
</script>
{/literal}
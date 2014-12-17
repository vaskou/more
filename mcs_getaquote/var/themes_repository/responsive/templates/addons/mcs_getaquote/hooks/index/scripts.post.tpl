{literal}
<script>
$(function(){
	$('.product_features_view .add-to-wish').click(function() {
		imgtofly = $(this).closest('.vs-grid-table');
		$(document).ajaxComplete(function() {
			var cart = $('.ty-column10').children().last();
			if (imgtofly) {
				var imgclone = imgtofly.clone()
					.offset({ top:imgtofly.offset().top, left:imgtofly.offset().left })
					.css({'opacity':'0.7', 'position':'absolute', 'height':'150px', 'width':'150px', 'z-index':'1000'})
					.appendTo($('body'))
					.animate({
						'top':cart.offset().top + 10,
						'left':cart.offset().left + 30,
						'width':55,
						'height':55
					}, 1, 'linear');
				imgclone.animate({'width':0, 'height':0}, function(){ $(this).detach() });
			}
			$(document).unbind('ajaxComplete');
		});
		
	});
});
</script>
{/literal}

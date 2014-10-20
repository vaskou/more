<script type="text/javascript">
$(function(){
	$(".ty-product-options__item").each(function(index, element) {
        option_count=$(element).children("select").find('option').length;
		if(option_count==1){
			$(element).hide();
		}
    });
});
</script>
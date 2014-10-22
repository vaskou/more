<script type="text/javascript">
$(function(){
	$(".options-wrapper .product-list-field").each(function(index, element) {
        option_count=$(element).children("select").find('option').length;
		if(option_count==1){
			$(element).hide();
		}
    });
});
</script>
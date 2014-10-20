{literal}
<script type="text/javascript">
	
	$(document).ready(function() {
	
		fn_mcs_proccess_picker_button();

	});


	$( document ).ajaxComplete(function( event, xhr, settings ) {
				
		fn_mcs_proccess_picker_button();
	
	});

	(function(_, $) {

		$.ceEvent('on', 'ce.formpre_add_products', function(frm, elm) {
			
			var checked_inputs = $('[id^=pagination_mcs_related_product]').find('td>input.mrg-check:checked').length;
			
			//console.log($('[id^=pagination_mcs_related_product]').find('td>input.mrg-check:checked'));
			
			if(checked_inputs>1){
				alert('ΠΡΟΣΟΧΗ: Έχετε επιλέξει περισσότερα από 1 προϊόντα.')
				return false;
			}
				
			fn_mcs_proccess_picker_button_click();

		});
			
	}(Tygh, Tygh.$));

		
	function fn_mcs_proccess_picker_button(){

		fn_mcs_proccess_picker_button_click();
			

	}

	function fn_mcs_proccess_picker_button_click(){

		$('.mcs_related_product a.cm-external-click.btn').click(function (event) {

			if($(this).closest(".mcs_related_product").find('[id^=mcs_related_product]').hasClass('cm-js-item')&&$(this).closest(".mcs_related_product").find('[id^=mcs_related_product]').hasClass('hidden')){
				event.preventDefault();
				event.stopPropagation();
			}
		});
	}
	
</script>
{/literal}
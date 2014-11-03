<div class="mcs_form">
{literal}
<style>
.mcs_form .ty-control-group{padding:0 20px;}
</style>
{/literal}
{include file="views/pages/view.tpl"}

{*assign var=product_data value=$mcs_product_data|json_decode:true}

{$product_data|var_dump*}

<script>
	var frms = $('form:not(.cm-processed-form)');
    frms.addClass('cm-processed-form');
    frms.ceFormValidator();
</script>
</div>
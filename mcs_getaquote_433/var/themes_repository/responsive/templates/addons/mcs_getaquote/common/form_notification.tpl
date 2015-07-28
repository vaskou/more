<div class="mcs_form">
{literal}
<style>
.mcs_form .ty-control-group{
	padding:0 20px;
}
.mcs_form .ty-column6{
	width:70px !important;
}
.mcs_form .ty-grid-list__image img,
.mcs_form .ty-grid-list__image .ty-no-image{
	max-width: 100%;
	height: auto;
	vertical-align: middle;
	font-size: 0;
}
</style>
{/literal}
{include file="views/pages/view.tpl"}

<script>
	var frms = $('form:not(.cm-processed-form)');
    frms.addClass('cm-processed-form');
    frms.ceFormValidator();
</script>
{literal}
<script>
	$(function(){
		function fn_no_image_height(){
			var no_image=$(".mcs_form .mcs-vendor-list__image .ty-no-image");
			var max_width=no_image.outerWidth();
			no_image.css({"min-height":max_width});
		}
		fn_no_image_height();
		$(window).resize(function(){
			fn_no_image_height();
		});
		$(document).ajaxStop(function() {
			fn_no_image_height();
		});
	});
</script>
{/literal}
</div>
<div class="mcs_form">
{literal}
<style>
.notification-body-extended{
	background:#efefef;
}
.mcs_form .vs-page-form-content{
	display:none;
}
.mcs_form .vs-page-form-form{
	float:none;
	width:100%;
	min-height:440px;
}
.mcs_form .vs-page-form-form form .control-group{
	margin-top:0;
}
.mcs_form .ty-column6{
	width:10% !important;
	margin:2px;
	padding:0px;
}
.mcs_form .ty-grid-list__image img,
.mcs_form .ty-grid-list__image .no-image{
	max-width: 100%;
	height: auto;
	vertical-align: middle;
	font-size: 0;
}
</style>
{/literal}

{include file="views/pages/view.tpl"}

{literal}
<script>
	var frms = $('form:not(.cm-processed-form)');
    frms.addClass('cm-processed-form');
    frms.ceFormValidator();	
</script>
{/literal}
{literal}
<script>
	$(function(){
		function fn_no_image_height(){
			var no_image=$(".mcs_form .mcs-vendor-list__image .no-image");
			var max_width=no_image.outerWidth();
			no_image.css({"height":max_width});
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
{style src="addons/mcs_responsive/bootstrap_16.css"}
<style type="text/css">
{literal}
/*.container,.navbar-static-top .container,.navbar-fixed-top .container,.navbar-fixed-bottom .container{width:{/literal}{$addons.mcs_responsive.mcs_max_width}{literal}px;}

.container-fluid{max-width:{/literal}{$addons.mcs_responsive.mcs_max_width}{literal}px;margin:0 auto;}*/
{/literal}
</style>

{if $addons.mcs_responsive.mcs_responsive_enabled=='true'}

{style src="addons/mcs_responsive/bootstrap_16.responsive.css"}

{/if}

<style type="text/css">
{literal}

.mcs_span_img img{
	max-width:90%;
	width:auto;
	height:auto;
	display:block;
	margin:0 auto;
}
@media (min-width:120px){
	.mcs_span_img_no_border img{
		max-width:90%;
		width:auto;
		height:auto;
	}
	
	.tygh-top-panel > div{
		height:auto;
	}
}


/******************************* CSP Sidebox Style ******************************************/
@media (max-width:767px){
	.sidebox-body{
		
	}
}
/******************************* END CSP Sidebox Style **************************************/


/******************************* CSP Grid list Style ****************************************/
/* Used in file \addons\mcs_responsive\overrides\views\products\components\product_icon.tpl */

/*.product-cell-wrapper table{
	display:block;
}

.product-cell-wrapper tbody{
	display:block;
}

.product-cell-wrapper tr{
	display:block;
}

.product-cell-wrapper td{
	display:block;
}

td.preview-image{
	margin:auto;
}

td.preview-image img{
	margin:auto;
	height:auto;
	max-width:100%;
	width:auto;
}

td.preview-image a{
	display:block;
}
*/
/******************************* END CSP Grid list Style ************************************/

{/literal}
</style>

{******************************* CSP Products List Style ************************************}

{style src="addons/mcs_responsive/products_list.css"}

{******************************* END CSP Products List Style ********************************}


{******************************* CSP Top Menu Style *****************************************}

{style src="addons/mcs_responsive/topmenu.less"}

{******************************* END CSP Top Menu Style *************************************}

{style src="addons/mcs_responsive/meanmenu.css"}
{style src="addons/mcs_responsive/meanmenu.less"}
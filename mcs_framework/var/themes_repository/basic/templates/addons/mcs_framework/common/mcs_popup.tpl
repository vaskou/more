<script>
		
	$(function(){$ldelim}
	
		var mcs_popup_enable_cookie = '{$addons.mcs_framework.mcs_popup_cookie_enable}';
		
		var mcs_popup_content_type ='{$addons.mcs_framework.mcs_popup_content_types}';
		
		var mcs_popup_content_type_id;
		
		if(mcs_popup_content_type=='banner')
			mcs_popup_content_type_id='{$addons.mcs_framework.mcs_popup_content_banners}';
		if(mcs_popup_content_type=='promotion')
			mcs_popup_content_type_id='{$addons.mcs_framework.mcs_popup_content_promotions}';
		if(mcs_popup_content_type=='category')
			mcs_popup_content_type_id='{$addons.mcs_framework.mcs_popup_content_categories}';
		if(mcs_popup_content_type=='newsletter')
			mcs_popup_content_type_id='0';

		
		var mcs_popup_cookie = $.cookie.get('mcs_popup_'+mcs_popup_content_type+'_'+mcs_popup_content_type_id);

		if(mcs_popup_enable_cookie=='Y'&&!mcs_popup_cookie||mcs_popup_enable_cookie=='N')
			{$ldelim}
				$( "#mcs_popup" ).dialog(
					{$ldelim}
						width:'{$addons.mcs_framework.mcs_popup_styling_max_width}',
						closeText: '{__("close")}',
						dialogClass: "mcs_popup",
						draggable: true,
						resizable: false,
						show: {
							effect: '{$addons.mcs_framework.mcs_popup_effects_show}',
							easing: '{$addons.mcs_framework.mcs_popup_effects_show_easing}',
							duration: {$addons.mcs_framework.mcs_popup_effects_show_duration}
						},
						hide: {
							effect: '{$addons.mcs_framework.mcs_popup_effects_hide_effect}',
							easing: '{$addons.mcs_framework.mcs_popup_effects_hide_easing}',
							duration: {$addons.mcs_framework.mcs_popup_effects_hide_duration}
						},
						modal: true, 
						buttons:{$ldelim} 
									'{__("mcs_popup_do_not_show_again")}': function() 
										{$ldelim} 
											$( this ).dialog( "close" ); 
											createPopupCookie(mcs_popup_content_type,mcs_popup_content_type_id);
										{$rdelim}
								{$rdelim},
						close: function( event, ui ) {$ldelim}  {$rdelim}
					{$rdelim}
				);
			{$rdelim}

		$( "div.ui-widget-overlay" ).click(function() {
			$( ".ui-button.ui-dialog-titlebar-close" ).trigger( "click" );
		});		
		
		$( ".mcs_popup form" ).submit(function( event ) {
			createPopupCookie(mcs_popup_content_type,mcs_popup_content_type_id);
		});
		
		function createPopupCookie(type,id){

		
		
			var mcs_popup_enable_cookie = '{$addons.mcs_framework.mcs_popup_cookie_enable}';
			var mcs_popup_cookie_days = {$addons.mcs_framework.mcs_popup_cookie_days};
			var date = new Date();
			
			date.setTime(+ date + (mcs_popup_cookie_days * 86400000)); //24 * 60 * 60 * 1000
			
			if(mcs_popup_enable_cookie=='Y')
				document.cookie = "mcs_popup_"+type+"_"+id+"=1;expires="+date.toGMTString()+";;;";
		}
		
	{$rdelim});
	
</script>

{if $addons.mcs_framework.mcs_popup_content_types=='banner'}
	
	{assign var="banner" value=$addons.mcs_framework.mcs_popup_content_banners|fn_get_banner_data}
	{assign var="popup_title" value=$banner.banner}
	
	{if $banner.type=='G'}
		{assign var="popup_content" value="<img style='width:100%;' title='`$banner.banner`' alt='`$banner.main_pair.icon.alt`' src='`$banner.main_pair.icon.image_path`'>"}
	{/if}
	
	{if $banner.type=='T'}
		{assign var="popup_content" value=$banner.description}
	{/if}

{/if}

{if $addons.mcs_framework.mcs_popup_content_types=='promotion'}
	
	{assign var="promotion" value=$addons.mcs_framework.mcs_popup_content_promotions|fn_get_promotion_data}
	{assign var="popup_title" value=$promotion.name}
	{assign var="popup_content" value=$promotion.detailed_description}

	

{/if}

{if $addons.mcs_framework.mcs_popup_content_types=='category'}
	
	{assign var="category" value=$addons.mcs_framework.mcs_popup_content_categories|fn_get_category_data}
	{assign var="popup_title" value=$category.category}
	{assign var="popup_content" value=$category.description}
	{assign var="popup_content" value="<a href='index.php?dispatch=categories.view&category_id=`$category.category_id`'><img style='width:100%;' title='`$category.category`' alt='`$category.main_pair.detailed.alt`' src='`$category.main_pair.detailed.image_path`'></a>"}
	
{/if}

{if $addons.mcs_framework.mcs_popup_content_types=='newsletter'}
	
	{assign var="popup_title" value={__("newsletter")}}
	{assign var="popup_content" value="{include file="addons/news_and_emails/blocks/static_templates/subscribe.tpl"}"}
	
{/if}

<div id="mcs_popup" class="hidden" title="{$popup_title}">
	<div>
		{if $addons.mcs_framework.mcs_popup_content_types=='banner'&&$banner.url!=""&&$banner.type=="G"}
			<a href="{$banner.url}" {if $banner.target=='B'}target="_blank"{/if}>
		{/if}
			{$popup_content nofilter}
		{if $addons.mcs_framework.mcs_popup_content_types=='banner'&&$banner.url!=""&&$banner.type=="G"}
			</a>
		{/if}
	</div>
</div>

<style type="text/css">
	{literal}
	.ui-widget-overlay{
		background:{/literal} {$addons.mcs_framework.mcs_popup_styling_overlay_color}{literal}!important;
		opacity:{/literal} {$addons.mcs_framework.mcs_popup_styling_overlay_opacity}{literal}!important;
		filter:Alpha(Opacity={/literal} {$addons.mcs_framework.mcs_popup_styling_overlay_opacity*100}{literal})!important;
	}
	.ui-front{
		z-index:500 !important;
	}
	#mcs_popup a{
		outline:none!important;
	}		
	{/literal}
</style>

{if $addons.mcs_framework.mcs_popup_styling_show_title=='N'}
	<style type="text/css">
		{literal}
		.mcs_popup .ui-dialog-titlebar{
			display:none;
		}
		{/literal}
	</style>
{/if}

{if $addons.mcs_framework.mcs_popup_cookie_enable=='N'}
	<style type="text/css">
		{literal}
		.mcs_popup .ui-dialog-buttonpane{
			display:none;
		}
		{/literal}
	</style>
{/if}
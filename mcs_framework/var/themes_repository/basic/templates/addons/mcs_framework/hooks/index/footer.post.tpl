{if $addons.mcs_framework.mcs_scroll_to_top_enable=='Y'}

<script type="text/javascript">
//<![CDATA[
(function(_, $) {

	$(document).ready(function() {
		
		$.scrollUp({
			scrollName: 'scrollUp', // Element ID
			scrollDistance: {$addons.mcs_framework.mcs_scroll_to_top_distance}, // Distance from top/bottom before showing element (px)
			scrollFrom: '{$addons.mcs_framework.mcs_scroll_to_top_from}', // 'top' or 'bottom'
			scrollSpeed: {$addons.mcs_framework.mcs_scroll_to_top_speed}, // Speed back to top (ms)
			easingType: '{$addons.mcs_framework.mcs_scroll_to_top_easing}', // Scroll to top easing (see http://easings.net/)
			animation: '{$addons.mcs_framework.mcs_scroll_to_top_animation}', // Fade, slide, none
			animationInSpeed: 200, // Animation in speed (ms)
			animationOutSpeed: 200, // Animation out speed (ms)
			scrollText: '{__("mcs_scroll_to_top_label")}', // Text for element, can contain HTML
			scrollTitle: false, // Set a custom <a> title if required. Defaults to scrollText
			scrollImg: false, // Set true to use image
			activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
			zIndex: 2147483647 // Z-Index for the overlay
		});
		
	});

}(Tygh, Tygh.$));
//]]>
</script>

{/if}

{if $addons.mcs_framework.mcs_popup_enable=='Y'}
	{if $addons.mcs_framework.mcs_popup_content_pages=='home'}
		{if $_REQUEST.dispatch=='index.index'}
	
			{include file="addons/mcs_framework/common/mcs_popup.tpl"}
	
		{/if}
	{else}
			{include file="addons/mcs_framework/common/mcs_popup.tpl"}
	{/if}
{/if}
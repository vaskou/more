{assign var=w_count value=""|fn_wishlist_get_count}
<div id="wish_btn_{$block.snapping_id}">
	<a href="{"wishlist.view"|fn_url}" rel="nofollow">
	{if $w_count==-1}
		<i class="vs-icon-wishlist"></i>
	{else}
		<span class="mcs-badge">{$w_count}</span>
	{/if}
    {__("wishlist")}</a>
<!--wish_btn_{$block.snapping_id}--></div>
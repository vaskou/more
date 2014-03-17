<button title="{$alt}" class="go-button" type="submit">
	<i class="{if $addons.mcs_framework.mcs_button_icons_add_to_compare_list!=''}{$addons.mcs_framework.mcs_button_icons_go_button}{else}icon-right-dir{/if}"></i>
    {if $but_text}{$but_text}{/if}
</button>
<input type="hidden" name="dispatch" value="{$but_name}" />
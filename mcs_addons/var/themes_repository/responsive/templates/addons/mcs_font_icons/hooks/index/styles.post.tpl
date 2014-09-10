{style src="addons/mcs_font_icons/core.less"}

{foreach from=$addons.mcs_font_icons.mcs_icons_library key=k item=style}
	{if $k != 'N'}
	    {assign var=style_name value="_DOT_"|str_replace:".":$k}
    	{assign var=style_name value="_SLASH_"|str_replace:"/":$style_name}
	    {style src="addons/mcs_font_icons/libraries/`$style_name`"}
    {/if}
{/foreach}

{foreach from=$addons.mcs_font_icons.mcs_custom_icons key=k item=style}
	{if $k != 'N'}
	    {assign var=style_name value="_DOT_"|str_replace:".":$k}
    	{assign var=style_name value="_SLASH_"|str_replace:"/":$style_name}
	    {style src="addons/mcs_font_icons/custom/`$style_name`"}
    {/if}
{/foreach}
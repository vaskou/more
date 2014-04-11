{if $addons.mcs_framework.mcs_icomoon=='Y'}

{assign var=icons value="\n"|explode:$block.content.social_icons}
{assign var=border value=$block.properties.border}

{if $block.properties.rotate=="Y"}
	{assign var=rotate value="rotate"}
{/if}

{if $block.properties.shape=="square"}
	{assign var=fontsize value=$block.properties.size-$block.properties.padding*2-$block.properties.border*2}
	{assign var=lineheight value=$block.properties.size}
	{assign var=padding value=$block.properties.padding}
{/if}
{if $block.properties.shape=="rounded"}
	{assign var=fontsize value=$block.properties.size-$block.properties.border*2-$block.properties.padding*2}
	{assign var=lineheight value=$fontsize}
	{assign var=padding value=$block.properties.padding}
	
{/if}

{if $block.properties.text_pre!=""}
<div class="text_pre">{$block.properties.text_pre nofilter}</div>
{/if}

<div id="mcs_social_icons" class="icon_{$block.properties.color} iconhover_{$block.properties.colorhover} bg_{$block.properties.bg} bghover_{$block.properties.bghover} {$block.properties.shape} {$rotate} ">
	{foreach from=$icons item=icon}
		{assign var=props value=","|explode:$icon}
		<a title="{$props[2]}" target="_blank" href="{$props[1]}" class="{if $block.properties.tooltip=="Y"&&$props[2]!=""}cm-tooltip{/if}"><i class="icon-{$props[0]} " style="font-size:{$fontsize}px;line-height:{$lineheight}px;padding:{$padding}px;border-width:{$border}px;"></i></a>
	{/foreach}
</div>

{if $block.properties.text_post!=""}
<div class="text_post">{$block.properties.text_post nofilter}</div>
{/if}

{else}
	<div class="mcs-warning">
    	<h1 class="error-text"><i class="icon-warning"></i> You must enable IcoMoon libraries from More CS-Cart Framework,  in order the "More CS-Cart Social Icons" block to work.</h1>
    </div>
{/if}
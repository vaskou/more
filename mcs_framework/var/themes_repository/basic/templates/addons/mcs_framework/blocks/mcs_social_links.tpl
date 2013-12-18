{** block-description:mcs_social_links **}

{assign alignment $block.properties.mcs_social_icons_alignment}
{assign size $block.properties.mcs_social_icons_size}

{if $block.properties.mcs_social_icons_border=="Y"}
{assign border "border"}
{/if}

{if $block.properties.mcs_social_icons_shadow=="Y"}
{assign shadow "shadow"}
{/if}

{if $block.properties.mcs_social_icons_circle=="Y"}
{assign circle "circle"}
{/if}

{if $block.properties.mcs_social_icons_color=="Y"}
{assign color "color"}
{/if}

{if $block.properties.mcs_social_icons_white=="Y"}
{assign white "white"}
{/if}

<div id="mcs_social_links_{$block.snapping_id}" class="{$shadow} {$circle} {$color} {$white} {$alignment} {$size}" >

		{if $addons.mcs_framework.mcs_rss!=""}			<a title="RSS feed" target="_blank" href="{$addons.mcs_framework.mcs_rss}">			<i class="icon-fa-rss icon-border {$size} {$border}"></i></a>{/if}
		{if $addons.mcs_framework.mcs_twitter!=""}		<a title="Twitter" target="_blank" href="{$addons.mcs_framework.mcs_twitter}">		<i class="icon-fa-twitter icon-border {$size} {$border}		"></i></a>{/if}
		{if $addons.mcs_framework.mcs_facebook!=""}		<a title="Facebook" target="_blank" href="{$addons.mcs_framework.mcs_facebook}">		<i class="icon-fa-facebook icon-border {$size} {$border}	"></i></a>{/if}
		{if $addons.mcs_framework.mcs_googleplus!=""}	<a title="Google Plus" target="_blank" href="{$addons.mcs_framework.mcs_googleplus}">	<i class="icon-fa-google-plus icon-border {$size} {$border}	"></i></a>{/if}
		{if $addons.mcs_framework.mcs_linkedin!=""}		<a title="Linked In" target="_blank" href="{$addons.mcs_framework.mcs_linkedin}">		<i class="icon-fa-linkedin icon-border {$size} {$border}	"></i></a>{/if}
		{if $addons.mcs_framework.mcs_dribbble!=""}		<a title="Dribbble" target="_blank" href="{$addons.mcs_framework.mcs_dribbble}">		<i class="icon-fa-dribbble icon-border {$size} {$border}	"></i></a>{/if}
		{if $addons.mcs_framework.mcs_tumblr!=""}		<a title="Tumblr" target="_blank" href="{$addons.mcs_framework.mcs_tumblr}">		<i class="icon-fa-tumblr icon-border {$size} {$border}		"></i></a>{/if}
		{if $addons.mcs_framework.mcs_instagram!=""}	<a title="Instagram" target="_blank" href="{$addons.mcs_framework.mcs_instagram}">	<i class="icon-fa-instagram icon-border {$size} {$border}	"></i></a>{/if}
		{if $addons.mcs_framework.mcs_youtube!=""}		<a title="You Tube" target="_blank" href="{$addons.mcs_framework.mcs_youtube}">		<i class="icon-fa-youtube icon-border {$size} {$border}		"></i></a>{/if}
		{if $addons.mcs_framework.mcs_pinterest!=""}	<a title="Pinterest" target="_blank" href="{$addons.mcs_framework.mcs_pinterest}">	<i class="icon-fa-pinterest icon-border {$size} {$border}	"></i></a>{/if}
		{if $addons.mcs_framework.mcs_email!=""}		<a title="Email" target="_blank" href="mailto:{$addons.mcs_framework.mcs_email}">	<i class="icon-fa-envelope icon-border {$size} {$border}	"></i></a>{/if}

</div>
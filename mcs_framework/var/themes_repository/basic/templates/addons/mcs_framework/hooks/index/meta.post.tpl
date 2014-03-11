{if $addons.mcs_framework.mcs_general_responsive_enable=='Y'}

<meta name="viewport" content="width=device-width, initial-scale=1.0">
{literal}
<script>
(function() {
	if ("-ms-user-select" in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/)) {
		var msViewportStyle = document.createElement("style");
		msViewportStyle.appendChild(
			document.createTextNode("@-ms-viewport{width:auto!important}")
		);
		document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
	}
})();
</script>
{/literal}

{/if}

<!--[if (lte IE 9)]>
{styles use_scheme=true}
	{style src="addons/mcs_framework/mcs_general_styles_ie9.css"}
    {literal}<style>.qweasd{display:none;}</style>{/literal}
{/styles}
<![endif]-->
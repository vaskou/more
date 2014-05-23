{script src="js/theme_scripts/salus/mcs_header_hide.js"}

{if $addons.mcs_framework.mcs_general_responsive_enable=='Y'}
    {literal}
    <script>
    $(function(){
        enquire.register("screen and (min-width:1000px)",[
				header_hide_over_handler
            ]
        );
        enquire.register("screen and (max-width:999px)",[
				header_hide_under_handler
            ]
        );
    });
    </script>
    {/literal}
{else}
    {literal}
    <script>
    $(function(){
		fn_header_hide_over();
    });
    </script>
    {/literal}
{/if}
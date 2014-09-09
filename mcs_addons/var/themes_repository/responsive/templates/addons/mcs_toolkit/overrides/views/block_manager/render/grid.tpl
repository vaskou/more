{if $layout_data.layout_width != "fixed"}
    {if $parent_grid.width > 0}
        {$fluid_width = fn_get_grid_fluid_width($layout_data.width, $parent_grid.width, $grid.width)}
    {else}
        {$fluid_width = $grid.width}
    {/if}
{/if}



{if $grid.alpha}<div class="{if $layout_data.layout_width != "fixed"}row-fluid {else}row{/if} {if $grid.full_width==Y}mcs-full-width{/if}">{/if}
    <div class="span{$fluid_width|default:$grid.width}{if $grid.offset} offset{$grid.offset}{/if} {$grid.user_class}  {if $grid.block_grouping!='none'}mcs-{$grid.block_grouping}-grid{/if}" {if $grid.block_grouping!="none"}id="mcs-{$grid.block_grouping}-{$grid.grid_id}"{/if}>
        {if $grid.status == "A" && $content}
            {$content nofilter}
        {/if}
    </div>
    {if $grid.block_grouping=="accordion"}
    {literal}
        <script>
        $(function(){
            $('#mcs-{/literal}{$grid.block_grouping}-{$grid.grid_id}{literal}').each(function(){
                $(this).children('div').each(function(){
                    content='<h3>'+$(this).attr('data-title')+'</h3>';
					if($(this).hasClass('mcs-block-grouping-content')){
	                    $(this).before(content);
					}else{
						content='<h3>Error</h3>';
						$(this).before(content);
						$(this).replaceWith('<div class=""><h1 class="ty-error-text"><i class="icon-warning"></i> You have selected wrong wrapper for this block. Please select "More CS-Cart Block Grouping Wrapper".</h1></div>');
					}
                });
                $(this).accordion({ heightStyle: "content" });
            });
            
        });
        </script>
    {/literal}
    {/if}
    
    {if $grid.block_grouping=="tabs"}
    {literal}
        <script>
        $(function(){
            
            $('#mcs-{/literal}{$grid.block_grouping}-{$grid.grid_id}{literal}').each(function(){
                content='<ul>';
				i=0;
                $(this).children('div').each(function(){
					if($(this).hasClass('mcs-block-grouping-content')){
                    	content+='<li class="mcs-tab-button"><a href="#'+$(this).attr('id')+'">'+$(this).attr('data-title')+'</a></li>';
					}else{
						content+='<li><a href="#error'+i+'">Error</a></li>';
						$(this).replaceWith('<div id="error'+i+'" class="mcs-block-grouping-content"><h1 class="ty-error-text"><i class="icon-warning"></i> You have selected wrong wrapper for this block. Please select "More CS-Cart Block Grouping Wrapper".</h1></div>');
					}
					i++;
                });
                content+="</ul>";
                $(this).prepend(content);
                
                $(this).tabs();
            });
            
        });
        </script>  
    {/literal}      
    {/if}

{if $grid.omega}</div>{/if}

{*********************************************MCS changes****************************************************}
{*Line		11: Added {if $grid.full_width==Y}mcs-full-width{/if}											*}
{*Line		12: Added {if $grid.block_grouping!="none"}id="mcs-{$grid.block_grouping}-{$grid.grid_id}"{/if}	*}
{*Line		12: Added {if $grid.block_grouping!='none'}mcs-{$grid.block_grouping}-grid{/if}					*}
{*Lines	 17-38: Added lines 17-38																			*}
{*Lines	 40-66: Added lines 40-66																			*}
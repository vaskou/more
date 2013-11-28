<div class="mcs_search">
    <a class="mcs_search_button"><i class="icon-search"></i></a>
    <div class="search-block" style="display:none;">
        <form action="{""|fn_url}" name="search_form" method="get">
        <input type="hidden" name="subcats" value="Y" />
        <input type="hidden" name="status" value="A" />
        <input type="hidden" name="pshort" value="Y" />
        <input type="hidden" name="pfull" value="Y" />
        <input type="hidden" name="pname" value="Y" />
        <input type="hidden" name="pkeywords" value="Y" />
        <input type="hidden" name="search_performed" value="Y" />
        
        {hook name="search:additional_fields"}{/hook}
        
        {strip}
            {if $settings.General.search_objects}
                {assign var="search_title" value=__("search")}
            {else}
                {assign var="search_title" value=__("search_products")}
            {/if}
            <div class="search_box">
            <input type="text" name="q" value="{$search.q}" id="search_input{if $smarty.capture.search_input_id}_{$smarty.capture.search_input_id}{/if}" title="{$search_title}" class="search-input cm-hint"/>
            {if $settings.General.search_objects}
                <button title="{__('search')}" class="search-magnifier" type="submit"><i class="icon-search"></i></button>
                <input type="hidden" name="dispatch" value="search.results" />
            {else}
                <button title="{__('search')}" class="search-magnifier" type="submit"><i class="icon-search"></i></button>
                <input type="hidden" name="dispatch" value="products.search" />
            {/if}
            </div>
        {/strip}
        
        {capture name="search_input_id"}{math equation="x + y" x=$smarty.capture.search_input_id|default:1 y=1 assign="search_input_id"}{$search_input_id}{/capture}
        </form>
    </div>
</div>

{script src="js/addons/mcs_master/mcs_search.js"}
{hook name="blocks:mcs_menu_i"}

{if $items}
    <ul class="ty-menu__items cm-responsive-menu">
        {hook name="blocks:mcs_topmenu_dropdown_top_menu"}
            <li class="ty-menu__item ty-menu__menu-btn visible-phone">
                <a class="ty-menu__item-link">
                    <i class="ty-icon-short-list"></i>
                    <span>{__("menu")}</span>
                </a>
            </li>

        {foreach from=$items item="item1" name="item1"}
            {assign var="item1_url" value=$item1|fn_form_dropdown_object_link:$block.type}
            {assign var="unique_elm_id" value=$item1_url|md5}
            {assign var="unique_elm_id" value="topmenu_`$block.block_id`_`$unique_elm_id`"}
			
            {capture name="mcs_brands_list"}
            	<li class="ty-top-mine__submenu-col hidden-phone mcs-brands-list">
                    {assign var=params value=['view_all'=>'Y','get_custom'=>'Y','filter_id'=>$block.properties.mcs_brand_filter,'category_id'=>$item1.category_id]}
                    {assign var="view_all_filter" value=$params|fn_get_filters_products_count}
                    {assign var="counter" value=0}
                    {foreach from=$view_all_filter item="itm"}
                        {if $itm|count > 0}
                            <div class="ty-menu__submenu-item-header">
                                <a href="{"product_features.view_all&filter_id=`$block.properties.mcs_brand_filter`&category_id=`$params.category_id`"|fn_url}" class="ty-menu__submenu-link">{$block.properties.mcs_brand_filter|fn_get_product_filter_name}</a>
                            </div>
                            <div class="ty-menu__submenu">
                                <ul class="ty-menu__submenu-list cm-responsive-menu-submenu">
                                    {foreach from=$itm item="ranges" key="index"}
                                    {strip}
                                        {if $ranges}                                                            
                                            {foreach from=$ranges item="range"}
                                                {$counter = $counter + 1}
                                                {if $block.properties.dropdown_third_level_elements >= $counter}
                                                    <li class="ty-menu__submenu-item">
                                                        <a href="{"categories.view?category_id=`$params.category_id`&features_hash=V`$range.range_id`"|fn_url}" class="">
                                                            {$range.range_name|fn_text_placeholders}
                                                        </a>
                                                    </li>
                                                {elseif $block.properties.dropdown_third_level_elements + 1 == $counter}
                                                    <li class="ty-menu__submenu-item ty-menu__submenu-alt-link">
                                                        <a href="{"product_features.view_all&filter_id=`$block.properties.mcs_brand_filter`&category_id=`$params.category_id`"|fn_url}" class="ty-menu__submenu-link">{__("text_topmenu_view_more")}</a>
                                                    </li>
                                                {else}
                                                    {break}
                                                {/if}
                                            {/foreach}
                                        
                                        {else}&nbsp;{/if}
                                    {strip}
                                    {/foreach}
                                </ul>
                            </div>
                        {/if}
                    {/foreach}
                </li>
            {/capture}
            
            {capture name="mcs_simple_menu_without_brands"}
            	<div class="ty-menu__submenu">
                    <ul class="ty-menu__submenu-items ty-menu__submenu-items-simple cm-responsive-menu-submenu">
                        {hook name="blocks:topmenu_dropdown_2levels_elements"}

                        {foreach from=$item1.$childs item="item2" name="item2"}
                            {assign var="item_url2" value=$item2|fn_form_dropdown_object_link:$block.type}
                            <li class="ty-menu__submenu-item{if $item2.active || $item2|fn_check_is_active_menu_item:$block.type} ty-menu__submenu-item-active{/if}">
                                <a class="ty-menu__submenu-link" {if $item_url2} href="{$item_url2}"{/if}>{$item2.$name}</a>
                            </li>
                        {/foreach}
                        {if $item1.show_more && $item1_url}
                            <li class="ty-menu__submenu-item ty-menu__submenu-alt-link">
                                <a href="{$item1_url}"
                                   class="ty-menu__submenu-alt-link">{__("text_topmenu_view_more")}</a>
                            </li>
                        {/if}

                        {/hook}
                    </ul>
                </div>
            {/capture}
            
            {capture name="mcs_simple_menu_with_brands"}
            	<div class="ty-menu__submenu">
                    <ul class="ty-menu__submenu-items cm-responsive-menu-submenu">
                        {hook name="blocks:mcs_topmenu_dropdown_2levels_elements"}
                        <li class="ty-top-mine__submenu-col">
                            <div class="ty-menu__submenu-item-header {if $item1.active || $item1|fn_check_is_active_menu_item:$block.type} ty-menu__submenu-item-header-active{/if}">
                                <a{if $item1_url} href="{$item1_url}"{/if} class="ty-menu__submenu-link">{$item1.$name}</a>
                            </div>
                            {if $item1.$childs}
                                <a class="ty-menu__item-toggle visible-phone cm-responsive-menu-toggle">
                                    <i class="ty-menu__icon-open ty-icon-down-open"></i>
                                    <i class="ty-menu__icon-hide ty-icon-up-open"></i>
                                </a>
                            {/if}
                            <div class="ty-menu__submenu">
                                <ul class="ty-menu__submenu-list cm-responsive-menu-submenu">
                                {foreach from=$item1.$childs item="item2" name="item2"}
                                    {assign var="item_url2" value=$item2|fn_form_dropdown_object_link:$block.type}
                                    <li class="ty-menu__submenu-item{if $item2.active || $item2|fn_check_is_active_menu_item:$block.type} ty-menu__submenu-item-active{/if}">
                                        <a class="ty-menu__submenu-link" {if $item_url2} href="{$item_url2}"{/if}>{$item2.$name}</a>
                                    </li>
                                {/foreach}
                                {if $item1.show_more && $item1_url}
                                    <li class="ty-menu__submenu-item ty-menu__submenu-alt-link">
                                        <a href="{$item1_url}"
                                           class="ty-menu__submenu-alt-link">{__("text_topmenu_view_more")}</a>
                                    </li>
                                {/if}
                                </ul>
                            </div>
                        </li>
                        {/hook}
                        {if $block.properties.mcs_show_brand_filter=='Y'}
                            {$smarty.capture.mcs_brands_list nofilter}
                        {/if}
                    </ul>
                </div>
            {/capture}
            
            {if $subitems_count}

            {/if}
            <li class="ty-menu__item {if !$item1.$childs} ty-menu__item-nodrop{else} cm-menu-item-responsive{/if} {if $item1.active || $item1|fn_check_is_active_menu_item:$block.type} ty-menu__item-active{/if}">
                    {if $item1.$childs}
                        <a class="ty-menu__item-toggle visible-phone cm-responsive-menu-toggle">
                            <i class="ty-menu__icon-open ty-icon-down-open"></i>
                            <i class="ty-menu__icon-hide ty-icon-up-open"></i>
                        </a>
                    {/if}
                    <a {if $item1_url} href="{$item1_url}"{/if} class="ty-menu__item-link">
                        {$item1.$name}
                    </a>
                {if $item1.$childs}

                    {if !$item1.$childs|fn_check_second_level_child_array:$childs  && ($block.properties.mcs_top_menu_show_images!='Y')}
                    {* Only two levels. Vertical output *}
                        {if $block.properties.mcs_show_brand_filter=='Y'}
                        	{$smarty.capture.mcs_simple_menu_with_brands nofilter}
                        {else}
                        	{$smarty.capture.mcs_simple_menu_without_brands nofilter}
                        {/if}
                    {else}
                        <div class="ty-menu__submenu" id="{$unique_elm_id}">
                            {hook name="blocks:mcs_topmenu_dropdown_3levels_cols"}
                                <ul class="ty-menu__submenu-items cm-responsive-menu-submenu">
                                    {foreach from=$item1.$childs item="item2" name="item2"}
                                        <li class="ty-top-mine__submenu-col">
                                            {assign var="item2_url" value=$item2|fn_form_dropdown_object_link:$block.type}
                                            <div class="ty-menu__submenu-item-header {if $item2.active || $item2|fn_check_is_active_menu_item:$block.type} ty-menu__submenu-item-header-active{/if}">
                                                <a{if $item2_url} href="{$item2_url}"{/if} class="ty-menu__submenu-link">{$item2.$name}</a>
                                            </div>
                                            {assign var="img_path" value=$item2.category_id|fn_get_image_pairs:"category":"M"}
                                            {if $img_path && ($block.properties.mcs_top_menu_show_images=='Y')}
                                                <div class="mcs-category-img visible-desktop">
                                                    <a{if $item2_url} href="{$item2_url}"{/if}>
                                                    <!--<img src="{$img_path.detailed.image_path}" />-->
                                                    {include file="common/image.tpl" images=$img_path image_height=$block.properties.mcs_top_menu_category_image_height image_width=$block.properties.mcs_top_menu_category_image_width}
                                                    </a>
                                                </div>
                                            {/if}            
                                            {if $item2.$childs}
                                                <a class="ty-menu__item-toggle visible-phone cm-responsive-menu-toggle">
                                                    <i class="ty-menu__icon-open ty-icon-down-open"></i>
                                                    <i class="ty-menu__icon-hide ty-icon-up-open"></i>
                                                </a>
                                            {/if}
                                            <div class="ty-menu__submenu">
                                                <ul class="ty-menu__submenu-list cm-responsive-menu-submenu">
                                                    {if $item2.$childs}
                                                        {hook name="blocks:mcs_topmenu_dropdown_3levels_col_elements"}
                                                        {foreach from=$item2.$childs item="item3" name="item3"}
                                                            {assign var="item3_url" value=$item3|fn_form_dropdown_object_link:$block.type}
                                                            <li class="ty-menu__submenu-item{if $item3.active || $item3|fn_check_is_active_menu_item:$block.type} ty-menu__submenu-item-active{/if}">
                                                                <a{if $item3_url} href="{$item3_url}"{/if}
                                                                        class="ty-menu__submenu-link">{$item3.$name}</a>
                                                            </li>
                                                        {/foreach}
                                                        {if $item2.show_more && $item2_url}
                                                            <li class="ty-menu__submenu-item ty-menu__submenu-alt-link">
                                                                <a href="{$item2_url}"
                                                                   class="ty-menu__submenu-link">{__("text_topmenu_view_more")}</a>
                                                            </li>
                                                        {/if}
                                                        {/hook}
                                                    {/if}
                                                </ul>
                                            </div>
                                        </li>
                                    {/foreach}
                                    {if $block.properties.mcs_show_brand_filter=='Y'}
                                        {$smarty.capture.mcs_brands_list nofilter}
                                    {/if}
                                    {if $item1.show_more && $item1_url}
                                        <li class="ty-menu__submenu-dropdown-bottom">
                                            <a href="{$item1_url}">{__("text_topmenu_more", ["[item]" => $item1.$name])}</a>
                                        </li>
                                    {/if}
                                </ul>
                            {/hook}
                        </div>
                    {/if}

                {/if}
            </li>
        {/foreach}

        {/hook}
    </ul>
{/if}
{if $block.properties.mcs_top_menu_hide_third_level=='Y'}
	{script src="js/addons/mcs_menu_i/mcs_menu_i.js"}
{/if}
{/hook}

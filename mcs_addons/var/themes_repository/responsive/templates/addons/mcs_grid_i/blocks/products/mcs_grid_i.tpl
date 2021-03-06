{** block-description:mcs_grid_i **}

{if $block.properties.hide_add_to_cart_button == "Y"}
    {assign var="_show_add_to_cart" value=false}
{else}
    {assign var="_show_add_to_cart" value=true}
{/if}
{if $block.properties.show_price == "Y"}
    {assign var="_hide_price" value=false}
{else}
    {assign var="_hide_price" value=true}
{/if}

{include file="addons/mcs_grid_i/blocks/list_templates/mcs_grid_i_list.tpl"
products=$items
columns=$block.properties.number_of_columns
form_prefix="block_manager"
no_sorting="Y"
no_pagination="Y"
no_ids="Y"
obj_prefix="`$block.block_id`000"
item_number=$block.properties.item_number
show_trunc_name=true
show_old_price=true
show_price=true
show_rating=true
show_clean_price=true
show_list_discount=true
show_add_to_cart=$_show_add_to_cart
but_role="action"
show_discount_label=true
show_features=true
show_list_buttons=false
show_descr=true 
show_product_rating=$block.properties.show_product_rating 
hide_price=$_hide_price 
enable_add_to_wish=$block.properties.enable_add_to_wish 
enable_add_to_compare=$block.properties.enable_add_to_compare 
enable_quick_view=$block.properties.enable_quick_view}
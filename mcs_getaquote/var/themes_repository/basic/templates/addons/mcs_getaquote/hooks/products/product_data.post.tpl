{capture name="form_open_`$obj_id`"}
{if !$hide_form}
<form action="{""|fn_url}" method="post" name="product_form_{$obj_prefix}{$obj_id}" enctype="multipart/form-data" class="cm-disable-empty-files {if $is_ajax} cm-ajax cm-ajax-full-render cm-ajax-status-middle{/if} {if $form_meta}{$form_meta}{/if}">
<input type="hidden" name="result_ids" value="cart_status*,wish_list*,checkout*,account_info*,vendor_wishlist*,wish_btn*" />
{if !$stay_in_cart}
<input type="hidden" name="redirect_url" value="{$redirect_url|default:$config.current_url}" />
{/if}
<input type="hidden" name="product_data[{$obj_id}][product_id]" value="{$product.product_id}" />
{/if}
{/capture}

{* Get a quote button login popup *}
{if !$auth.user_id}
    {if $settings.General.secure_auth != "Y"}
        <div  id="login_block{$block.snapping_id}" class="hidden" title="{__("sign_in")}">
            <div class="login-popup">
                {include file="views/auth/login_form.tpl" style="popup" id="popup`$block.snapping_id`"}
            </div>
        </div>
    {/if}
{/if}
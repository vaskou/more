<div class="control-group cm-non-cb{if $option_data.option_type == "C"} hidden{/if} mcs_related_product">
    <label class="control-label">{__("product")}</label>
    <div class="controls">
        {include file="pickers/products/picker.tpl" data_id="mcs_related_product" input_name="option_data[variants][`$num`][mcs_related_product]" no_item_text=__("text_no_items_defined", ["[items]" => __("products")]) type="table" company_id=$company_id placement="right" item_ids=$vr.mcs_related_product display="options"}
    </div>
</div>
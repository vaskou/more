<div class="control-group">
    <label class="control-label" for="elm_feature_lock">{__("mcs_lock_feature")}</label>
    <div class="controls">
        <input type="hidden" name="feature_data[variants][{$num}][mcs_lock_feature]" value="N" />
        <input type="checkbox" name="feature_data[variants][{$num}][mcs_lock_feature]" value="Y" {if $var.mcs_lock_feature == "Y"}checked="checked"{/if} />
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-2 col-md-4 control-label">{{ trans('labels.products_attributes') }}</label>
    <div class="col-sm-10 col-md-8">
    <input type='hidden' id='has-attribute' value='1'>
        <input type='hidden' id='has-attribute' value='0'>
            <div class="alert alert-info" role="alert">
              {{ trans('labels.Now you can add stock for simple product') }}
            </div>
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
            {{ trans('labels.Select Option values Text') }}.</span>
        <span class="help-block hidden">{{ trans('labels.Select Option values Text') }}</span>
    </div>
</div>




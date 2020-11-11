
<div class="form-group">
    <label for="name" class="col-sm-2 col-md-4 control-label">{{ trans('labels.products_attributes') }}</label>
    <div class="col-sm-10 col-md-8">
    <ul class="list-group list-group-root well list-group-root2">
        @foreach ($result['attributes'] as $attribute)
        <li href="#" class="list-group-item"><label style="width:100%">
                <input id="attribute" type="hidden" class="attributeid_<?=$attribute['option']['id']?>" name="attributeid[]" value=""> {{ $attribute['option']['name']}}</label></li>
        <ul class="list-group">
            <li class="list-group-item">
                @foreach ($attribute['values'] as $value)<label><input name="values_<?=$attribute['option']['id']?>" type="radio" class="currentstock required_one" value="{{ $value['products_attributes_id'] }}"
                        attributeid="{{ $attribute['option']['id'] }}"> {{ $value['value'] }}</label> @endforeach</li>
        </ul>
        @endforeach
    </ul>
        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
            {{ trans('labels.Select Option values Text') }}.</span>
        <span class="help-block hidden">{{ trans('labels.Select Option values Text') }}</span>
    </div>
</div>




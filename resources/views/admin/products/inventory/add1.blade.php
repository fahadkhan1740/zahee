@extends('admin.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> {{ trans('labels.Inventory') }} <small>{{ trans('labels.Inventory') }}...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li><a href="{{ URL::to('admin/products/display') }}"><i class="fa fa-database"></i> {{ trans('labels.ListingAllProducts') }}</a></li>
            @if(count($result['products'])> 0 && $result['products'][0]->products_type==1)
            <li><a href="{{ URL::to('admin/products/attach/attribute/display/'.$result['products'][0]->products_id) }}">{{ trans('labels.AddOptions') }}</a></li>
            @endif
            <li class="active">{{ trans('labels.Inventory') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('labels.addinventory') }} </h3>

                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-xs-12">
                                @if (count($errors) > 0)
                                @if($errors->any())
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {{$errors->first()}}
                                </div>
                                @endif
                                @endif
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!-- form start -->
                                    <div class="box-body">
                                        <div class="row">
                                            <!-- Left col -->
                                            <div class="col-md-6">
                                                <!-- MAP & BOX PANE -->
                                                <!-- /.box -->
                                                <div class="row">
                                                    <!-- /.col -->
                                                    <div class="col-md-12">
                                                        <!-- USERS LIST -->
                                                        <div class="box box-info">
                                                            <!-- /.box-header -->
                                                            <div class="box-body">
                                                                {!! Form::open(array('url' =>'admin/products/inventory/addnewstock', 'name'=>'inventoryfrom', 'id'=>'addewinventoryfrom', 'method'=>'post', 'class' => 'form-horizontal form-validate',
                                                                'enctype'=>'multipart/form-data')) !!}

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">{{ trans('labels.Products') }}<span style="color:red;">*</span> </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <select class="form-control field-validate select2" id="products_id" name="products_id" onchange="getProductDetails(this)">
                                                                            @foreach($result['products'] as $pd)
                                                                                <option value="{{$pd->products_id}}">{{$pd->products_name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            {{ trans('labels.Product Type Text') }}.</span>
                                                                    </div>
                                                                </div>
                                                                <div id="attribute" style="display:none">

                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">
                                                                        {{ trans('labels.Current Stock') }}
                                                                    </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <p id="current_stocks" style="width:100%">0</p><br>
                                                                        <a href="javascript:void(0);" id="deleteStock" >Delete current stock</a>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">
                                                                        {{ trans('labels.Total Purchase Price') }}
                                                                    </label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <p class="purchase_price_content" style="width:100%">{{ $result['currency'][19]->value }}<span id="total_purchases">0</span></p><br>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">{{ trans('labels.Enter Stock') }}<span style="color:red;">*</span></label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="stock" value="" class="form-control number-validate">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            {{ trans('labels.Enter Stock Text') }}</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="name" class="col-sm-2 col-md-4 control-label">{{ trans('labels.Purchase Price') }}<span style="color:red;">*</span></label>
                                                                    <div class="col-sm-10 col-md-8">
                                                                        <input type="text" name="purchase_price" value="" class="form-control number-validate">
                                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                                            {{ trans('labels.Purchase Price Text') }}</span>
                                                                    </div>
                                                                </div>

                                                                <!-- /.users-list -->
                                                            </div>
                                                                <div class="box-footer text-center">
                                                                    <button type="submit" id="attribute-btn" class="btn btn-primary pull-right">{{ trans('labels.Add Stock') }}</button>
                                                                </div>
                                                            {!! Form::close() !!}
                                                            <!-- /.box-footer -->
                                                        </div>
                                                        <!--/.box -->
                                                    </div>

                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
    <!-- /.row -->
    <!-- Main row -->
</div>
<!-- /.row -->
@endsection

@section('scripts')
<script>
function getProductDetails(selectObject) {
  var product_id = selectObject.value;
  $.ajax({
		url: '{{ URL::to("admin/products/inventory/ajax_attr")}}'+'/'+product_id,
		type: "GET",
		success: function (res) {
			$('#attribute').html(res);
			$('#attribute').show();
			// var has_val = $('#has-attribute').val();
			// if(has_val==0){
			// 	$('#attribute-btn').hide();
			// }else{
			// 	$('#attribute-btn').show();
			// }
		},
    });

    $.ajax({
		url: '{{ URL::to("admin/products/inventory/ajax_min_max")}}'+'/'+product_id,
		type: "GET",
		success: function (res) {
		$('#current_stocks').html(res.stocks);
		$('#total_purchases').html(res.purchase_price);

		if(res.length != ''){
			$('#min_level').val(res.min_level);
			$('#max_level').val(res.max_level);
			$('#purchase_price').val(res.purchase_price);
			$('#stocks').val(res.stocks);

		}else{
			$('.addError').show();
		}
		},
	});
}

$('#deleteStock').click(function() {
    var prod_id = $( "#products_id" ).val();
    var current_stock = $('#current_stocks').text();

    $.ajax({
		url: '{{ URL::to("admin/products/inventory/deleteStock")}}'+'/'+prod_id+'/'+current_stock,
		type: "GET",
		success: function (res) {
            if(res.status) {
                $('#current_stocks').html(0);
            }
		}
	});

});
</script>
@endsection


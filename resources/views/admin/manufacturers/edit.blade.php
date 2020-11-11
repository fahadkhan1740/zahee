@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> {{ trans('labels.Manufacturer') }}  <small>{{ trans('labels.EditCurrentManufacturer') }}...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('admin/dashboard/this_month') }}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
                <li><a href="{{ URL::to('admin/listingManufacturer')}}"><i class="fa fa-industry"></i> {{ trans('labels.Manufacturer') }}</a></li>
                <li class="active">{{ trans('labels.EditManufacturer') }}</li>
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
                            <h3 class="box-title">{{ trans('labels.EditManufacturerInfo') }} </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <br>

                                        @if (session('update'))
                                            <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong> {{ session('update') }} </strong>
                                            </div>
                                        @endif

                                        @if (count($errors) > 0)
                                            @if($errors->any())
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    {{$errors->first()}}
                                                </div>
                                        @endif
                                    @endif
                                    <!-- /.box-header -->
                                        <!-- form start -->
                                        <div class="box-body">


                                            {!! Form::open(array('url' =>'admin/manufacturers/update', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')) !!}
                                            {!! Form::hidden('id',  $editManufacturer[0]->id , array('class'=>'form-control', 'id'=>'id')) !!}
                                            {!! Form::hidden('oldImage',  $editManufacturer[0]->image , array('id'=>'oldImage')) !!}


                                            @foreach($editManufacturer as $ed)
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Name') }}<span style="color:red;">*</span> @if($ed->languages_id == 1) (English) @elseif($ed->languages_id == 4) (Arabic) @endif</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input name="categoryName_<?=$ed->languages_id?>" class="form-control field-validate" value="{{$ed->name}}">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">

                                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="editor<?=$ed->languages_id?>" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Description') }}<span style="color:red;">*</span></label>
                                                <div class="col-sm-10 col-md-8">
                                                    <textarea id="editor<?=$ed->languages_id?>" name="products_description_<?=$ed->languages_id?>" class="form-control" rows="5">{{stripslashes($ed->description)}}</textarea>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                                </div>
                                            </div>
                                            @endforeach


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.slug') }} </label>
                                                <div class="col-sm-10 col-md-4">
                                                    <input type="hidden" name="old_slug" value="{{$editManufacturer[0]->slug}}">
                                                    <input type="text" name="slug" class="form-control field-validate" value="{{$editManufacturer[0]->slug}}">
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;margin-top: 0;">{{ trans('labels.slugText') }}</span>
                                                    <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.ManufacturerURL') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {!! Form::text('manufacturers_url',  $editManufacturer[0]->url , array('class'=>'form-control', 'id'=>'manufacturers_url'), value(old('manufacturers_url')))  !!}
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">{{ trans('labels.ManufacturerURLText') }}</span>
                                                </div>
                                            </div>

                                            <!--  -->

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Image') }}</label>
                                                <div class="col-sm-10 col-md-4">
                                                    {{--{!! Form::file('newImage', array('id'=>'newImage')) !!}--}}
                                                    <!-- Modal -->
                                                        <div class="modal fade embed-images" id="Modalmanufactured" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" id ="closemodal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                        <h3 class="modal-title text-primary" id="myModalLabel">{{ trans('labels.Choose Image') }} </h3>
                                                                    </div>
                                                                    <div class="modal-body manufacturer-image-embed">
                                                                        @if(isset($allimage))
                                                                            <select class="image-picker show-html " name="image_id" id="select_img">
                                                                                <option  value=""></option>
                                                                                @foreach($allimage as $key=>$image)
                                                                                    <option data-img-src="{{asset($image->path)}}"  class="imagedetail" data-img-alt="{{$key}}" value="{{$image->id}}"> {{$image->id}} </option>
                                                                                @endforeach
                                                                            </select>
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                      <a href="{{url('admin/media/add')}}" target="_blank" class="btn btn-primary pull-left" >{{ trans('labels.Add Icon') }}</a>
                                                                      <button type="button" class="btn btn-default refresh-image"><i class="fa fa-refresh"></i></button>
                                                                      <button type="button" class="btn btn-success" id="selectedICONE" data-dismiss="modal">{{ trans('labels.Done') }}</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div  id ="imageselected">
                                                            {!! Form::button(trans('labels.Add Image'), array('id'=>'newImage','class'=>"btn btn-primary", 'data-toggle'=>"modal", 'data-target'=>"#Modalmanufactured" )) !!}
                                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 3px;">{{ trans('labels.LanguageFlag') }}</span>
                                                            <div class="closimage">
                                                                <button type="button" class="close pull-right" id="image-close" style="display: none; position: absolute;left: 91px; top: 54px; background-color: black; color: white; opacity: 2.2;" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div  id="selectedthumbnail"></div>
                                                            <br>
                                                            {!! Form::hidden('oldImage', $editManufacturer[0]->image, array('id'=>'oldImage')) !!}
                                                            @if(($editManufacturer[0]->path!== null))
                                                                <img width="80px" src="{{asset($editManufacturer[0]->path)}}" class="img-circle">
                                                            @else
                                                                <img width="80px" src="{{asset($editManufacturer[0]->path) }}" class="img-circle">
                                                            @endif

                                                        </div>

                                                </div>

                                            </div>

                                            <div class="form-group">
                                  <label for="name" class="col-sm-2 col-md-3 control-label">{{ trans('labels.Status') }}</label>
                                  <div class="col-sm-10 col-md-4">
                                      <select class="form-control" name="status">
                                          <option value="1" @if($editManufacturer[0]->is_active==1) selected @endif>{{ trans('labels.Active') }}</option>
                                          <option value="0" @if($editManufacturer[0]->is_active==0) selected @endif>{{ trans('labels.InActive') }}</option>
                                      </select>
                                      <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                      {{ trans('labels.StatusBannerText') }}</span>
                                  </div>
                                </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                                <a href="{{ URL::to('admin/manufacturers/display')}}" type="button" class="btn btn-default">{{ trans('labels.back') }}</a>
                                            </div>
                                            <!-- /.box-footer -->
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(function() {
        @foreach($result['languages'] as $languages)
            CKEDITOR.replace('editor{{$languages->languages_id}}', {
                language: '{{$languages->code}}'
            });
        @endforeach
        $(".textarea").wysihtml5();

    });
</script>
@endsection

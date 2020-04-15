
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> <?php echo e(trans('labels.UPSShippingSetting')); ?> <small><?php echo e(trans('labels.Setting')); ?>...</small> </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo e(URL::to('admin/dashboard/this_month')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('labels.breadcrumb_dashboard')); ?></a></li>
                <li><a href="<?php echo e(URL::to('admin/shippingmethods/display')); ?>"><i class="fa fa-dashboard"></i><?php echo e(trans('labels.ShippingMethods')); ?></a></li>
                <li class="active"><?php echo e(trans('labels.UPSShippingSetting')); ?></li>
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
                            <h3 class="box-title"><?php echo e(trans('labels.UPSShippingSetting')); ?></h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <?php if(count($errors) > 0): ?>
                                        <?php if($errors->any()): ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo e($errors->first()); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-info">
                                        <!-- form start -->
                                        <div class="box-body">
                                            <?php echo Form::open(array('url' =>'admin/shippingmethods/updateupsshipping', 'method'=>'post', 'class' => 'form-horizontal form-validate', 'enctype'=>'multipart/form-data')); ?>

                                            <?php echo Form::hidden('table_name',  $result['ups_shipping']['ups_description'][0]->table_name , array('class'=>'form-control', 'id'=>'table_name')); ?>

                                            <div class="form-group">
                                                <label for="shippingEnvironment" class="col-sm-2 col-md-3 control-label" style=""><?php echo e(trans('labels.TestProductionMode')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <label class=" control-label">
                                                        <input type="radio" name="shippingEnvironment" value="0" class="flat-red" <?php if($result['ups_shipping']['ups_shipping']->shippingEnvironment==0): ?> checked <?php endif; ?> > &nbsp;<?php echo e(trans('labels.Test')); ?>

                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label class=" control-label">
                                                        <input type="radio" name="shippingEnvironment" value="1" class="flat-red" <?php if($result['ups_shipping']['ups_shipping']->shippingEnvironment==1): ?> checked <?php endif; ?> >  &nbsp; <?php echo e(trans('labels.Production')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.ShippingServiceType')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="serviceType[]" class="form-control" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                        <option <?php if(in_array('US_01', explode(',', $result['ups_shipping']['ups_shipping']->serviceType))): ?> selected <?php endif; ?> value="US_01"><?php echo e(trans('labels.NextDayAir')); ?> </option>
                                                        <option <?php if(in_array('US_02', explode(',', $result['ups_shipping']['ups_shipping']->serviceType))): ?> selected <?php endif; ?> value="US_02"><?php echo e(trans('labels.2ndDayAir')); ?> </option>
                                                        <option <?php if(in_array('US_03', explode(',', $result['ups_shipping']['ups_shipping']->serviceType))): ?> selected <?php endif; ?> value="US_03"><?php echo e(trans('labels.Ground')); ?></option>
                                                    <!--<option <?php if(in_array('IN_07', explode(',', $result['ups_shipping']['ups_shipping']->serviceType))): ?> selected <?php endif; ?> value="IN_07">Worldwide Express </option>-->
                                                    <!--<option <?php if(in_array('IN_54', explode(',', $result['ups_shipping']['ups_shipping']->serviceType))): ?> selected <?php endif; ?> value="IN_54">Worldwide Express Plus</option>-->
                                                    <!--<option <?php if(in_array('IN_08', explode(',', $result['ups_shipping']['ups_shipping']->serviceType))): ?> selected <?php endif; ?> value="IN_08">Worldwide Expedited</option>-->
                                                    <!--<option <?php if(in_array('IN_11', explode(',', $result['ups_shipping']['ups_shipping']->serviceType))): ?> selected <?php endif; ?> value="IN_11">Standard</option>-->
                                                        <option <?php if(in_array('US_12', explode(',', $result['ups_shipping']['ups_shipping']->serviceType))): ?> selected <?php endif; ?> value="US_12"><?php echo e(trans('labels.3DaySelect')); ?> </option>
                                                        <option <?php if(in_array('US_13', explode(',', $result['ups_shipping']['ups_shipping']->serviceType))): ?> selected <?php endif; ?> value="US_13"><?php echo e(trans('labels.NextDayAirSaver')); ?> </option>
                                                        <option <?php if(in_array('US_14', explode(',', $result['ups_shipping']['ups_shipping']->serviceType))): ?> selected <?php endif; ?> value="US_14"><?php echo e(trans('labels.NextDayAirEarlyAM')); ?></option>
                                                        <option <?php if(in_array('US_59', explode(',', $result['ups_shipping']['ups_shipping']->serviceType))): ?> selected <?php endif; ?> value="US_59"><?php echo e(trans('labels.2ndDayAirAM')); ?></option>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    <?php echo e(trans('labels.ShippingServiceTypeText')); ?></span>

                                                </div>
                                            </div>
                                        <!--<div class="form-group">
								
								<div class="col-sm-10 col-md-4">
									
                                                <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">

								</div>
							</div>-->
                                            <?php $__currentLoopData = $result['description']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $description_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Name')); ?> (<?php echo e($description_data['language_name']); ?>)</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="name_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['name']); ?>">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.ShippingmethodName')); ?> (<?php echo e($description_data['language_name']); ?>).</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.NextDayAir')); ?> (<?php echo e($description_data['language_name']); ?>)</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="nextDayAir_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['nextDayAir']); ?>">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.NextDayAir')); ?> (<?php echo e($description_data['language_name']); ?>).</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.2ndDayAir')); ?> (<?php echo e($description_data['language_name']); ?>)</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="secondDayAir_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['secondDayAir']); ?>">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.2ndDayAir')); ?> (<?php echo e($description_data['language_name']); ?>).</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Ground')); ?> (<?php echo e($description_data['language_name']); ?>)</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="ground_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['ground']); ?>">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.Ground')); ?> (<?php echo e($description_data['language_name']); ?>).</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.3DaySelect')); ?> (<?php echo e($description_data['language_name']); ?>)</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="threeDaySelect_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['threeDaySelect']); ?>">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.3DaySelect')); ?> (<?php echo e($description_data['language_name']); ?>).</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.NextDayAirSaver')); ?> (<?php echo e($description_data['language_name']); ?>)</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="nextDayAirSaver_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['nextDayAirSaver']); ?>">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.NextDayAirSaver')); ?> (<?php echo e($description_data['language_name']); ?>).</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.NextDayAirEarlyAM')); ?> (<?php echo e($description_data['language_name']); ?>)</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="nextDayAirEarlyAM_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['nextDayAirEarlyAM']); ?>">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.NextDayAirEarlyAM')); ?> (<?php echo e($description_data['language_name']); ?>).</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.2ndDayAirAM')); ?> (<?php echo e($description_data['language_name']); ?>)</label>
                                                    <div class="col-sm-10 col-md-4">
                                                        <input type="text" name="secondndDayAirAM_<?=$description_data['languages_id']?>" class="form-control field-validate" value="<?php echo e($description_data['secondndDayAirAM']); ?>">
                                                        <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><?php echo e(trans('labels.2ndDayAirAM')); ?> (<?php echo e($description_data['language_name']); ?>).</span>
                                                        <span class="help-block hidden"><?php echo e(trans('labels.textRequiredFieldMessage')); ?></span>
                                                    </div>
                                                </div>


                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.AccessKey')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('access_key',  $result['ups_shipping']['ups_shipping']->access_key, array('class'=>'form-control', 'id'=>'access_key')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    <?php echo e(trans('labels.AccessKeyText')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.UserName')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('user_name',  $result['ups_shipping']['ups_shipping']->user_name, array('class'=>'form-control', 'id'=>'user_name')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    <?php echo e(trans('labels.ShippingUserNameText')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Password')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('password',  $result['ups_shipping']['ups_shipping']->password, array('class'=>'form-control', 'id'=>'password')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    <?php echo e(trans('labels.UPSSshippingPassword')); ?>.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="shippingEnvironment" class="col-sm-2 col-md-3 control-label" style=""><?php echo e(trans('labels.PickupMethod')); ?> :</label>
                                                <div class="col-sm-10 col-md-4">
                                                    <label class=" control-label">
                                                        <input type="radio" name="pickup_method" value="01" class="flat-red" <?php if($result['ups_shipping']['ups_shipping']->pickup_method==01): ?> checked <?php endif; ?> > &nbsp;<?php echo e(trans('labels.DailyPickup')); ?>

                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <label class=" control-label">
                                                        <input type="radio" name="pickup_method" value="03" class="flat-red" <?php if($result['ups_shipping']['ups_shipping']->pickup_method==03): ?> checked <?php endif; ?> >  &nbsp;
                                                        <?php echo e(trans('labels.CustomerCounter')); ?>

                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <label class=" control-label">
                                                        <input type="radio" name="pickup_method" value="06" class="flat-red" <?php if($result['ups_shipping']['ups_shipping']->pickup_method==06): ?> checked <?php endif; ?> >  &nbsp;<?php echo e(trans('labels.OneTimePickup')); ?>

                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <label class=" control-label">
                                                        <input type="radio" name="pickup_method" value="07" class="flat-red" <?php if($result['ups_shipping']['ups_shipping']->pickup_method==07): ?> checked <?php endif; ?> >  &nbsp;<?php echo e(trans('labels.OnCallAirPickup')); ?>

                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <label class=" control-label">
                                                        <input type="radio" name="pickup_method" value="19" class="flat-red" <?php if($result['ups_shipping']['ups_shipping']->pickup_method==19): ?> checked <?php endif; ?> >  &nbsp; <?php echo e(trans('labels.LetterCenter')); ?>

                                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                    <label class=" control-label">
                                                        <input type="radio" name="pickup_method" value="20" class="flat-red" <?php if($result['ups_shipping']['ups_shipping']->pickup_method==20): ?> checked <?php endif; ?> >  &nbsp;
                                                        <?php echo e(trans('labels.AirServiceCenter')); ?>

                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Address')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('address_line_1',  $result['ups_shipping']['ups_shipping']->address_line_1, array('class'=>'form-control', 'id'=>'address_line_1')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;"><strong>
                                                        <?php echo e(trans('labels.AddressShippingText')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.State')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('state',  $result['ups_shipping']['ups_shipping']->state, array('class'=>'form-control', 'id'=>'state')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    <?php echo e(trans('labels.StateShippingText')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Postcode')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('post_code',  $result['ups_shipping']['ups_shipping']->post_code, array('class'=>'form-control', 'id'=>'post_code')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    <?php echo e(trans('labels.CityShippingText')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.City')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <?php echo Form::text('city',  $result['ups_shipping']['ups_shipping']->city, array('class'=>'form-control', 'id'=>'city')); ?>

                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    <?php echo e(trans('labels.CityShippingText')); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Country')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="country" class="form-control select2">
                                                        <?php $__currentLoopData = $result['countries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                    <?php if($result['ups_shipping']['ups_shipping']->country == $countries->countries_iso_code_2): ?>
                                                                    selected
                                                                    <?php endif; ?>
                                                                    value="<?php echo e($countries->countries_iso_code_2); ?>"> <?php echo e($countries->countries_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    <?php echo e(trans('labels.CountryShippingText')); ?></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 col-md-3 control-label"><?php echo e(trans('labels.Status')); ?></label>
                                                <div class="col-sm-10 col-md-4">
                                                    <select name="status" class="form-control select2">
                                                        <option <?php if($result['shipping_methods'][0]->status == 1): ?> selected <?php endif; ?> value="1" > <?php echo e(trans('labels.Active')); ?> </option>
                                                        <option <?php if($result['shipping_methods'][0]->status == 0): ?> selected <?php endif; ?> value="0"> <?php echo e(trans('labels.InActive')); ?></option>
                                                    </select>
                                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">
                                    <?php echo e(trans('labels.ShippingStatus')); ?></span>
                                                </div>
                                            </div>

                                            <!-- /.box-body -->
                                            <div class="box-footer text-center">
                                                <button type="submit" class="btn btn-primary"><?php echo e(trans('labels.Submit')); ?> </button>
                                                <a href="<?php echo e(URL::to('admin/shippingmethods/display')); ?>" type="button" class="btn btn-default"><?php echo e(trans('labels.back')); ?></a>
                                            </div>
                                            <!-- /.box-footer -->
                                            <?php echo Form::close(); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/zaheeecomm/resources/views/admin/shippingmethods/upsshipping.blade.php ENDPATH**/ ?>
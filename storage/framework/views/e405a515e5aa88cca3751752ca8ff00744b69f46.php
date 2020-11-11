<?php $__env->startSection('content'); ?>
    <!-- End Header Content -->

    <!-- NOTIFICATION CONTENT -->
    <?php echo $__env->make('web.common.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- END NOTIFICATION CONTENT -->

    <!-- Carousel Content -->
    <?php  echo $final_theme['carousel']; ?>
    <!-- Fixed Carousel Content -->

    <!-- Banners Content -->
    <!-- Products content -->

    <?php

    $product_section_orders = json_decode($final_theme['product_section_order'], true);

    foreach ($product_section_orders as $product_section_order){
    if($product_section_order['order'] == 1 && $product_section_order['status'] == 1){
    $r = 'web.product-sections.'.$product_section_order['file_name'];
    ?>
    <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
    }
    if($product_section_order['order'] == 3 && $product_section_order['status'] == 1){
    $r = 'web.product-sections.'.$product_section_order['file_name'];
    ?>
    <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
    }
    if($product_section_order['order'] == 6 && $product_section_order['status'] == 1){
    $r = 'web.product-sections.'.$product_section_order['file_name'];
    ?>
    <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php   }  }
    ?>

    <div class="product-wrap">
        <?php if(count($result['recently_viewed']) >0 ): ?>
            <div class="title-wrap d-flex justify-content-between align-items-center">
                <div class="title-box">
                    <h6><?php echo app('translator')->get('website.Recently Viewed'); ?></h6>
                </div>
                <!-- <div class="titlee-right">
                    <a href="#" class="see-all-btn">See All</a>
                </div> -->
            </div>
            <div class="product-slider b-product-slider">

                <?php $__currentLoopData = $result['recently_viewed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $viewedProd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="items-list text-center">
                        <div class="items-box-wrap">
                            <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            <a href="<?php echo e(URL::to('product-detail/'.$viewedProd->products_slug)); ?>">
                                <figure>
                                    <img src="<?php echo e(asset($viewedProd->image_path)); ?>" alt="b-product-1.png"/>
                                </figure>
                                <div class="items-content">
                                    <h6><?php echo e($viewedProd->products_name); ?></h6>
                                    <p>
                                        <?php
                                            $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                            if($default_currency->id == Session::get('currency_id')){
                                                if(!empty($viewedProd->discount_price)){
                                                    $discount_price = $viewedProd->discount_price;
                                                }
                                                if(!empty($viewedProd->flash_price)){
                                                    $flash_price = $viewedProd->flash_price;
                                                }
                                                $orignal_price = $viewedProd->products_price;
                                            }else{
                                                $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                                                if(!empty($viewedProd->discount_price)){
                                                    $discount_price = $viewedProd->discount_price * $session_currency->value;
                                                }
                                                if(!empty($viewedProd->flash_price)){
                                                    $flash_price = $viewedProd->flash_price * $session_currency->value;
                                                }
                                                $orignal_price = $viewedProd->products_price * $session_currency->value;
                                            }
                                            if(!empty($viewedProd->discount_price)){

                                                if(($orignal_price+0)>0){
                                                    $discounted_price = $orignal_price-$discount_price;
                                                    $discount_percentage = $discounted_price/$orignal_price*100;
                                                    $discounted_price = $viewedProd->discount_price;

                                                }else{
                                                    $discount_percentage = 0;
                                                    $discounted_price = 0;
                                                }
                                            }
                                            else{
                                                $discounted_price = $orignal_price;
                                            }
                                        ?>

                                        <?php if(!empty($viewedProd->discount_price)): ?>
                                            <span
                                                class="price new-price"> <?php if(Session::get('direction') == 'ltr'): ?>  <?php echo e(Session::get('symbol_left')); ?> <?php endif; ?>  <?php echo e($discount_price+0); ?> <?php if(Session::get('direction') == 'rtl'): ?><?php echo e(Session::get('symbol_right')); ?>  <?php endif; ?></span>
                                            <span
                                                class="price old-price"> <?php if(Session::get('direction') == 'ltr'): ?>  <?php echo e(Session::get('symbol_left')); ?> <?php endif; ?> <?php echo e($orignal_price+0); ?> <?php if(Session::get('direction') == 'rtl'): ?><?php echo e(Session::get('symbol_right')); ?>  <?php endif; ?></span>
                                        <?php else: ?>
                                            <span
                                                class="price">  <?php if(Session::get('direction') == 'ltr'): ?>  <?php echo e(Session::get('symbol_left')); ?> <?php endif; ?> <?php echo e($orignal_price+0); ?> <?php if(Session::get('direction') == 'rtl'): ?><?php echo e(Session::get('symbol_right')); ?>  <?php endif; ?></span>
                                        <?php endif; ?>
                                    </p>
                                    <div class="items-bottom-button">
                                    <?php if($viewedProd->defaultStock==0): ?>
                                        <!-- <a href="<?php echo e(URL::to('/product-detail/'.$viewedProd->products_slug)); ?>" class="link-btn btn btn-block btn-secondary"><?php echo app('translator')->get('website.Shop Now!'); ?></a> -->
                                            <a href="javascript:void(0);" class="link-btn btn btn-block btn-danger"
                                               products_id="<?php echo e($viewedProd->products_id); ?>"><?php echo app('translator')->get('website.Out of Stock'); ?></a>
                                        <?php else: ?>
                                            <a href="<?php echo e(URL::to('/product-detail/'.$viewedProd->products_slug)); ?>"
                                               class="link-btn btn btn-block btn-secondary"><?php echo app('translator')->get('website.Shop Now!'); ?></a>
                                            <a href="javascript:void(0);"
                                               class="link-btn btn btn-block btn-secondary cart"
                                               products_id="<?php echo e($viewedProd->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    </div>
    </section>
    </main>
    <?php echo $__env->make('web.common.scripts.Like', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fkhan/Projects/freelance/zahee/resources/views/web/index.blade.php ENDPATH**/ ?>
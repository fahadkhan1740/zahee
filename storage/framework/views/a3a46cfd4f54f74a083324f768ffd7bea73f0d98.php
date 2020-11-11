<div class="product-wrap ads__warp">
<div class="title-wrap d-flex justify-content-between align-items-center no-slider ">
    <div class="title-box">
      <h6><?php echo app('translator')->get('website.Trends'); ?></h6>
    </div>
    <div class="titlee-right">
        <a href="<?php echo e(URL::to('/shop?load_products=1&type=trends&limit=15')); ?>" class="see-all-btn"><?php echo app('translator')->get('website.See All'); ?></a>
    </div>
  </div>
   <div class="banner  banner-ads-full  row">
        <div  class="col-md-12">
            <figure>
                <a href="<?php echo e(URL::to('/shop?load_products=1&type=trends&limit=15')); ?>">
                 <img src="<?php echo e(asset($result['commonContent']['trend_image'][0]->path)); ?>" alt="placeholder" />
                </a>
            </figure>
        </div>
    </div>
 </div>

<div class="product-wrap" >
    <?php if($result['special']['success']==1): ?>
    <div class="title-wrap d-flex justify-content-between align-items-center">
    <div class="title-box">
      <h6><?php echo app('translator')->get('website.Deals of the day'); ?></h6>
    </div>
    <div class="titlee-right">
        <a href="<?php echo e(URL::to('/shop?load_products=1&type=special&limit=15')); ?>" class="see-all-btn"><?php echo app('translator')->get('website.See All'); ?></a>
    </div>
  </div>
    <div class="product-slider b-product-slider">
      <?php $__currentLoopData = $result['special']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('web.common.product-ref', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>


    <div class="banner  banner-ads row">
        <?php $__currentLoopData = $result['commonContent']['homeBanners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeBanner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($homeBanner->status && $homeBanner->languages_id === 1): ?>
                <div  class="col-12 col-md-4">
                       <figure style="background-image:url('<?php echo 'public/'.$homeBanner->path ?>')">
                       <a href="<?php echo e(URL::to($homeBanner->banners_url)); ?>">
                       </a>
                    </figure>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<!-----------new section ------------------>
<!-- Offer Slider -->
<div class="product-wrap">
    <?php if($result['flash_sale']['success']==1): ?>
      <div class="title-wrap d-flex justify-content-between align-items-center">
        <div class="title-box">
          <h6><?php echo app('translator')->get('website.Offers'); ?></h6>
        </div>
        <div class="titlee-right">
         <a href="<?php echo e(URL::to('/shop?load_products=1&type=flashsale&limit=15')); ?>" class="see-all-btn"><?php echo app('translator')->get('website.See All'); ?></a>
        </div>
      </div>

      <div class="product-slider b-product-slider">

          <?php $__currentLoopData = $result['flash_sale']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="items-list text-center">
          <div class="items-box-wrap">
          <a href="javascript:void(0)" class="heart-icon whishlist" products_id="<?php echo e($products->products_id); ?>"><i class="fa fa-heart" aria-hidden="true"></i></a>

            <figure>
            <a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>">
                <img src="<?php echo e(asset($products->image_path)); ?>" alt="<?php echo e($products->products_name); ?>" />
                </a>
            </figure>
            <div class="items-content">
              <h6> <a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo e($products->products_name); ?></a></h6>
                <?php
                $default_currency = DB::table('currencies')->where('is_default',1)->first();
                if($default_currency->id == Session::get('currency_id')){
                    if(!empty($products->flash_price)){
                        $discount_price = $products->flash_price;
                    }
                    $orignal_price = $products->products_price;
                }else{
                    $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                    if(!empty($products->flash_price)){
                        $discount_price = $products->flash_price * $session_currency->value;
                    }

                    $orignal_price = $products->products_price * $session_currency->value;
                }
                if(!empty($products->flash_price)){

                if(($orignal_price+0)>0){
                    $discounted_price = $orignal_price-$discount_price;
                    $discount_percentage = $discounted_price/$orignal_price*100;
                    $discounted_price =$products->flash_price;

                }else{
                    $discount_percentage = 0;
                    $discounted_price = 0;
                }
                ?>

              <p class="primary-color"><?php echo (int)$discount_percentage; ?>% Off</p>
              <p>
                    <!-- <span class="price "> -->
                         <?php if(empty($discount_price)): ?>
                         <span class="price "> <?php if(Session::get('direction') == 'ltr'): ?> <?php echo e(Session::get('symbol_left')); ?> <?php endif; ?> <?php echo e($orignal_price+0); ?> <?php if(Session::get('direction') == 'rtl'): ?><?php echo e(Session::get('symbol_right')); ?>  <?php endif; ?></span>
                    <!-- </span> -->
                        <?php else: ?>
                        <span class="price new-price"> <?php if(Session::get('direction') == 'ltr'): ?>  <?php echo e(Session::get('symbol_left')); ?> <?php endif; ?>  <?php echo e($discount_price+0); ?> <?php if(Session::get('direction') == 'rtl'): ?><?php echo e(Session::get('symbol_right')); ?>  <?php endif; ?></span>
                            <span class="price old-price"> <?php if(Session::get('direction') == 'ltr'): ?>  <?php echo e(Session::get('symbol_left')); ?> <?php endif; ?> <?php echo e($orignal_price+0); ?> <?php if(Session::get('direction') == 'rtl'): ?><?php echo e(Session::get('symbol_right')); ?>  <?php endif; ?></span>

                        <?php endif; ?>
                </p>
                <?php }?>
                <div class="items-bottom-button">
                <?php if(!in_array($products->products_id,$result['cartArray'])): ?>
                    <?php if($products->defaultStock==0): ?>
                        <!-- <a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>" class="link-btn btn btn-block btn-secondary"><?php echo app('translator')->get('website.Shop Now!'); ?></a> -->
                        <a href="javascript:void(0);" class="link-btn btn btn-block btn-danger" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Out of Stock'); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>" class="link-btn btn btn-block btn-secondary"><?php echo app('translator')->get('website.Shop Now!'); ?></a>
                        <a href="javascript:void(0);" class="link-btn btn btn-block btn-secondary cart" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="btn btn-block btn-secondary active" href="<?php echo e(URL::to('/viewcart')); ?>"><?php echo app('translator')->get('website.Go to Cart'); ?></a>
                <?php endif; ?>
                </div>
            </div>
          </div>
        </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>
</div>


<!-- Best Seller seller -->
<div class="product-wrap">
    <?php if($result['top_seller']['success']==1): ?>
      <div class="title-wrap d-flex justify-content-between align-items-center">
        <div class="title-box">
          <h6><?php echo app('translator')->get('website.Most Selling'); ?></h6>
          <div class="titlee-right">
            <a href="<?php echo e(URL::to('/shop?load_products=1&type=topseller&limit=15')); ?>" class="see-all-btn"><?php echo app('translator')->get('website.See All'); ?></a>
        </div>
        </div>

      </div>
        <div class="product-slider b-product-slider">
            <?php $__currentLoopData = $result['top_seller']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.common.product-ref', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>

<div class="service-24-wrap">
    <div class="row">
        <div class="col-md-3">
            <div class="service-24-box">
                <figure>
                    <img src="https://zaahee.shop/public/web/images/cus/service-24-icon-1.png" alt="service-24-icon-1.png" />
                </figure>
                <div class="service-24-content">
                    <h6><?php echo app('translator')->get('24/7 Online Support'); ?></h6>
                    <p>Still not sure what you need? Contact with customer service and we will help you achieve maximized to choose your needs.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="service-24-box">
                <figure>
                    <img src="https://zaahee.shop/public/web/images/cus/service-24-icon-2.png" alt="service-24-icon-2.png" />
                </figure>
                <div class="service-24-content">
                    <h6><?php echo app('translator')->get('Money Guarantee'); ?></h6>
                    <p>If you have already been billed by ZaaHee.shop, ZaaHee.shop will issue full or partial refunds. (According to the terms and conditions in ZaaHee.shop).</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="service-24-box">
                <figure>
                    <img src="https://zaahee.shop/public/web/images/cus/service-24-icon-3.png" alt="service-24-icon-3.png" />
                </figure>
                <div class="service-24-content">
                    <h6><?php echo app('translator')->get('website.Secure Payment'); ?></h6>
                    <p>We guarantee that every transaction carried out at zaahee.shop is 100% safe.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="service-24-box">
                <figure>
                    <img src="https://zaahee.shop/public/web/images/cus/service-24-icon-4.png" alt="service-24-icon-4.png" />
                </figure>
                <div class="service-24-content">
                    <h6><?php echo app('translator')->get('website.Big Saving'); ?></h6>
                    <p>Buy more save more.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bidding Slider -->
<div class="product-wrap">
    <?php if($result['featured']['success']==1): ?>
        <div class="title-wrap d-flex justify-content-between align-items-center">
            <div class="title-box">
                <h6><?php echo app('translator')->get('website.What’s HOT'); ?></h6>
            </div>
            <div class="titlee-right">
                <a href="<?php echo e(URL::to('/shop?load_products=1&type=mostliked&limit=15')); ?>" class="see-all-btn"><?php echo app('translator')->get('website.See All'); ?></a>
            </div>
        </div>

        <div class="product-slider">
                <?php $__currentLoopData = $result['featured']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php

                    $default_currency = DB::table('currencies')->where('is_default',1)->first();
                    if($default_currency->id == Session::get('currency_id')){
                        if(!empty($products->discount_price)){
                            $discount_price = $products->discount_price;
                        }
                        $orignal_price = $products->products_price;
                    }else{
                        $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                        if(!empty($products->discount_price)){
                            $discount_price = $products->discount_price * $session_currency->value;
                        }
                        $orignal_price = $products->products_price * $session_currency->value;
                    }
                    if(!empty($products->discount_price)){

                        if(($orignal_price+0)>0){
                            $discounted_price = $orignal_price-$discount_price;
                            $discount_percentage = $discounted_price/$orignal_price*100;
                        }else{
                            $discount_percentage = 0;
                            $discounted_price = 0;
                        }
                        ?>

<?php } ?>

                    <div class="items-list text-center">
                        <div class="items-box-wrap">
                        <a href="javascript:void(0)" class="heart-icon whishlist" products_id="<?php echo e($products->products_id); ?>"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            <figure>
                                <a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>">
                                    <img src="<?php echo e(asset($products->image_path)); ?>" alt="<?php echo e($products->products_name); ?>" />
                                </a>
                            </figure>
                            <div class="items-content">
                                <h6><?php echo e($products->products_name); ?></h6>

                                <p class="primary-color"><?php echo @round($discount_percentage); ?> % Off</p>
                                    <p>
                                     <!-- <span class="price "> -->
                                     <?php if(empty($products->discount_price)): ?>
                                        <span class="price "> <?php if(Session::get('direction') == 'ltr'): ?> <?php echo e(Session::get('symbol_left')); ?> <?php endif; ?> <?php echo e($orignal_price+0); ?> <?php if(Session::get('direction') == 'rtl'): ?><?php echo e(Session::get('symbol_right')); ?>  <?php endif; ?></span>
                                    <!-- </span> -->
                                        <?php else: ?>
                                        <span class="price new-price"> <?php if(Session::get('direction') == 'ltr'): ?>  <?php echo e(Session::get('symbol_left')); ?> <?php endif; ?>  <?php echo e($discount_price+0); ?> <?php if(Session::get('direction') == 'rtl'): ?><?php echo e(Session::get('symbol_right')); ?>  <?php endif; ?></span>
                                            <span class="price old-price"> <?php if(Session::get('direction') == 'ltr'): ?>  <?php echo e(Session::get('symbol_left')); ?> <?php endif; ?> <?php echo e($orignal_price+0); ?> <?php if(Session::get('direction') == 'rtl'): ?><?php echo e(Session::get('symbol_right')); ?>  <?php endif; ?></span>

                                        <?php endif; ?>
                                </p>
                                <div class="items-bottom-button">
                                <?php if(!in_array($products->products_id,$result['cartArray'])): ?>
                                    <?php if($products->defaultStock==0): ?>
                                        <!-- <a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>" class="link-btn btn btn-block btn-secondary"><?php echo app('translator')->get('website.Shop Now!'); ?></a> -->
                                        <a href="javascript:void(0);" class="link-btn btn btn-block btn-danger" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Out of Stock'); ?></a>
                                    <?php else: ?>
                                        <a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>" class="link-btn btn btn-block btn-secondary"><?php echo app('translator')->get('website.Shop Now!'); ?></a>
                                        <a href="javascript:void(0);" class="link-btn btn btn-block btn-secondary cart" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a class="btn btn-block btn-secondary active" href="<?php echo e(URL::to('/viewcart')); ?>"><?php echo app('translator')->get('website.Go to Cart'); ?></a>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    </div>
<?php /**PATH /Users/fkhan/Projects/freelance/zahee/resources/views/web/product-sections/tab.blade.php ENDPATH**/ ?>
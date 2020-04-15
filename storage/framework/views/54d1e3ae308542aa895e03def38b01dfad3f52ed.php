<div class="product-wrap" >
  <div class="title-wrap d-flex justify-content-between align-items-center">
    <div class="title-box">
      <h6>Deals of the day</h6>
    </div>
    <!-- <div class="titlee-right">
        <a href="#" class="see-all-btn">See All</a>
    </div> -->
  </div>
  <div class="product-slider b-product-slider">

    <?php if($result['special']['success']==1): ?>
      <?php $__currentLoopData = $result['special']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('web.common.product-ref', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

</div>


<div class="banner  banner-ads row">
  <div class="col-md-4">
    <figure style="background-image:url('web/images/cus/banner-ads-1.jpg')">
      <a href="#"></a>
    </figure>
  </div>
  <div class="col-md-4">
    <figure style="background-image:url('web/images/cus/banner-ads-2.jpg')">
      <a href="#"></a>
    </figure>
  </div>

  <div class="col-md-4">
    <figure style="background-image:url('web/images/cus/banner-ads-3.jpg')">
      <a href="#"></a>
    </figure>
  </div>
</div>

<!-----------new section ------------------>
<!-- Offer Slider -->
<div class="product-wrap">
  <div class="title-wrap d-flex justify-content-between align-items-center">
    <div class="title-box">
      <h6>Offers</h6>
    </div>
    <!-- <div class="titlee-right">
        <a href="#" class="see-all-btn">See All</a>
    </div> -->
  </div>

  <div class="product-slider">
    <div class="items-list text-center">
      <div class="items-box-wrap">
        <figure>
          <a href="#">
            <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/product-img-1.png" alt="product-img-1.png" />
          </a>
        </figure>
        <div class="items-content">
          <h6>Deodrant Spray</h6>
          <p class="primary-color">Extra 10% Off</p>
          <a href="#" class="link-btn">Shop Now!</a>
        </div>
      </div>
    </div>



    <div class="items-list text-center">
      <div class="items-box-wrap">
        <figure>
          <a href="#">
            <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/product-img-2.png" alt="product-img-2.png" />
          </a>
        </figure>
        <div class="items-content">
          <h6>Vitamins and Sopplements</h6>
          <p class="primary-color">Extra 10% Off</p>
          <a href="#" class="link-btn">Shop Now!</a>
        </div>
      </div>
    </div>


    <div class="items-list text-center">
      <div class="items-box-wrap">
        <figure>
          <a href="#">
            <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/product-img-3.png" alt="product-img-3.png" />
          </a>
        </figure>
        <div class="items-content">
          <h6>Californian Almonds</h6>
          <p class="primary-color">Extra 10% Off</p>
          <a href="#" class="link-btn">Shop Now!</a>
        </div>
      </div>
    </div>


    <div class="items-list text-center">
      <div class="items-box-wrap">
        <figure>
          <a href="#">
            <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/product-img-4.png" alt="product-img-4.png" />
          </a>
        </figure>
        <div class="items-content">
          <h6>Skin Care </h6>
          <p class="primary-color">Extra 10% Off</p>
          <a href="#" class="link-btn">Shop Now!</a>
        </div>
      </div>
    </div>


    <div class="items-list text-center">
      <div class="items-box-wrap">
        <figure>
          <a href="#">
            <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/product-img-5.png" alt="product-img-5.png" />
          </a>
        </figure>
        <div class="items-content">
          <h6>Pet Services </h6>
          <p class="primary-color">Extra 10% Off</p>
          <a href="#" class="link-btn">Shop Now!</a>
        </div>
      </div>
    </div>


    <div class="items-list text-center">
      <div class="items-box-wrap">
        <figure>
          <a href="#">
            <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/product-img-6.png" alt="product-img-6.png" />
          </a>
        </figure>
        <div class="items-content">
          <h6>Biotiqu Beauty Products</h6>
          <p class="primary-color">Extra 10% Off</p>
          <a href="#" class="link-btn">Shop Now!</a>
        </div>
      </div>
    </div>


    <div class="items-list text-center">
      <div class="items-box-wrap">
        <figure>
          <a href="#">
            <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/product-img-2.png" alt="product-img-2.png" />
          </a>
        </figure>
        <div class="items-content">
          <h6>Vitamins and Sopplements</h6>
          <p class="primary-color">Extra 10% Off</p>
          <a href="#" class="link-btn">Shop Now!</a>
        </div>
      </div>
    </div>


    <div class="items-list text-center">
      <div class="items-box-wrap">
        <figure>
          <a href="#">
            <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/product-img-3.png" alt="product-img-3.png" />
          </a>
        </figure>
        <div class="items-content">
          <h6>Californian Almonds</h6>
          <p class="primary-color">Extra 10% Off</p>
          <a href="#" class="link-btn">Shop Now!</a>
        </div>

      </div>
    </div>


    <div class="items-list text-center">
      <div class="items-box-wrap">
        <figure>
          <a href="#">
            <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/product-img-4.png" alt="product-img-4.png" />
          </a>
        </figure>
        <div class="items-content">
          <h6>Skin Care </h6>
          <p class="primary-color">Extra 10% Off</p>
          <a href="#" class="link-btn">Shop Now!</a>
        </div>
      </div>
    </div>


    <div class="items-list text-center">
      <div class="items-box-wrap">
        <figure>
          <a href="#">
            <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/product-img-5.png" alt="product-img-5.png" />
          </a>
        </figure>
        <div class="items-content">
          <h6>Pet Services </h6>
          <p class="primary-color">Extra 10% Off</p>
          <a href="#" class="link-btn">Shop Now!</a>
        </div>
      </div>
    </div>


    <div class="items-list text-center">
      <div class="items-box-wrap">
        <figure>
          <a href="#">
            <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/product-img-6.png" alt="product-img-6.png" />
          </a>
        </figure>
        <div class="items-content">
          <h6>Biotiqu Beauty Products</h6>
          <p class="primary-color">Extra 10% Off</p>
          <a href="#" class="link-btn">Shop Now!</a>
        </div>
      </div>
    </div>

  </div>

</div>


<!-- Best Seller seller -->
<div class="product-wrap">
  <div class="title-wrap d-flex justify-content-between align-items-center">
    <div class="title-box">
      <h6>Most Selling</h6>
    </div>
    <!-- <div class="titlee-right">
        <a href="#" class="see-all-btn">See All</a>
    </div> -->
  </div>

  <div class="product-slider b-product-slider">
    <?php if($result['top_seller']['success']==1): ?>
      <?php $__currentLoopData = $result['top_seller']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('web.common.product-ref', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>



</div>


<div class="service-24-wrap">
  <div class="row">
    <div class="col-md-3">
      <div class="service-24-box">
        <figure>
          <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/service-24-icon-1.png" alt="service-24-icon-1.png" />
        </figure>
        <div class="service-24-content">
          <h6>24/7 Online Support</h6>
          <p>Lorem ipsum is simply dummy</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="service-24-box">
        <figure>
          <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/service-24-icon-2.png" alt="service-24-icon-2.png" />
        </figure>
        <div class="service-24-content">
          <h6>Money Guarantee</h6>
          <p>Lorem ipsum is simply dummy</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="service-24-box">
        <figure>
          <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/service-24-icon-3.png" alt="service-24-icon-3.png" />
        </figure>
        <div class="service-24-content">
          <h6>Secure Payment</h6>
          <p>Lorem ipsum is simply dummy</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="service-24-box">
        <figure>
          <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/service-24-icon-4.png" alt="service-24-icon-4.png" />
        </figure>
        <div class="service-24-content">
          <h6>Big Saving</h6>
          <p>Lorem ipsum is simply dummy</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bidding Slider -->
<div class="product-wrap">
  <div class="title-wrap d-flex justify-content-between align-items-center">
    <div class="title-box">
      <h6>What’s HOT</h6>
    </div>
    <!-- <div class="titlee-right">
        <a href="#" class="see-all-btn">See All</a>
    </div> -->
  </div>

  <div class="product-slider">

   <?php if($result['featured']['success']==1): ?>
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
        <figure>
          <a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>">
            <img src="<?php echo e(asset('').$products->image_path); ?>" alt="<?php echo e($products->products_name); ?>" />
          </a>
        </figure>
        <div class="items-content">
          <h6><?php echo e($products->products_name); ?></h6>
          <p class="primary-color"><?php echo @$discount_percentage; ?> % Off</p>
          <a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>" class="link-btn">Shop Now!</a>
        </div>
      </div>
    </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

  </div>

</div>
<?php /**PATH /var/www/html/zaheeecomm/resources/views/web/product-sections/tab.blade.php ENDPATH**/ ?>
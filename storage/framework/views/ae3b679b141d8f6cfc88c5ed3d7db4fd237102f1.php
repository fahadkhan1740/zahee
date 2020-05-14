<?php if($result['flash_sale']['success']==1): ?>
<!-- Products content -->
<section class="products-content">
  <div class="container">
    <?php if($result['flash_sale']['success']==1): ?>
    <div class="products-area">

      <div class="row">
        <div class="col-12">
          <div class="heading">
            <h2>
              <?php echo app('translator')->get('website.Flash Sale'); ?>
            </h2>
            <hr style="margin-bottom: 0;">
          </div>
          <div id="owl-flash" class="owl-flash owl-carousel" style="margin-bottom: 10px;">
            <?php $__currentLoopData = $result['flash_sale']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if( date("Y-m-d", $products->server_time) >= date("Y-m-d", $products->flash_start_date)): ?>
            <div class="product">
                <article>
                    <div class="thumb">
                      <div class="icons mobile-icons d-lg-none d-xl-none">
                          <div class="icon-liked">
                            <a onclick="myLike(<?php echo e($products->products_id); ?>)" class="icon active">
                              <i class="fas fa-heart"></i>
                              <span class="badge badge-secondary"><?php echo e($products->products_liked); ?></span>
                            </a>
                          </div>
                          <div class="icon" data-toggle="modal" data-target="#myModal"><i class="fas fa-eye"></i></div>
                          <a href="compare.html" class="icon"><i class="fas fa-align-right" data-fa-transform="rotate-90"></i></a>
                        </div>
                      <img class="img-fluid" src="<?php echo e(asset('public/').$products->image_path); ?>" alt="<?php echo e($products->products_name); ?>">
                   </div>
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
                   <span class="discount-tag"><?php echo (int)$discount_percentage; ?>%</span>
                  <?php }?>
                   <div class="discount-tag timer-tag">
                     <span>Flash sale end&rsquo;s</span>
                     <span id="counter_<?php echo e($products->products_id); ?>"></span>
                     <i class="far fa-clock"></i>
                   </div>
                  <span class="tag">
                    <?php $__currentLoopData = $products->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($category->categories_name); ?><?php if(++$key === count($products->categories)): ?> <?php else: ?>, <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </span>
                  <h2 class="title text-center"><a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo e($products->products_name); ?></a></h2>
                  <div class="price">
                    <?php if(!empty($products->flash_price)): ?>
                    <?php echo e(Session::get('symbol_left')); ?><?php echo e($discounted_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

                    <span> <?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?></span>
                    <?php else: ?>
                    <?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

                    <?php endif; ?>
                  </div>
                  <div class="product-hover d-none d-lg-block d-xl-block">
                    <div class="icons">
                        <div class="icon-liked">
                          <a class="icon active is_liked" products_id="<?=$products->products_id?>">
                            <i class="fas fa-heart"></i>
                            <span  class="badge badge-secondary counter"  ><?php echo e($products->products_liked); ?></span>
                          </a>
                        </div>
                      <div class="icon modal_show" data-toggle="modal" data-target="#myModal" products_id="<?php echo e($products->products_id); ?>"><i class="fas fa-eye"></i></div>
                        <a onclick="myFunction3(<?php echo e($products->products_id); ?>)"class="icon"><i class="fas fa-align-right" data-fa-transform="rotate-90"></i></a>
                    </div>
                    <?php echo $__env->make('web.common.scripts.addToCompare', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="buttons">
                               <?php if($products->products_type==0): ?>
                                  <?php if(!in_array($products->products_id,$result['cartArray'])): ?>
                                      <?php if($products->defaultStock==0): ?>

                                          <button type="button" class="btn btn-block btn-danger" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
                                      <?php elseif($products->products_min_order>1): ?>
                                       <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                                      <?php else: ?>
                                          <button type="button" class="btn btn-block btn-secondary cart" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
                                      <?php endif; ?>
                                  <?php else: ?>
                                      <button type="button" class="btn btn-block btn-secondary active"><?php echo app('translator')->get('website.Added'); ?></button>
                                  <?php endif; ?>
                              <?php elseif($products->products_type==1): ?>
                                  <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                              <?php elseif($products->products_type==2): ?>
                                  <a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn btn-block btn-secondary"><?php echo app('translator')->get('website.External Link'); ?></a>
                              <?php endif; ?>
                          </div>
                  </div>
                  <div class="mobile-buttons d-lg-none d-xl-none">
                            <?php if($products->products_type==0): ?>
                               <?php if(!in_array($products->products_id,$result['cartArray'])): ?>
                                   <?php if($products->defaultStock==0): ?>
                                       <button type="button" class="btn btn-block btn-danger" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
                                   <?php elseif($products->products_min_order>1): ?>
                                    <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                                   <?php else: ?>
                                       <button type="button" class="btn btn-block btn-secondary cart" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
                                   <?php endif; ?>
                               <?php else: ?>
                                   <button type="button" class="btn btn-block btn-secondary active"><?php echo app('translator')->get('website.Added'); ?></button>
                               <?php endif; ?>
                           <?php elseif($products->products_type==1): ?>
                               <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                           <?php elseif($products->products_type==2): ?>
                               <a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn btn-block btn-secondary"><?php echo app('translator')->get('website.External Link'); ?></a>
                           <?php endif; ?>
                          </div>
              </article>
            </div>


            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>
<script>

jQuery(document).ready(function(e) {

   <?php if(!empty($result['flash_sale']['success']) and $result['flash_sale']['success']==1): ?>
       <?php $__currentLoopData = $result['flash_sale']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	   <?php if( date("Y-m-d",$products->server_time) >= date("Y-m-d",$products->flash_start_date)): ?>
	    var product_div_<?php echo e($products->products_id); ?> = 'product_div_<?php echo e($products->products_id); ?>';
		var  counter_id_<?php echo e($products->products_id); ?> = 'counter_<?php echo e($products->products_id); ?>';
		var inputTime_<?php echo e($products->products_id); ?> = "<?php echo e(date('M d, Y H:i:s' ,$products->flash_expires_date)); ?>";

		// Set the date we're counting down to
		var countDownDate_<?php echo e($products->products_id); ?> = new Date(inputTime_<?php echo e($products->products_id); ?>).getTime();

		// Update the count down every 1 second
		var x_<?php echo e($products->products_id); ?> = setInterval(function() {

		  // Get todays date and time
		  var now = new Date().getTime();

		  // Find the distance between now and the count down date
		  var distance_<?php echo e($products->products_id); ?> = countDownDate_<?php echo e($products->products_id); ?> - now;

		  // Time calculations for days, hours, minutes and seconds
		  var days_<?php echo e($products->products_id); ?> = Math.floor(distance_<?php echo e($products->products_id); ?> / (1000 * 60 * 60 * 24));
		  var hours_<?php echo e($products->products_id); ?> = Math.floor((distance_<?php echo e($products->products_id); ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes_<?php echo e($products->products_id); ?> = Math.floor((distance_<?php echo e($products->products_id); ?> % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds_<?php echo e($products->products_id); ?> = Math.floor((distance_<?php echo e($products->products_id); ?> % (1000 * 60)) / 1000);

		  // Display the result in the element with id="demo"
		  document.getElementById(counter_id_<?php echo e($products->products_id); ?>).innerHTML = days_<?php echo e($products->products_id); ?> + "d " + hours_<?php echo e($products->products_id); ?> + "h "
		  + minutes_<?php echo e($products->products_id); ?> + "m " + seconds_<?php echo e($products->products_id); ?> + "s ";

		  // If the count down is finished, write some text
		  if (distance_<?php echo e($products->products_id); ?> < 0) {
			clearInterval(x_<?php echo e($products->products_id); ?>);
			//document.getElementById(counter_id_<?php echo e($products->products_id); ?>).innerHTML = "EXPIRED";
			document.getElementById('product_div_<?php echo e($products->products_id); ?>').remove();
		  }
		}, 1000);
  	   <?php endif; ?>
	 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endif; ?>

	<?php if(!empty($result['detail']['product_data'][0]->flash_start_date)): ?>
		<?php if( $result['detail']['product_data'][0]->server_time >= $result['detail']['product_data'][0]->flash_start_date): ?>

			var inputTime = "<?php echo e(date('M d, Y H:i:s' ,$result['detail']['product_data'][0]->flash_expires_date)); ?>";

			var countDownDate = new Date(inputTime).getTime();

			// Update the count down every 1 second
			var x = setInterval(function() {

			  // Get todays date and time
			  var now = new Date().getTime();

			  // Find the distance between now and the count down date
			  var distance = countDownDate - now;

			  // Time calculations for days, hours, minutes and seconds
			  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

			  // Display the result in the element with id="demo"
			  document.getElementById("counter_product").innerHTML = days + "d " + hours + "h "
			  + minutes + "m " + seconds + "s ";
				document.getElementById("counter_product").style.display = 'block';
			  // If the count down is finished, write some text
			  if (distance < 0) {
				clearInterval(x);
				document.getElementById("counter_product").innerHTML = "EXPIRED";
				document.getElementById("add-to-Cart").style.display = 'none';
			  }
			}, 1000);
		<?php endif; ?>
	<?php endif; ?>
});
</script>
<?php /**PATH /var/www/html/zaheeecomm/resources/views/web/product-sections/flash_sale_section.blade.php ENDPATH**/ ?>

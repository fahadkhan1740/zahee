<?php if($result['featured']['success']==1): ?>
<section class="products-content">
  <div class="container">
    <div class="products-area">
      <!-- heading -->
      <div class="heading">
        <h2><?php echo app('translator')->get('website.Top Selling of the Week'); ?>
          <small class="pull-right">
            <a href="<?php echo e(url('/shop?type=topseller')); ?>"><?php echo app('translator')->get('website.View All'); ?></a>
          </small>
        </h2>
        <hr>
      </div>
      <div class="row">
        <?php if($result['featured']['success']==1): ?>
        <?php $__currentLoopData = $result['featured']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($key==0): ?>
            <div class="col-12 col-md-12 col-lg-6">
              <div class="product-2x">
                  <span class="featured-tag">
                      <i class="far fa-flag" aria-hidden="true"></i>
                      &nbsp;Featured
                    </span>
                    <div class="icon-liked">
                        <a onclick="myLike(<?php echo e($products->products_id); ?>)" class="icon active">
                          <i class="fas fa-heart"></i>
                          <span class="badge badge-secondary"><?php echo e($products->products_liked); ?></span>
                        </a>
                      </div>
                    <article>
                      <div class="thumb">
                        <img class="img-fluid" src="<?php echo e(asset('').$products->image_path); ?>" alt="<?php echo e($products->products_name); ?>">
                      </div>
                      <div class="module">
                        <span class="tag">
                          <?php
                          $default_currency = DB::table('currencies')->where('is_default',1)->first();
                          if($default_currency->id == Session::get('currency_id')){

                          	$currency_value = 1;
                          }else{
                          	$session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();

                          	$currency_value = $session_currency->value;
                          }
                          ?>
                          <?php $__currentLoopData = $products->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php echo e($category->categories_name); ?><?php if(++$key === count($products->categories)): ?> <?php else: ?>, <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span>
                        <h2 class="title"><a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo e($products->products_name); ?></a></h2>
                        <div class="price">
                          <?php if(!empty($products->discount_price)): ?>
                          <?php echo e(Session::get('symbol_left')); ?><?php echo e($products->discount_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

                          <span style="text-decoration: line-through; color:lightgrey;"> <?php echo e(Session::get('symbol_left')); ?><?php echo e($products->products_price+0*$currency_value); ?><?php echo e(Session::get('symbol_right')); ?></span>
                          <?php else: ?>
                          gdfgdhgd
                          <?php echo e(Session::get('symbol_left')); ?><?php echo e($products->products_price+0*$currency_value); ?><?php echo e(Session::get('symbol_right')); ?>

                          <?php endif; ?>
                        </div>

                        <ul class="list">
                          <?php if(!empty($products->attributes) and count($products->attributes)>0): ?>
                              <?php $__currentLoopData = $products->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attributes_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($key==1): ?>

                              <?php endif; ?>
                          <li><?php echo e($attributes_data['option']['name']); ?>

                            <br>
                              <?php $__currentLoopData = $attributes_data['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$values_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <small><?php echo e($values_data['value']); ?>

                                  <?php if($key+1!=count($attributes_data['values'])): ?>
                                  |
                                  <?php endif; ?>
                            </small>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endif; ?>
                        </ul>

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
                    </article>
              </div>

            </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
            <?php if($result['weeklySoldProducts']['success']==1): ?>
            <?php $__currentLoopData = $result['weeklySoldProducts']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($key<=5): ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3">
              <!-- Product -->
              <?php echo $__env->make('web.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>


      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php /**PATH /var/www/html/zaheeecomm/resources/views/web/product-sections/top.blade.php ENDPATH**/ ?>
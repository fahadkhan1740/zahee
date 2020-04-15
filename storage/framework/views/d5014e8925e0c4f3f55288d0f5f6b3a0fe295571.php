<!-- Products content -->
<?php if($result['products']['success']==1): ?>
<section class="products-content">
  <div class="container">
    <div class="products-area">
  <!-- heading -->
  <div class="heading">
    <h2><?php echo app('translator')->get('website.Newest Products'); ?>
      <small class="pull-right">
      <a href="<?php echo e(url('/shop')); ?>"><?php echo app('translator')->get('website.View All'); ?></a>
      </small>
    </h2>
    <hr>
  </div>
  <div class="row">
    <?php if($result['products']['success']==1): ?>
    <?php $__currentLoopData = $result['products']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
      <!-- Product -->
      <?php echo $__env->make('web.common.product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
 </div>
</div>
  </div>
</section>
<?php endif; ?>
<?php /**PATH /var/www/html/zaheeecomm/resources/views/web/product-sections/newest_product.blade.php ENDPATH**/ ?>
<?php $qunatity=0; ?>
<?php $__currentLoopData = $result['commonContent']['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $qunatity += $cart_data->customers_basket_quantity; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(url('/viewcart')); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i><?php echo e($qunatity); ?></a>
    <a href="<?php echo e(url('/wishlist')); ?>"><i class="fa fa-heart" aria-hidden="true"></i><?php echo e($result['commonContent']['wishlist_count']); ?></a>
<?php /**PATH /var/www/html/resources/views/web/headers/cartButtons/cartButton.blade.php ENDPATH**/ ?>
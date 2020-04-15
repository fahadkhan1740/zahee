<?php $__env->startSection('template_title'); ?>
      Welcome To Laravel Ecommerce App
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
  Laravel Ecommerce App
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
    <?php if($error == 1045): ?>
    <p class="text-center alert alert-info">
      <strong>Check You DataBase Credentials Again </strong>
      <strong> Note: </strong> If You Are On Local Development Please Restart Your Server Before Changing Credentials Now.
    </p>
    <p class="text-center alert alert-info">
     Do Not Worry If You Are Seeing This Message Then, It seems Like you are providing wrong credentials,
     Either your Database Name Or Password is Wrong Or
     You Wouldn't have Set Your DataBase Password for Xampp or Lamp Or Wampp or any other environment setup.
    </p>
    <?php else: ?>
    <p class="text-center alert alert-danger">
     Your Error Code is: <?php echo e($error); ?>. Development Environment Configuration Issue. Please search that error code on internet to find out the reason and fixed it before installation.
    </p>
    <?php endif; ?>
    <p class="text-center">
      <button onclick="window.history.go(-1); return false;" class="button">
        <i class="fa fa-angle-left fa-fw" aria-hidden="true"></i>
        Try Again
      </button>
    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/zaheeecomm/resources/views/vendor/installer/error.blade.php ENDPATH**/ ?>
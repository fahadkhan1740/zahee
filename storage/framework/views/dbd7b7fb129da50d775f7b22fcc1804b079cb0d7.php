

<?php $__env->startSection('template_title'); ?>
      Welcome To Laravel Ecommerce App
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
  Laravel Ecommerce App
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
    <p class="text-center">
      Welcome To Laravel Ecommerce App Installer
    </p>
    <p class="text-center">
      <a href="<?php echo e(route('LaravelInstaller::requirements')); ?>" class="button">
        Next
        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
      </a>
    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/zaheeecomm/resources/views/vendor/installer/welcome.blade.php ENDPATH**/ ?>
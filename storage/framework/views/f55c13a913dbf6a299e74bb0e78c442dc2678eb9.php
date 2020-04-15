

<?php $__env->startSection('template_title'); ?>
    Step 3 | Environment Settings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
  Environment Settings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

    <p class="text-center">
      Please select how you want to configure the apps <code>.env</code> file.
    </p>
    <div class="buttons">
      <a href="<?php echo e(route('LaravelInstaller::environmentWizard')); ?>" class="button button-classic">
          <i class="fa fa-code fa-fw" aria-hidden="true"></i> Wizard Text Editor
      </a>
        <!-- <a href="<?php echo e(route('LaravelInstaller::environmentClassic')); ?>" class="button button-classic">
            <i class="fa fa-code fa-fw" aria-hidden="true"></i> Classic Text Editor
        </a> -->
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/zaheeecomm/resources/views/vendor/installer/environment.blade.php ENDPATH**/ ?>
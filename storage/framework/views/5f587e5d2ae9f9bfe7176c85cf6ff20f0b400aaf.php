<?php $__env->startSection('template_title'); ?>
    Installation Finished
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
  Installation Finished
<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

	<?php if(session('message')['dbOutputLog']): ?>
		<p><strong><small>Migration &amp; Seed Console Output:</small></strong></p>
		<pre><code><?php echo e(session('message')['dbOutputLog']); ?></code></pre>
	<?php endif; ?>

	<p><strong><small>Application Console Output:</small></strong></p>
	<pre><code><?php echo e($finalMessages); ?></code></pre>

	<p><strong><small>Installation Log Entry:</small></strong></p>
	<pre><code><?php echo e($finalStatusMessage); ?></code></pre>

	<p><strong><small>Final .env File:</small></strong></p>
	<pre><code><?php echo e($finalEnvFile); ?></code></pre>

    <div class="buttons">
        <a href="<?php echo e(url('/admin/login')); ?>" class="button">Click here to exit</a>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/zaheeecomm/resources/views/vendor/installer/finished.blade.php ENDPATH**/ ?>
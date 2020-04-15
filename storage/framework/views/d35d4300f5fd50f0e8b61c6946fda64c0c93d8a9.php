<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
      <?php echo $__env->make('web.common.meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  </head>
    <!-- dir="rtl" -->
    <body class="animation-s1"  dir="<?php echo e(session('direction')); ?>">

      <!-- Header Content -->
       <?php  echo $final_theme['header']; ?>
       <!-- End Header Content -->
       <?php  echo $final_theme['mobile_header']; ?>
       <!-- NOTIFICATION CONTENT -->
         <?php echo $__env->make('web.common.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- END NOTIFICATION CONTENT -->
         <?php echo $__env->yieldContent('content'); ?>



      <!-- Footer content -->

      <?php  echo $final_theme['footer']; ?>

      <!-- End Footer content -->
      <?php  echo $final_theme['mobile_footer']; ?>


      <div class="mobile-overlay"></div>
      <!-- Product Modal -->


      <a href="web/#" id="back-to-top" title="Back to top">&uarr;</a>

      <div class="modal" tabindex="-1" id="myModal" role="dialog" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <div class="container" id="products-detail">

                    </div>
                  </div>
            </div>
          </div>
      </div>

      <!-- Include js plugin -->
       <?php echo $__env->make('web.common.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </body>
</html>

<?php /**PATH /var/www/html/zaheeecomm/resources/views/web/layout.blade.php ENDPATH**/ ?>
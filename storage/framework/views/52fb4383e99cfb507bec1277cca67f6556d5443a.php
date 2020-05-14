<main id="scrollbar-body" data-scrollbar>
    <!-- banner wrap -->
    <section class="main-warp">
      <div class="container">
        <div class="banner">
          <div id="banner-Carousel" class="carousel slide banner-carousel" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php $__currentLoopData = $result['slides']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="<?php if($k == 0){ echo 'carousel-item active';} else { echo 'carousel-item'; } ?>">
                    <figure class="figure-banner" style="background-image: url('<?php echo $slide->path; ?>');"></figure>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php $__currentLoopData = $result['slides']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li data-target="#banner-Carousel" data-slide-to="$k" class="<?php if($k == 0){ echo 'active';} else { echo ''; } ?>"></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>

            <!-- Left and right controls -->
            <a class="carousel-control-prev " href="#banner-Carousel" data-slide="prev">
              <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#banner-Carousel" data-slide="next">
              <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>



<?php /**PATH /var/www/html/resources/views/web/carousels/boot-carousel-content-full-screen.blade.php ENDPATH**/ ?>
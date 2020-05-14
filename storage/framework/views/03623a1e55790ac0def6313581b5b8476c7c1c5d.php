  <?php if($result['news']['success']==1): ?>
      <!-- Blog content -->
      <section class="blog-content">

        <div class="container">
          <!-- heading -->
          <div class="heading">
              <h2><?php echo app('translator')->get('website.From our News'); ?>
                <small class="pull-right">
                <a href="<?php echo e(URL::to('/news')); ?>"><?php echo app('translator')->get('website.View All'); ?></a>
                </small>
              </h2>
              <hr>
            </div>
          <div class="row">
            <?php if($result['news']['success']==1): ?>
             <?php $__currentLoopData = $result['news']['news_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$news_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-12 col-sm-6 col-lg-4 blog-col">
                <div class="blog">
                    <h2><a href="<?php echo e(URL::to('/news-detail/'.$news_data->news_slug)); ?>"><?php echo e($news_data->news_name); ?></a>
                        <span class="featured-tag"><?php echo app('translator')->get('website.Featured'); ?></span>
                      </h2>
                    <div class="blog-date">
                      <?php
                          $timestamp = strtotime($news_data->news_date_added);
                          echo date('d',$timestamp);
                      ?>
                        <br>
                        <?php
                            echo date('M',$timestamp);
                        ?>
                    </div>
                    <div class="overlay">
                        <a href="<?php echo e(URL::to('/news-detail/'.$news_data->news_slug)); ?>" class="fas fa-search-plus"></a>
                    </div>
                    <img class="img-fluid" src="<?php echo e(asset('public/').$news_data->image_path); ?>">

                  </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <?php endif; ?>

          </div>
        </div>
      </section>
  <?php endif; ?>
<?php /**PATH /var/www/html/zaheeecomm/resources/views/web/product-sections/blog_section.blade.php ENDPATH**/ ?>

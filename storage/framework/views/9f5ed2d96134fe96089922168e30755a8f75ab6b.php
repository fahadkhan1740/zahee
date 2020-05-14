<?php $__env->startSection('content'); ?>
       <!-- End Header Content -->

       <!-- NOTIFICATION CONTENT -->
         <?php echo $__env->make('web.common.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- END NOTIFICATION CONTENT -->

       <!-- Carousel Content -->
       <?php  echo $final_theme['carousel']; ?>
       <!-- Fixed Carousel Content -->

      <!-- Banners Content -->
      <!-- Products content -->

      <?php

      $product_section_orders = json_decode($final_theme['product_section_order'], true);

      foreach ($product_section_orders as $product_section_order){
          if($product_section_order['order'] == 1 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
       ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php
          }
          if($product_section_order['order'] == 3 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
       ?>
          <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php
          }
          if($product_section_order['order'] == 6 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
          ?>
       <?php echo $__env->make($r, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   <?php   }  }
      ?>
       <div class="product-wrap">
           <div class="title-wrap d-flex justify-content-between align-items-center">
               <div class="title-box">
                   <h6>Recent Search</h6>
               </div>
               <!-- <div class="titlee-right">
                   <a href="#" class="see-all-btn">See All</a>
               </div> -->
           </div>

           <div class="product-slider b-product-slider">
               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/b-product-1.png" alt="b-product-1.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Lakme Sun Expert Ultra Matte SPF 40 PA+++ Compact</h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>
                   </div>

               </div>



               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/b-product-2.png" alt="b-product-2.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Nutrition Whey Protein Concentrate</h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>
                   </div>

               </div>


               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/b-product-3.png" alt="b-product-3.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Sollar's Vest</h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>
                   </div>

               </div>


               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/b-product-4.png" alt="b-product-4.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Sugar Free Gold Sweetener </h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>
                   </div>
               </div>


               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/b-product-5.png" alt="b-product-5.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Wild Stone Edge Perfume</h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>
                   </div>
               </div>


               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/b-product-6.png" alt="b-product-6.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Organic Tattva Brown Sugar</h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>

                   </div>
               </div>


               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="images/b-product-1.png" alt="b-product-1.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Lakme Sun Expert Ultra Matte SPF 40 PA+++ Compact</h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>
                   </div>
               </div>



               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/b-product-2.png" alt="b-product-2.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Nutrition Whey Protein Concentrate</h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>
                   </div>
               </div>


               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/b-product-3.png" alt="b-product-3.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Sollar's Vest</h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>
                   </div>
               </div>


               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/b-product-4.png" alt="b-product-4.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Sugar Free Gold Sweetener </h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>
                   </div>
               </div>


               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/b-product-5.png" alt="b-product-5.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Wild Stone Edge Perfume</h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>
                   </div>
               </div>


               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="#">
                           <figure>
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/b-product-6.png" alt="b-product-6.png" />
                           </figure>
                           <div class="items-content">
                               <img src="https://clientstagingdev.com/zaheeecomm/public/web/images/cus/rating-star.png" alt="rating-star.png"/>
                               <h6>Organic Tattva Brown Sugar</h6>
                               <p><span class="price old-price">$16</span> <span class="price new-price">$14</span></p>
                           </div>
                       </a>
                   </div>
               </div>
           </div>

       </div>

       </div>
       </section>
       </main>
<?php echo $__env->make('web.common.scripts.Like', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/web/index.blade.php ENDPATH**/ ?>
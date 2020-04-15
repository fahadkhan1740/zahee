<section class="shop-content shop-four">
   <div class="container">
       <div class="row align-items-center justify-content-between">

           <ul class="list-group">
              <?php if(!empty($result['category_name']) and !empty($result['sub_category_name'])): ?>
              <li class="list-group-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>
              <li  class="list-group-item"><a href="<?php echo e(URL::to('/shop')); ?>"><?php echo app('translator')->get('website.Shop'); ?></a></li>
             <li  class="list-group-item"><a href="<?php echo e(URL::to('/shop?category='.$result['category_slug'])); ?>"><?php echo e($result['category_name']); ?></a></li>
             <li  class="list-group-item active"><?php echo e($result['sub_category_name']); ?></li>
             <?php elseif(!empty($result['category_name']) and empty($result['sub_category_name'])): ?>
             <li class="list-group-item active"><?php echo e($result['category_name']); ?></li>
             <?php else: ?>
             <li class="list-group-item"><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>
             <li class="list-group-item active"><?php echo app('translator')->get('website.Shop'); ?></li>
             <?php endif; ?>
           </ul>
         </div>

       <div class="row">
         <div class="col-12 col-lg-3  d-lg-block d-xl-block right-menu">
           <div class="right-menu-categories">
            <?php if(!empty($result['categories'])): ?>
             <?php $__currentLoopData = $result['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <a class=" main-manu"  <?php if(array_key_exists("childs",$category)): ?> href="#<?php echo e($category->slug); ?>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="men-cloth" <?php else: ?> href="<?php echo e(url('shop?category=').$category->slug); ?>" <?php endif; ?>>
               <img class="img-fuild" src="<?php echo e(asset($category->image_path)); ?>">
                  <?php echo e($category->categories_name); ?> <span><i class="fas fa-minus"></i></span>

             </a>
             <div class="sub-manu collapse multi-collapse" id="<?php echo e($category->slug); ?>">
               <ul class="unorder-list">
                 <?php if(array_key_exists("childs",$category)): ?>
                 <?php $__currentLoopData = $category->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <li class="list-item">
                     <a class="list-link"  href="<?php echo e(url('shop?category=').$cat->slug); ?>" >
                         <i class="fas fa-angle-right"></i><?php echo e($cat->categories_name); ?>

                     </a>
                   </li>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
               </ul>
             </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

           </div>
           <?php if(!empty($result['categories'])): ?>
           <form enctype="multipart/form-data" name="filters" id="test" method="get">
             <input type="hidden" name="min_price" id="min_price" value="0">
             <input type="hidden" name="max_price" id="max_price" value="<?php echo e($result['filters']['maxPrice']); ?>">
             <?php if(app('request')->input('category')): ?>
              <input type="hidden" name="category" value="<?php echo e(app('request')->input('category')); ?>">
             <?php endif; ?>
             <?php if(app('request')->input('filters_applied')==1): ?>
             <input type="hidden" name="filters_applied" id="filters_applied" value="1">
             <input type="hidden" name="options" id="options" value="<?php echo implode($result['filter_attribute']['options'],',')?>">
             <input type="hidden" name="options_value" id="options_value" value="<?php echo implode($result['filter_attribute']['option_values'], ',')?>">
             <?php else: ?>
             <input type="hidden" name="filters_applied" id="filters_applied" value="0">
             <?php endif; ?>
             <?php if(!empty($result['products']['success']) and $result['products']['success'] == 0): ?>
             <div class="range-slider-main">
               <h2>Price Range</h2>
               <div class="wrapper">
                   <div class="range-slider">
                       <input onChange="getComboA(this)" name="price" type="text" class="js-range-slider" value="" />
                   </div>
                   <div class="extra-controls form-inline">
                     <div class="form-group">
                         <span>
                           <?php if(session('symbol_left') != null): ?>
                           <font><?php echo e(session('symbol_left')); ?></font>
                           <?php else: ?>
                           <font><?php echo e(session('symbol_right')); ?></font>
                           <?php endif; ?>
                               <input type="text"  class="js-input-from form-control" value="0" />
                         </span>
                             <font>-</font>
                             <span>
                               <?php if(session('symbol_left') != null): ?>
                               <font><?php echo e(session('symbol_left')); ?></font>
                               <?php else: ?>
                               <font><?php echo e(session('symbol_right')); ?></font>
                               <?php endif; ?>
                                 <input  type="text" class="js-input-to form-control" value="0" />
                                 <input  type="hidden" class="maximum_price" value="<?php echo e($result['filters']['maxPrice']); ?>">
                                 </span>
                   </div>
                     </div>
               </div>
             </div>
             <?php endif; ?>
             <?php echo $__env->make('web.common.scripts.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                   <?php if(count($result['filters']['attr_data'])>0): ?>
                   <?php $__currentLoopData = $result['filters']['attr_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attr_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <div class="color-range-main">
                     <h1 <?php if(count($result['filters']['attr_data'])==$key+1): ?> last <?php endif; ?>><?php echo e($attr_data['option']['name']); ?></h1>
                       <div class="block">
                              <div class="card-body">
                               <ul class="list" style="list-style:none; padding: 0px;">
                                   <?php $__currentLoopData = $attr_data['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <li >
                                       <div class="form-check">
                                         <label class="form-check-label">
                                           <input class="form-check-input filters_box" name="<?php echo e($attr_data['option']['name']); ?>[]" type="checkbox" value="<?php echo e($values['value']); ?>" 								 									<?php
                 if(!empty($result['filter_attribute']['option_values']) and in_array($values['value_id'],$result['filter_attribute']['option_values'])) print 'checked';
                                           ?>>
                                           <?php echo e($values['value']); ?>

                                         </label>
                                       </div>
                                   </li>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </ul>
                           </div>
                       </div>

                     </div>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
                   <div class="color-range-main">

                   <div class="alret alert-danger" id="filter_required">
                   </div>

                   <div class="button">
                   <?php
               $url = '';
                     if(isset($_REQUEST['category'])){
                 $url = "?category=".$_REQUEST['category'];
                 $sign = '&';
               }else{
                 $sign = '?';
               }
               if(isset($_REQUEST['search'])){
                 $url.= $sign."search=".$_REQUEST['search'];
               }
             ?>
                 <a href="<?php echo e(URL::to('/shop')); ?>" class="btn btn-dark" id="apply_options"> <?php echo app('translator')->get('website.Reset'); ?> </a>
                    <?php if(app('request')->input('filters_applied')==1): ?>
                 <button type="button" class="btn btn-secondary" id="apply_options_btn"> <?php echo app('translator')->get('website.Apply'); ?></button>
                   <?php else: ?>
                 <!--<button type="button" class="btn btn-secondary" id="apply_options_btn" disabled> <?php echo app('translator')->get('website.Apply'); ?></button>-->
                   <button type="button" class="btn btn-secondary" id="apply_options_btn" > <?php echo app('translator')->get('website.Apply'); ?></button>
                   <?php endif; ?>
               </div>
             </div>
                   <?php if(count($result['commonContent']['homeBanners'])>0): ?>
                    <?php $__currentLoopData = ($result['commonContent']['homeBanners']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homeBanners): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php if($homeBanners->type==7): ?>
                       <div class="img-main">
                           <a href="<?php echo e($homeBanners->banners_url); ?>" ><img class="img-fluid" src="<?php echo e(asset('').$homeBanners->path); ?>"></a>
                       </div>
                     <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
             </form>
             <?php endif; ?>
         </div>
         <div class="col-12 col-lg-9">
             <div class="breadcum-area">
               <?php if(!empty($result['category_name']) and !empty($result['sub_category_name'])): ?>
                 <h2><?php echo e($result['category_name']); ?></h2>
                 <h5><?php echo e($result['sub_category_name']); ?> and much more...</h5>
                 <?php elseif(!empty($result['category_name']) and empty($result['sub_category_name'])): ?>
                 <h2><?php echo e($result['category_name']); ?></h2>
                 <h5><?php echo e($result['category_name']); ?> and much more...</h5>
                 <?php else: ?>
                 <h2>Watches & Accessories</h2>
                 <h5>Sunglasses,watches,men's clothing and much more...</h5>
                 <?php endif; ?>
             </div>
             <div class="products-area">
                 <div class="top-bar">
                     <div class="row">
                       <div class="col-12 col-lg-12">
                         <div class="row">
                         <div class="col-12 col-xl-6">
                           <div class="block">
                             <label><?php echo app('translator')->get('website.Display'); ?></label>
                             <label>
                                 <a href="javascript:void(0);" id="grid"><i class="fas fa-th-large"></i></a>
                                 <a href="javascript:void(0);" id="list"><i class="fas fa-list"></i></a>
                             </label>
                           </div>
                         </div>
                         <div class="col-12 col-xl-6">
                           <form class="form-inline" id="load_products_form">
                             <?php if(!empty(app('request')->input('search'))): ?>
                              <input type="hidden"  name="search" value="<?php echo e(app('request')->input('search')); ?>">
                             <?php endif; ?>
                             <?php if(!empty(app('request')->input('category'))): ?>
                              <input type="hidden"  name="category" value="<?php if(app('request')->input('category')!='all'): ?><?php echo e(app('request')->input('category')); ?> <?php endif; ?>">
                             <?php endif; ?>
                              <input type="hidden"  name="load_products" value="1">

                             <label><?php echo app('translator')->get('website.Sort'); ?></label>
                             <div class="form-group">
                                 <select name="type" id="sortbytype" class="form-control">
                                   <option value="desc" <?php if(app('request')->input('type')=='desc'): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Newest'); ?></option>
                                   <option value="atoz" <?php if(app('request')->input('type')=='atoz'): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.A - Z'); ?></option>
                                   <option value="ztoa" <?php if(app('request')->input('type')=='ztoa'): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Z - A'); ?></option>
                                   <option value="hightolow" <?php if(app('request')->input('type')=='hightolow'): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Price: High To Low'); ?></option>
                                   <option value="lowtohigh" <?php if(app('request')->input('type')=='lowtohigh'): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Price: Low To High'); ?></option>
                                   <option value="topseller" <?php if(app('request')->input('type')=='topseller'): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Top Seller'); ?></option>
                                   <option value="special" <?php if(app('request')->input('type')=='special'): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Special Products'); ?></option>
                                   <option value="mostliked" <?php if(app('request')->input('type')=='mostliked'): ?> selected <?php endif; ?>><?php echo app('translator')->get('website.Most Liked'); ?></option>
                                   </select>
                             </div>

                             <label><?php echo app('translator')->get('website.Limit'); ?></label>
                             <div class="form-group">
                                 <select class="form-control"name="limit"id="sortbylimit">
                                   <option value="15" <?php if(app('request')->input('limit')=='15'): ?> selected <?php endif; ?>>15</option>
                                   <option value="30" <?php if(app('request')->input('limit')=='30'): ?> selected <?php endif; ?>>30</option>
                                   <option value="60" <?php if(app('request')->input('limit')=='60'): ?> selected <?php endif; ?>>60</option>
                                   </select>
                             </div>
                             <label><?php echo app('translator')->get('website.per page'); ?></label>

                           <?php echo $__env->make('web.common.scripts.shop_page_load_products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                       </div>
                       </div>
                     </div>
                   </div>
                   <?php if(!empty(app('request')->input('search'))): ?>
                       <div class="search-result">
                           <h4><?php echo app('translator')->get('website.Search result for'); ?> '<?php echo e(app('request')->input('search')); ?>' <?php if($result['products']['total_record']>0): ?> <?php echo e($result['products']['total_record']); ?> <?php else: ?> 0 <?php endif; ?> <?php echo app('translator')->get('website.item found'); ?> <h4>
                       </div>
                   <?php endif; ?>
                   <div class="row">

                     <div id="swap" class="col-12 col-sm-12">
                       <div class="row">
                         <?php if($result['products']['success']==1): ?>
                         <?php $__currentLoopData = $result['products']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                         <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                             <!-- Product -->
                             <div class="product">
                               <article>
                                 <div class="thumb">
                                     <div class="icons mobile-icons d-lg-none d-xl-none">
                                       <div class="icon-liked">
                                         <a class="icon active is_liked" products_id="<?=$products->products_id?>">
                                           <i class="fas fa-heart"></i>
                                           <span  class="badge badge-secondary counter"  ><?php echo e($products->products_liked); ?></span>
                                         </a>
                                       </div>
                                       <div class="icon modal_show" data-toggle="modal" data-target="#myModal" products_id="<?php echo e($products->products_id); ?>"><i class="fas fa-eye"></i></div>
                                         <a onclick="myFunction3(<?php echo e($products->products_id); ?>)"class="icon"><i class="fas fa-align-right" data-fa-transform="rotate-90"></i></a>
                                       </div>
                                   <img class="img-fluid" src="<?php echo e(asset('').$products->image_path); ?>" alt="<?php echo e($products->products_name); ?>">
                                 </div>
                                 <?php echo $__env->make('web.common.scripts.addToCompare', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                 <?php
                                    $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                    if($default_currency->id == Session::get('currency_id')){
                                      if(!empty($products->discount_price)){
                                      $discount_price = $products->discount_price;
                                      }
                                      $orignal_price = $products->products_price;
                                    }else{
                                      $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                                      if(!empty($products->discount_price)){
                                        $discount_price = $products->discount_price * $session_currency->value;
                                      }
                                      $orignal_price = $products->products_price * $session_currency->value;
                                    }
                                     if(!empty($products->discount_price)){

                                      if(($orignal_price+0)>0){
                                     $discounted_price = $orignal_price-$discount_price;
                                     $discount_percentage = $discounted_price/$orignal_price*100;
                                     }else{
                                       $discount_percentage = 0;
                                       $discounted_price = 0;
                                   }
                                 ?>
                                 <span class="discount-tag"><?php echo (int)$discount_percentage; ?>%</span>
                                <?php }
                                $current_date = date("Y-m-d", strtotime("now"));

                                $string = substr($products->products_date_added, 0, strpos($products->products_date_added, ' '));
                                $date=date_create($string);
                                date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));

                                //echo $top_seller->products_date_added . "<br>";
                                $after_date = date_format($date,"Y-m-d");

                                if($after_date>=$current_date){
                                  print '<span class="discount-tag">';
                                  print __('website.New');
                                  print '</span>';
                                }
                                 ?>
                                 <span class="tag">
                                   <?php $__currentLoopData = $products->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <?php echo e($category->categories_name); ?><?php if(++$key === count($products->categories)): ?> <?php else: ?>, <?php endif; ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </span>
                                 <h2 class="title text-center"><a href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo e($products->products_name); ?></a></h2>
                                 <p class="discription"><?php echo e($products->products_description); ?></p>

                                 <div class="price">
                                   <?php if(!empty($products->discount_price)): ?>
                                   <?php echo e(Session::get('symbol_left')); ?><?php echo e($discount_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

                                   <span> <?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?></span>
                                   <?php else: ?>
                                   <?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

                                   <?php endif; ?>
                                   <div class="buttons listview-btn">
                                     <?php if($products->products_type==0): ?>
                                        <?php if(!in_array($products->products_id,$result['cartArray'])): ?>
                                            <?php if($products->defaultStock==0): ?>

                                                <button type="button" class="btn btn-block btn-danger" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
                                            <?php elseif($products->products_min_order>1): ?>
                                             <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-block btn-secondary cart" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-block btn-secondary active"><?php echo app('translator')->get('website.Added'); ?></button>
                                        <?php endif; ?>
                                    <?php elseif($products->products_type==1): ?>
                                        <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                                    <?php elseif($products->products_type==2): ?>
                                        <a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn btn-block btn-secondary"><?php echo app('translator')->get('website.External Link'); ?></a>
                                    <?php endif; ?>
                                   </div>
                                 </div>
                                 <div class="product-hover d-none d-lg-block d-xl-block">
                                     <div class="icons">
                                       <div class="icon-liked">
                                         <a class="icon active is_liked" products_id="<?=$products->products_id?>">
                                           <i class="fas fa-heart"></i>
                                           <span  class="badge badge-secondary counter"  ><?php echo e($products->products_liked); ?></span>
                                         </a>
                                       </div>
                                       <div class="icon modal_show" data-toggle="modal" data-target="#myModal" products_id="<?php echo e($products->products_id); ?>"><i class="fas fa-eye"></i></div>
                                         <a onclick="myFunction3(<?php echo e($products->products_id); ?>)"class="icon"><i class="fas fa-align-right" data-fa-transform="rotate-90"></i></a>
                                       </div>
                                   <div class="buttons">
                                     <?php if($products->products_type==0): ?>
                                        <?php if(!in_array($products->products_id,$result['cartArray'])): ?>
                                            <?php if($products->defaultStock==0): ?>

                                                <button type="button" class="btn btn-block btn-danger" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
                                            <?php elseif($products->products_min_order>1): ?>
                                             <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-block btn-secondary cart" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-block btn-secondary active"><?php echo app('translator')->get('website.Added'); ?></button>
                                        <?php endif; ?>
                                    <?php elseif($products->products_type==1): ?>
                                        <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                                    <?php elseif($products->products_type==2): ?>
                                        <a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn btn-block btn-secondary"><?php echo app('translator')->get('website.External Link'); ?></a>
                                    <?php endif; ?>
                                   </div>
                                 </div>
                                 <div class="mobile-buttons d-lg-none d-xl-none">
                                   <?php if($products->products_type==0): ?>
                                      <?php if(!in_array($products->products_id,$result['cartArray'])): ?>
                                          <?php if($products->defaultStock==0): ?>
                                              <button type="button" class="btn btn-block btn-danger" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Out of Stock'); ?></button>
                                          <?php elseif($products->products_min_order>1): ?>
                                           <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                                          <?php else: ?>
                                              <button type="button" class="btn btn-block btn-secondary cart" products_id="<?php echo e($products->products_id); ?>"><?php echo app('translator')->get('website.Add to Cart'); ?></button>
                                          <?php endif; ?>
                                      <?php else: ?>
                                          <button type="button" class="btn btn-block btn-secondary active"><?php echo app('translator')->get('website.Added'); ?></button>
                                      <?php endif; ?>
                                  <?php elseif($products->products_type==1): ?>
                                      <a class="btn btn-block btn-secondary" href="<?php echo e(URL::to('/product-detail/'.$products->products_slug)); ?>"><?php echo app('translator')->get('website.View Detail'); ?></a>
                                  <?php elseif($products->products_type==2): ?>
                                      <a href="<?php echo e($products->products_url); ?>" target="_blank" class="btn btn-block btn-secondary"><?php echo app('translator')->get('website.External Link'); ?></a>
                                  <?php endif; ?>
                                   </div>
                               </article>

                             </div>
                         </div>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endif; ?>
                         <?php echo $__env->make('web.common.scripts.addToCompare', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       </div>
                     </div>
                   </div>
             </div>
             <div class="toolbar mt-3">
                               <div class="form-inline">
                                   <div class="form-group  justify-content-start col-6">
                                     <input id="record_limit" type="hidden" value="<?php echo e($result['limit']); ?>">
                                     <input id="total_record" type="hidden" value="<?php echo e($result['products']['total_record']); ?>">
                                       <label for="staticEmail" class="col-form-label"> <?php echo app('translator')->get('website.Showing'); ?>&nbsp;<span class="showing_record"><?php echo e($result['limit']); ?> </span> &nbsp; <?php echo app('translator')->get('website.of'); ?>  &nbsp;<span class="showing_total_record"><?php echo e($result['products']['total_record']); ?></span> &nbsp;<?php echo app('translator')->get('website.results'); ?></label>
                                   </div>
                                   <div class="form-group justify-content-end col-6">
                                       <input type="hidden" value="1" name="page_number" id="page_number">
                                  <?php
                                           if(!empty(app('request')->input('limit'))){
                                               $record = app('request')->input('limit');
                                           }else{
                                               $record = '15';
                                           }
                                       ?>
                                       <button class="btn btn-dark" type="button" id="load_products"
                                       <?php if(count($result['products']['product_data']) < $record ): ?>
                                           style="display:none"
                                       <?php endif; ?>
                                       ><?php echo app('translator')->get('website.Load More'); ?></button>
                                   </div>
                               </div>
             </div>
           </form>
         </div>



         </div>
       </div>

   </div>
 </section>
<?php /**PATH /var/www/html/zaheeecomm/resources/views/web/shop-pages/shop1.blade.php ENDPATH**/ ?>
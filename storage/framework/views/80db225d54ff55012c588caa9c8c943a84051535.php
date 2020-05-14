<main id="scrollbar-body" data-scrollbar>
    <!-- banner wrap -->

    <section class="product-desc-wrap section">
        <div class="container">
            <div class="product-desc-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-slider-warper">
                            <div class="slider pro-full-slider">
                                <?php $__currentLoopData = $result['detail']['product_data'][0]->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($images->image_type == 'ACTUAL'): ?>
                                    <div class="items">
                                        <img src="<?php echo e(asset('').$images->image_path); ?>" alt="Zoom Image" />
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="slider pro-thubnail-slider">
                                <?php $__currentLoopData = $result['detail']['product_data'][0]->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($images->image_type == 'ACTUAL'): ?>
                                        <div class="items">
                                            <img src="<?php echo e(asset('').$images->image_path); ?>" alt="Zoom Image"/>
                                        </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-deatil-warper">
                            <form name="attributes" id="add-Product-form" method="post" >
                                <input type="hidden" name="products_id" value="<?php echo e($result['detail']['product_data'][0]->products_id); ?>">

                                <input type="hidden" name="products_price" id="products_price" value="<?php if(!empty($result['detail']['product_data'][0]->flash_price)): ?> <?php echo e($result['detail']['product_data'][0]->flash_price+0); ?> <?php elseif(!empty($result['detail']['product_data'][0]->discount_price)): ?><?php echo e($result['detail']['product_data'][0]->discount_price+0); ?><?php else: ?><?php echo e($result['detail']['product_data'][0]->products_price+0); ?><?php endif; ?>">

                                <input type="hidden" name="checkout" id="checkout_url" value="<?php if(!empty(app('request')->input('checkout'))): ?> <?php echo e(app('request')->input('checkout')); ?> <?php else: ?> false <?php endif; ?>" >

                                <input type="hidden" id="max_order" value="<?php if(!empty($result['detail']['product_data'][0]->products_max_stock)): ?> <?php echo e($result['detail']['product_data'][0]->products_max_stock); ?> <?php else: ?> 0 <?php endif; ?>" >
                            <!----attribute option code  ------>

                                <?php if(!empty($result['cart'])): ?>
                                    <input type="hidden"  name="customers_basket_id" value="<?php echo e($result['cart'][0]->customers_basket_id); ?>" >
                                <?php endif; ?>
                                <div class="product-controls">
                                    <?php if(count($result['detail']['product_data'][0]->attributes)>0): ?>
                                        <?php
                                        $index = 0;
                                        ?>
                                        <?php $__currentLoopData = $result['detail']['product_data'][0]->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attributes_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
//                                                dd($result['detail']['product_data'][0]->attributes);
                                            $functionValue = 'function_'.$key++;
                                            ?>
                                            <input type="hidden" name="option_name[]" value="<?php echo e($attributes_data['option']['name']); ?>" >
                                            <input type="hidden" name="option_id[]" value="<?php echo e($attributes_data['option']['id']); ?>" >
                                            <input type="hidden" name="<?php echo e($functionValue); ?>" id="<?php echo e($functionValue); ?>" value="0" >
                                            <input id="attributeid_<?=$index?>" type="hidden" value="">
                                            <input id="attribute_sign_<?=$index?>" type="hidden" value="">
                                            <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]" value="" >
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                        <!--end code segmetnt-->
                                    <div class="product-desc product-desc-title">
                                        <ul class="arrows">
                                            <li class=""><a href="<?php echo e(URL::to('/')); ?>"><?php echo app('translator')->get('website.Home'); ?></a></li>
                                            <?php if(!empty($result['category_name']) and !empty($result['sub_category_name'])): ?>
                                                <li class=""><a href="<?php echo e(URL::to('/shop?category='.$result['category_slug'])); ?>"><?php echo e($result['category_name']); ?></a></li>
                                                <li class=""><a href="<?php echo e(URL::to('/shop?category='.$result['sub_category_slug'])); ?>"><?php echo e($result['sub_category_name']); ?></a></li>
                                            <?php elseif(!empty($result['category_name']) and empty($result['sub_category_name'])): ?>
                                                <li class=""><a href="<?php echo e(URL::to('/shop?category='.$result['category_slug'])); ?>"><?php echo e($result['category_name']); ?></a></li>
                                            <?php endif; ?>
                                            <li class="active"><?php echo e($result['detail']['product_data'][0]->products_name); ?></li>
                                        </ul>
                                        <h6><?php echo e($result['detail']['product_data'][0]->products_name); ?></h6>

                                        <div class="product-desc-sub">
                                            <div class="product-desc-sub-ele">
                                                <p>  <i class="fa fa-star" aria-hidden="true"></i>
                                                    <span class="count">(0)</span> </p>
                                            </div>
                                            <div class="product-desc-sub-ele">
                                                <p>Orders <span class="count">(<?php echo e($result['detail']['product_data'][0]->products_ordered); ?>)</span></p>
                                            </div>
                                        </div>
                                    </div>
                                        <?php if(count($result['detail']['product_data'][0]->attributes)>0): ?>
                                    <div class="product-desc product-desc-size">
                                            <?php $__currentLoopData = $result['detail']['product_data'][0]->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attributes_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="">
                                                    <label><?php echo e($attributes_data['option']['name']); ?></label>
                                                    <div class="select-control ">
                                                        <select name="<?php echo e($attributes_data['option']['id']); ?>" onChange="getQuantity()" class="currentstock form-control attributeid_<?=$index++?>" attributeid = "<?php echo e($attributes_data['option']['id']); ?>">
                                                            <?php if(!empty($result['cart'])): ?>
                                                                <?php
                                                                    $value_ids = array();
                                                                     foreach($result['cart'][0]->attributes as $values){
                                                                         $value_ids[] = $values->options_values_id;
                                                                     }
                                                                ?>
                                                                <?php $__currentLoopData = $attributes_data['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(!empty($result['cart'])): ?>
                                                                        <option <?php if(in_array($values_data['id'],$value_ids)): ?> selected <?php endif; ?> attributes_value="<?php echo e($values_data['products_attributes_id']); ?>" value="<?php echo e($values_data['id']); ?>" prefix = '<?php echo e($values_data['price_prefix']); ?>'  value_price ="<?php echo e($values_data['price']+0); ?>" ><?php echo e($values_data['value']); ?></option>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <?php $__currentLoopData = $attributes_data['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option attributes_value="<?php echo e($values_data['products_attributes_id']); ?>" value="<?php echo e($values_data['id']); ?>" prefix = '<?php echo e($values_data['price_prefix']); ?>'  value_price ="<?php echo e($values_data['price']+0); ?>" ><?php echo e($values_data['value']); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                        <?php endif; ?>
                                        <?php if($result['detail']['product_data'][0]->defaultStock > 0): ?>
                                    <div class="product-desc product-desc-qty">
                                        <div class="product-label-wrap">
                                            <div class="label"><p>Quantity:</p></div>
                                            <div class="qty-wrap qty-sm">
                                                    <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                                    <input type="number" id="number" readonly name="quantity" value="<?php echo e($result['detail']['product_data'][0]->products_min_order); ?>">
                                                    <div class="value-button" id="increase" onclick="increaseValue()" >+</div>
                                            </div>
                                        </div>
                                    </div>
                                        <?php endif; ?>


                                    <div class="product-desc product-desc-action">
                                        <div class="product-action-ele">
                                            <h6 class="primary-color">
                                                <?php
                                                $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                                if($default_currency->id == Session::get('currency_id')){
                                                    if(!empty($result['detail']['product_data'][0]->discount_price)){
                                                        $discount_price = $result['detail']['product_data'][0]->discount_price;
                                                    }
                                                    if(!empty($result['detail']['product_data'][0]->flash_price)){
                                                        $flash_price = $result['detail']['product_data'][0]->flash_price;
                                                    }
                                                    $orignal_price = $result['detail']['product_data'][0]->products_price;
                                                }else{
                                                    $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                                                    if(!empty($result['detail']['product_data'][0]->discount_price)){
                                                        $discount_price = $result['detail']['product_data'][0]->discount_price * $session_currency->value;
                                                    }
                                                    if(!empty($result['detail']['product_data'][0]->flash_price)){
                                                        $flash_price = $result['detail']['product_data'][0]->flash_price * $session_currency->value;
                                                    }
                                                    $orignal_price = $result['detail']['product_data'][0]->products_price * $session_currency->value;
                                                }
                                                if(!empty($result['detail']['product_data'][0]->discount_price)){

                                                    if(($orignal_price+0)>0){
                                                        $discounted_price = $orignal_price-$discount_price;
                                                        $discount_percentage = $discounted_price/$orignal_price*100;
                                                        $discounted_price = $result['detail']['product_data'][0]->discount_price;

                                                    }else{
                                                        $discount_percentage = 0;
                                                        $discounted_price = 0;
                                                    }
                                                }
                                                else{
                                                    $discounted_price = $orignal_price;
                                                }
                                                ?>
                                                <?php if(!empty($result['detail']['product_data'][0]->flash_price)): ?>
                                                    <?php echo e(Session::get('symbol_left')); ?><?php echo e($flash_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

                                                <?php elseif(!empty($result['detail']['product_data'][0]->discount_price)): ?>
                                                    <?php echo e(Session::get('symbol_left')); ?><?php echo e($discount_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

                                                <?php else: ?>
                                                    <?php echo e(Session::get('symbol_left')); ?><?php echo e($orignal_price+0); ?><?php echo e(Session::get('symbol_right')); ?>

                                                <?php endif; ?>

                                            </h6>
                                            <div class="button-outer">
                                                <button type="button" class="btn btn-border add-to-Cart stock-cart" products_id="<?php echo e($result['detail']['product_data'][0]->products_id); ?>">Add to Cart</button>
                                                <a href="javascript:void(0)" class="btn btn-default stock-cart buy-now" products_id="<?php echo e($result['detail']['product_data'][0]->products_id); ?>">Buy Now</a>
                                            </div>
                                        </div>
                                        <div class="product-action-ele">
                                            <ul>
                                                <li><a href="javascript:void(0)" class="red-color whishlist" products_id="<?php echo e($result['detail']['product_data'][0]->products_id); ?>"><i class="fa fa-heart" aria-hidden="true"></i> Add to Wish List</a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <div class="description-detail-wrap">
                <div class="container">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-des">Description</a>
                        <a class="nav-item nav-link"  data-toggle="tab" href="#nav-review" >Reviews</a>
                        <a class="nav-item nav-link"  data-toggle="tab" href="#nav-tag" >Need Help ?</a>

                    </div>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-des" role="tabpanel" aria-labelledby="nav-home-tab">
                            <?=stripslashes($result['detail']['product_data'][0]->products_description)?>
                        </div>
                        <div class="tab-pane fade" id="nav-tag" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>

                        </div>
                        <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="may-like-wrap section">
        <div class="container">
            <div class="title-wrap d-flex justify-content-between align-items-center">
                <div class="title-box">
                    <h6>You may Like</h6>
                </div>
            </div>
            <div class="product-slider b-product-slider">
                <?php $__currentLoopData = $result['simliar_products']['product_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($result['detail']['product_data'][0]->products_id != $products->products_id): ?>
                        <?php if(++$key<=5): ?>
                            <?php echo $__env->make('web.common.product-ref', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
</main>
<?php /**PATH /var/www/html/resources/views/web/details/detail1.blade.php ENDPATH**/ ?>
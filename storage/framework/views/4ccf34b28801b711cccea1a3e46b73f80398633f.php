<?php $qunatity=0; ?>
                <?php $__currentLoopData = $result['commonContent']['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                	<?php $qunatity += $cart_data->customers_basket_quantity; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <a href="#" id="dropdownMenuButton" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="badge badge-secondary"><?php echo e($qunatity); ?></span>
                    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                    <!--<img class="img-fluid" src="<?php echo e(asset('').'public/images/shopping_cart.png'); ?>" alt="icon">-->

                    <span class="block">
                    	<span class="title"><?php echo app('translator')->get('website.My Cart'); ?></span>
                        <?php if(count($result['commonContent']['cart'])>0): ?>
                            <span class="items"><?php echo e(count($result['commonContent']['cart'])); ?>&nbsp;<?php echo app('translator')->get('website.items'); ?></span>
                        <?php else: ?>
                            <span class="items">(0)&nbsp;<?php echo app('translator')->get('website.item'); ?></span>
                        <?php endif; ?>
                    </span>
                </a>

                <?php if(count($result['commonContent']['cart'])>0): ?>
                <?php
                $default_currency = DB::table('currencies')->where('is_default',1)->first();
                if($default_currency->id == Session::get('currency_id')){

                  $currency_value = 1;
                }else{
                  $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();

                  $currency_value = $session_currency->value;
                }
                ?>
                <div class="shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownCartButton_9">
                    <ul class="shopping-cart-items">
                        <?php
                            $total_amount=0;
                            $qunatity=0;
                        ?>
                        <?php $__currentLoopData = $result['commonContent']['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php
					             	$total_amount += $cart_data->final_price*$cart_data->customers_basket_quantity;
					            	$qunatity 	  += $cart_data->customers_basket_quantity; ?>
                        <li>
                            <div class="item-thumb">
                            	<a href="<?php echo e(URL::to('/deleteCart?id='.$cart_data->customers_basket_id)); ?>" class="icon" ><img class="img-fluid" src="<?php echo e(asset('').'web/images/close.png'); ?>" alt="icon"></a>
                            	<div class="image">
                                	<img class="img-fluid" src="<?php echo e(asset('').$cart_data->image); ?>" alt="<?php echo e($cart_data->products_name); ?>"/>
                                </div>
                            </div>
                            <div class="item-detail">
                              <h2 class="item-name"><?php echo e($cart_data->products_name); ?></h2>
                              <span class="item-quantity"><?php echo app('translator')->get('website.Qty'); ?>&nbsp;:&nbsp;<?php echo e($cart_data->customers_basket_quantity); ?></span>
                              <span class="item-price"><?php echo e(Session::get('symbol_left')); ?><?php echo e($cart_data->final_price*$cart_data->customers_basket_quantity*$currency_value); ?><?php echo e(Session::get('symbol_right')); ?></span>
                           </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li>
                      <div class="tt-summary">
                      	  <p><?php echo app('translator')->get('website.items'); ?><span><?php echo e($qunatity); ?></span></p>
                        	<p><?php echo app('translator')->get('website.SubTotal'); ?><span><?php echo e(Session::get('symbol_left')); ?><?php echo e($total_amount*$currency_value); ?><?php echo e(Session::get('symbol_right')); ?></span></p>
                      </div>
                    </li>
                    <li>
                      <div class="buttons">
                          <a class="btn btn-dark" href="<?php echo e(URL::to('/viewcart')); ?>"><?php echo app('translator')->get('website.View Cart'); ?></a>
                          <a class="btn btn-secondary" href="<?php echo e(URL::to('/checkout')); ?>"><?php echo app('translator')->get('website.Checkout'); ?></a>
                      </div>
                   </li>
                 </ul>

                </div>

				<?php else: ?>

                <div class="shopping-cart shopping-cart-empty dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <ul class="shopping-cart-items">
                        <li><?php echo app('translator')->get('website.You have no items in your shopping cart'); ?></li>
                    </ul>
                </div>
                <?php endif; ?>


<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<?php /**PATH /var/www/html/zaheeecomm/resources/views/web/headers/cartButtons/cartButton.blade.php ENDPATH**/ ?>
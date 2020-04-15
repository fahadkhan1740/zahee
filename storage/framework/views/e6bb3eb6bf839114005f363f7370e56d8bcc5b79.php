
<?php $__env->startSection('content'); ?>
<!-- cart Content -->

  <main id="scrollbar-body" data-scrollbar="">

     
        <section class="section cart cart-step-1">
            <div class="container">
                 <div class="row">
                     <div class="col-md-9">
                          <div class="cart-col cart-left box-shadow">
                            <div class="cart-title">
                                <h6>My Cart(2)</h6>
                            </div>

                            <div class="cart-items-wrap">

                                 <!-- cart -items -->
                                <div class="cart-item">
                                    <div class="cart-item-col cart-item-left">
                                           <div class="cart-item-sb-wrap cart-item-top">
                                                <div class="cart-item-sb-col-left cart-item-sb-col cart-item-product">
                                                    <figure class="cart-figure-pro"><img src="images/cart-product-1.png" alt="cart-product-1.png"></figure>
                                                </div>
                                                <div class="cart-item-sb-col cart-item-sb-col-right cart-item-product-detail">
                                                    <h6><a href="#">Lorem Ipsum is dummy text</a></h6>
                                                    <span class="price">$100</span>
                                                </div>
                                           </div>
                                           <div class="cart-item-sb-wrap cart-item-bottom">
                                                <div class="cart-item-sb-col-left cart-item-sb-col  cart-item-product-qty">
                                                    <form class="qty-wrap qty-sm">
                                                        <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                                        <input type="number" class="number" id="number" value="0">
                                                        <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                                                      </form>
                                                </div>
                                                <div class="cart-item-sb-col cart-item-sb-col-right cart-item-product-remove">
                                                     <p><a href="#" class="remove">Remove</a></p>
                                                </div>
                                           </div>
                                    </div>
                                    <div class="cart-item-col cart-item-right">
                                        <p>Delivered by Mon, 20th ‘18</p>
                                    </div>
                                </div>

                                <!-- cart -items -->

                                <div class="cart-item">
                                    <div class="cart-item-col cart-item-left ">
                                        <div class="cart-item-sb-wrap cart-item-top">
                                                <div class="cart-item-sb-col-left cart-item-sb-col cart-item-product">
                                                    <figure class="cart-figure-pro"><img src="images/cart-product-2.png" alt="cart-product-2.png"></figure>
                                                </div>
                                                <div class="cart-item-sb-col cart-item-sb-col-right cart-item-product-detail">
                                                    <h6><a href="#">Lorem Ipsum is dummy text</a></h6>
                                                    <span class="price">$100</span>
                                                </div>
                                        </div>
                                        <div class="cart-item-sb-wrap cart-item-bottom">
                                                <div class="cart-item-sb-col-left cart-item-sb-col  cart-item-product-qty">
                                                    <form class="qty-wrap qty-sm">
                                                        <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                                        <input type="number" class="number" id="number" value="0">
                                                        <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                                                    </form>
                                                </div>
                                                <div class="cart-item-sb-col cart-item-sb-col-right cart-item-product-remove">
                                                    <p><a href="#" class="remove">Remove</a></p>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="cart-item-col cart-item-right">
                                        <p>Delivered by Mon, 20th ‘18</p>
                                    </div>
                                </div>


                                <div class="cart-action-wrap text-right ">
                                    <a href="#" class="link-btn">Continue Shopping</a>
                                    <a href="#" class="btn btn-default">Place  Order</a>
                                </div>

                                


                            </div>
                          </div>
                     </div>
                     <div class="col-md-3">
                        <div class="cart-col cart-right  box-shadow">
                            <div class="cart-title">
                                <h6>Price Details</h6>
                            </div>
                            <div class="cart-amount-wrap">
                                <ul>
                                    <li>
                                        <span class="cart-price-col">Price</span>
                                        <span class="cart-price-col">$200</span>
                                    </li>

                                    <li>
                                        <span class="cart-price-col">Delivery Charges</span>
                                        <span class="cart-price-col">$20</span>
                                    </li>

                                    <li class="total-amount">
                                        <span class="cart-price-col">Amount Payable</span>
                                        <span class="cart-price-col">$220</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                     </div>
                 </div>
            </div>
        </section>



    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/zaheeecomm/resources/views/web/carts/viewcart.blade.php ENDPATH**/ ?>
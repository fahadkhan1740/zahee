@extends('web.layout')
@section('content')
<!-- cart Content -->

  <main id="scrollbar-body" data-scrollbar="">
        <section class="section view-cart cart-step-1">
            <div class="container">
                 <div class="row">
                     <div class="col-md-9">
                          <div class="cart-col cart-left box-shadow">
                            <div class="cart-title">
                                <h6>My Cart({{count($result['cart'])}})</h6>
                            </div>
                              <?php
                              $price = 0;
                              ?>
                              @php
                                  $default_currency = DB::table('currencies')->where('is_default',1)->first();

                                  if($default_currency->id == Session::get('currency_id')){

                                   $currency_value = 1;
                                  }else{
                                   $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();

                                   $currency_value = $session_currency->value;
                                  }
                              @endphp

                            <div class="cart-items-wrap">
                                @if(count($result['cart']) > 0)
                                 <!-- cart -items -->
                                @foreach( $result['cart'] as $k => $products)
                                    <?php
                                    $price+= $products->final_price * $products->customers_basket_quantity;
                                    ?>
                                <div class="cart-item">
                                    <div class="cart-item-col cart-item-left">
                                           <div class="cart-item-sb-wrap cart-item-top">
                                                <div class="cart-item-sb-col-left cart-item-sb-col cart-item-product">
                                                    <figure class="cart-figure-pro"><img src="{{url('public').'/'.$products->image_path}}" alt="{{$products->products_name}}"></figure>
                                                </div>
                                                <div class="cart-item-sb-col cart-item-sb-col-right cart-item-product-detail">
                                                    <h6><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a></h6>
                                                    <?php
                                                    $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                                    if($default_currency->id == Session::get('currency_id')){
                                                        if(!empty($products->discount_price)){
                                                            $discount_price = $products->discount_price;
                                                        }
                                                        if(!empty($products->final_price)){
                                                            $flash_price = $products->final_price;
                                                        }
                                                        $orignal_price = $products->price;
                                                    }else{
                                                        $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                                                        if(!empty($products->discount_price)){
                                                            $discount_price = $products->discount_price * $session_currency->value;
                                                        }
                                                        if(!empty($products->final_price)){
                                                            $flash_price = $products->final_price * $session_currency->value;
                                                        }
                                                        $orignal_price = $products->price * $session_currency->value;
                                                    }
                                                    if(!empty($products->discount_price)){

                                                        if(($orignal_price+0)>0){
                                                            $discounted_price = $orignal_price-$discount_price;
                                                            $discount_percentage = $discounted_price/$orignal_price*100;
                                                        }else{
                                                            $discount_percentage = 0;
                                                            $discounted_price = 0;
                                                        }
                                                    }
                                                    ?>
                                                    <div class="price">
                                                        @if(!empty($products->final_price))
                                                            {{Session::get('symbol_left')}}{{($flash_price+0)*$products->customers_basket_quantity}}{{Session::get('symbol_right')}}
                                                        @elseif(!empty($products->discount_price))
                                                            {{Session::get('symbol_left')}}{{($discount_price+0)*$products->customers_basket_quantity}}{{Session::get('symbol_right')}}
                                                            <span> {{Session::get('symbol_left')}}{{($orignal_price+0)*$products->customers_basket_quantity}}{{Session::get('symbol_right')}}</span>
                                                        @else
                                                            {{Session::get('symbol_left')}}{{($orignal_price+0)*$products->customers_basket_quantity}}{{Session::get('symbol_right')}}
                                                        @endif
                                                    </div>
                                                </div>
                                               <div class="item-attributes">
                                                   @if(count($products->attributes) >0)
                                                       @foreach($products->attributes as $attributes)
                                                           <small>{{$attributes->attribute_name}} : {{$attributes->attribute_value}}</small>
                                                       @endforeach
                                                   @endif
                                               </div>
                                           </div>
                                           <div class="cart-item-sb-wrap cart-item-bottom">
                                                <div class="cart-item-sb-col-left cart-item-sb-col  cart-item-product-qty">
                                                    <form class="qty-wrap qty-sm">
                                                        <div class="value-button" id="decrease-{{$k+1}}" onclick="decreaseValue(`{{$k+1}}`)" value="Decrease Value">-</div>
                                                        <input type="number" class="number-{{$k+1}}" id="number-{{$k+1}}" name="quantity[]" readonly value="{{$products->customers_basket_quantity}}" min="{{$products->min_order}}" max="{{$products->max_order}}" />
                                                        <div class="value-button" id="increase-{{$k+1}}" onclick="increaseValue(`{{$k+1}}`)" value="Increase Value">+</div>
                                                      </form>
                                                </div>
                                                <div class="cart-item-sb-col cart-item-sb-col-right cart-item-product-remove">
                                                     <p><a href="{{ URL::to('/deleteCart?id='.$products->customers_basket_id)}}" class="remove"><i class="fa fa-trash" aria-hidden="true"></i>Remove</a></p>
                                                     <p><a href="javascript:void(0)" products_id="{{$products->products_id}}" baskt_id="{{$products->customers_basket_id}}" index="{{$k}}" class="update-cart-value"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update Cart</a></p>
                                                </div>
                                           </div>
                                    </div>
                                    <div class="cart-item-col cart-item-right">
                                        <p>Delivered by Mon, 20th ‘18</p>
                                    </div>
                                </div>
                                @endforeach
                                <!-- cart -items -->
                                <div class="cart-action-wrap text-right ">
                                    <a href="{{ URL::to('/shop')}}" class="link-btn">@lang('website.Back To Shopping')</a>
                                    <a href="{{ URL::to('/checkout')}}" class="btn btn-default">@lang('website.proceedToCheckout')</a>
                                </div>
                                    @else
                                        <div class="cart-item">
                                            <div class="cart-item-col cart-item-center">
                                                <figure>
                                                    <img src="{{asset('public/web/images/cus/empty-cart.png')}}" alt="empty-cart" style="width:15%">
                                                    <figcaption>No Products in your Cart</figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                @endif
                            </div>

                          </div>

                   <div class="row">
                    <div class="col-12 col-lg-6">
                        <form id="apply_coupon" class="form-validate coupen__wrap">
                            <div class="input-group ">
                                <input type="text"  id="coupon_code" name="coupon_code" class="form-control" placeholder="Coupon Code">
                                <div class="input-group-append">
                                    <button class="btn  btn-secondary" type="button" id="coupon-code">APPLY</button>
                                </div>
                            </div>
                        </form>
                        <div id="coupon_error" class="help-block" style="display: none;color:red; margin-left:12px;"></div>
                        <div  id="coupon_require_error" class="help-block" style="display: none;color:red; margin-left:12px;">@lang('website.Please enter a valid coupon code')</div>
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
                                        <span class="cart-price-col">@lang('website.SubTotal')</span>
                                        <span class="cart-price-col">{{Session::get('symbol_left')}}{{($currency_value * $price)+0-number_format((float)session('coupon_discount'), 2, '.', '')}}{{Session::get('symbol_right')}}</span>
                                    </li>

                                    <li>
                                        <span class="cart-price-col">@lang('website.Discount(Coupon)')</span>
                                        <span class="cart-price-col">{{Session::get('symbol_left')}}{{$currency_value * number_format((float)session('coupon_discount'), 2, '.', '')+0}}{{Session::get('symbol_right')}}</span>
                                    </li>
                                    <li>
                                        <span class="cart-price-col">Delivery Charges</span>
                                        <span class="cart-price-col">0</span>
                                    </li>
                                    <li class="total-amount">
                                        <span class="cart-price-col">@lang('website.Total')</span>
                                        <span class="cart-price-col">{{Session::get('symbol_left')}}{{($currency_value * $price)+0-number_format((float)session('coupon_discount'), 2, '.', '')}}{{Session::get('symbol_right')}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                     </div>
                 </div>

            </div>
        </section>



    </main>
@endsection

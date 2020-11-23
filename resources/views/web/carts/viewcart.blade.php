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
                                <h6>@lang('website.My Cart')({{count($result['cart'])}})</h6>
                            </div>
                            <?php
                            $price = 0;
                            $total_discount = 0;
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
                                        $price += is_null($products->final_price) ? $products->price * $products->customers_basket_quantity : $products->final_price * $products->customers_basket_quantity;
                                        $total_discount += is_null($products->final_price) ? $products->price - $products->discount_price : $products->final_price - $products->discount_price;
                                        ?>
                                        <div class="cart-item">
                                            <div class="cart-item-col cart-item-left">
                                                <div class="cart-item-sb-wrap cart-item-top">
                                                    <div
                                                        class="cart-item-sb-col-left cart-item-sb-col cart-item-product">
                                                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                                                            <figure class="cart-figure-pro"><img
                                                                    src="{{ asset($products->image_path) }}"
                                                                    alt="{{$products->products_name}}"></figure>
                                                        </a>
                                                    </div>
                                                    <div
                                                        class="cart-item-sb-col cart-item-sb-col-right cart-item-product-detail">
                                                        <h6>
                                                            <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a>
                                                        </h6>
                                                        <p>
                                                            @if($products->max_order == 0)
                                                                <span class="outstock"
                                                                      style="color: #ce3d4b;font-size: 16px;font-weight: 500;"><i
                                                                        class="fas fa-times"></i> @lang('website.Out of Stock')</span>
                                                            @else
                                                                <span class="instock"
                                                                      style="color: #4CAF50;font-size: 16px;font-weight: 500;"><i
                                                                        class="fas fa-check"></i> @lang('website.In stock')</span>
                                                            @endif
                                                        </p>
                                                        <?php
                                                        $default_currency = DB::table('currencies')->where('is_default',
                                                            1)->first();
                                                        if ($default_currency->id == Session::get('currency_id')) {
                                                            if (!empty($products->discount_price)) {
                                                                $discount_price = $products->discount_price;
                                                            }
                                                            if (!empty($products->final_price) || !is_null($products->final_price)) {
                                                                $flash_price = $products->final_price;
                                                            }
                                                            $orignal_price = $products->price;
                                                        } else {
                                                            $session_currency = DB::table('currencies')->where('id',
                                                                Session::get('currency_id'))->first();
                                                            if (!empty($products->discount_price)) {
                                                                $discount_price = $products->discount_price * $session_currency->value;
                                                            }
                                                            if (!empty($products->final_price)) {
                                                                $flash_price = $products->final_price * $session_currency->value;
                                                            }
                                                            $orignal_price = $products->price * $session_currency->value;
                                                        }
                                                        if (!empty($products->discount_price)) {
                                                            if (($orignal_price + 0) > 0) {
                                                                $discounted_price = $orignal_price - $discount_price;
                                                                $discount_percentage = $discounted_price / $orignal_price * 100;
                                                            } else {
                                                                $discount_percentage = 0;
                                                                $discounted_price = 0;
                                                            }
                                                        }
                                                        ?>
                                                        <div class="price">
                                                            @if(!empty($products->final_price) && empty($products->discount_price))
                                                                <span class="price_type">@lang('website.Price'):</span>
                                                                <span
                                                                    class="old-price"> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif  {{($orignal_price+0)}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                                                <span
                                                                    class="new-price">  @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{($flash_price+0)}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                                                <br>
                                                                <span class="sub_total"><span class="price_type">@lang('website.Sub Total'):</span> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif  {{($flash_price+0)*$products->customers_basket_quantity}}@if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif </span>
                                                            @elseif(!empty($products->discount_price) && !empty($products->final_price))
                                                                <span class="price_type">@lang('website.Price'):</span>
                                                                <span
                                                                    class="old-price"> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif  {{($orignal_price+0)}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                                                <span
                                                                    class="new-price">  @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif  {{($discount_price+0)}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                                                <br>
                                                                <span class="sub_total"> <span class="price_type">@lang('website.Sub Total'):</span> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif  {{($discount_price+0)*$products->customers_basket_quantity}}@if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif </span>
                                                            @else
                                                                <span
                                                                    class="new-price">@lang('website.Price') @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif  {{($orignal_price+0)}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                                                <br>
                                                                <span class="sub_total"><span class="price_type">@lang('website.Sub Total'):</span> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{($orignal_price+0)*$products->customers_basket_quantity}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="item-attributes">
                                                        @if(count($products->attributes) >0)
                                                            @foreach($products->attributes as $attributes)
                                                                <small>{{$attributes->attribute_name}}
                                                                    : {{$attributes->attribute_value}}</small>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="cart-item-sb-wrap cart-item-bottom">
                                                    <div
                                                        class="cart-item-sb-col-left cart-item-sb-col  cart-item-product-qty">
                                                        <form class="qty-wrap qty-sm">
                                                            <div class="value-button update-cart-value"
                                                                 id="decrease-{{$k+1}}" action="decrease"
                                                                 products_id="{{$products->products_id}}"
                                                                 baskt_id="{{$products->customers_basket_id}}"
                                                                 index="{{$k+1}}" value="Decrease Value">-
                                                            </div>
                                                            <input type="number" class="number" id="number-{{$k+1}}"
                                                                   name="quantity[]" readonly
                                                                   value="{{$products->customers_basket_quantity}}"
                                                                   min="{{$products->min_order}}"
                                                                   max="{{$products->max_order}}"/>
                                                            <div class="value-button update-cart-value"
                                                                 id="increase-{{$k+1}}" action="increase"
                                                                 products_id="{{$products->products_id}}"
                                                                 baskt_id="{{$products->customers_basket_id}}"
                                                                 index="{{$k+1}}" value="Increase Value">+
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div
                                                        class="cart-item-sb-col cart-item-sb-col-right cart-item-product-remove">
                                                        <p>
                                                            <a href="{{ URL::to('/deleteCart?id='.$products->customers_basket_id)}}"
                                                               class="remove"><i class="fa fa-trash"
                                                                                 aria-hidden="true"></i>@lang('website.Remove')
                                                            </a></p>
                                                        <p>
                                                            <a href="{{ URL::to('/product-detail/'.$products->products_slug) }}"
                                                               class="view-product"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i>@lang('website.View')
                                                            </a></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cart-item-col cart-item-right">
                                                <!-- <p>Delivered by Mon, 20th ‘18</p> -->
                                            </div>
                                        </div>
                                    @endforeach
                                <!-- cart -items -->
                                    @php
                                        $total = ($currency_value * $price)+0-number_format((float)session('coupon_discount'), 2, '.', '');
                                    @endphp
                                    <div class="cart-action-wrap text-right ">
                                        @if($total < 5 )
                                            <div class="alert alert-secondary" role="alert">
                                                @lang('website.Minimum order amount is 5.00 KWD.')'
                                            </div>
                                        @endif
                                        @if(app()->getLocale() === 'en')
                                            <a href="{{ URL::to('/shop')}}"
                                               class="btn btn-default pull-left">@lang('website.Back To Shopping')</a>
                                            <a href="{{ URL::to('/wishlist')}}"
                                               class="btn btn-default pull-left">@lang('website.Add from wishlist')</a>
                                            <a href="@if($total < 5 ) javascript:void(0); @else {{ URL::to('/checkout')}} @endif"
                                               class="btn btn-default"
                                               @if($total < 5 ) disabled @endif >@lang('website.proceedToCheckout')</a>
                                        @else
                                            <a href="@if($total < 5 ) javascript:void(0); @else {{ URL::to('/checkout')}} @endif"
                                               class="btn btn-default pull-left"
                                               @if($total < 5 ) disabled @endif >@lang('website.proceedToCheckout')</a>
                                            <a href="{{ URL::to('/wishlist')}}"
                                               class="btn btn-default pull-right">@lang('website.Add from wishlist')</a>
                                            <a href="{{ URL::to('/shop')}}"
                                               class="btn btn-default pull-right">@lang('website.Back To Shopping')</a>
                                        @endif
                                    </div>
                                @else
                                    <div class="cart-item">
                                        <div class="cart-item-col cart-item-center">
                                            <figure>
                                                <img src="{{asset('web/images/cus/empty-cart.png')}}" alt="empty-cart"
                                                     style="width:15%">
                                                <figcaption>@lang('website.No Product has been added to your Cart')</figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="cart-action-wrap text-center ">
                                        <a href="{{ URL::to('/shop')}}"
                                           class="btn btn-default">@lang('website.Back To Shopping')</a>
                                        <a href="{{ URL::to('/wishlist')}}"
                                           class="btn btn-default">@lang('website.Add from wishlist')</a>
                                    </div>


                                @endif
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <form id="apply_coupon" class="form-validate coupen__wrap">
                                    <div class="input-group ">
                                        <input type="text" id="coupon_code" name="coupon_code" class="form-control"
                                               placeholder="@lang('website.Coupon Code')">
                                        <div class="input-group-append">
                                            <button class="btn  btn-secondary" type="button"
                                                    id="coupon-code">@lang('website.APPLY')</button>
                                        </div>
                                    </div>
                                </form>
                                <div id="coupon_error" class="help-block"
                                     style="display: none;color:red; margin-left:12px;"></div>
                                <div id="coupon_require_error" class="help-block"
                                     style="display: none;color:red; margin-left:12px;">@lang('website.Please enter a valid coupon code')</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="cart-col cart-right  box-shadow">
                            <div class="cart-title">
                                <h6>@lang('website.Price Details')</h6>
                            </div>
                            <div class="cart-amount-wrap">
                                <ul>
                                    <li>
                                        <span class="cart-price-col">@lang('website.SubTotal')</span>
                                        <span
                                            class="cart-price-col">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{($currency_value * $price)+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}} @endif</span>
                                    </li>

                                    <li>
                                        <span class="cart-price-col">@lang('website.Discount(Coupon)')</span>
                                        <span
                                            class="cart-price-col">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{abs($currency_value * number_format((float)session('coupon_discount'), 2, '.', '')+0)}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}} @endif</span>
                                    </li>
                                    <li>
                                        <span class="cart-price-col">@lang('website.Delivery Charges')</span>
                                        <span
                                            class="cart-price-col">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{session('shipping_detail')['shipping_price']}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}} @endif</span>
                                    </li>
                                    <li class="total-amount">
                                        <span class="cart-price-col">@lang('website.Total')</span>
                                        <span
                                            class="cart-price-col">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{($currency_value * $price)+0-number_format((float)session('coupon_discount'), 2, '.', '')+session('shipping_detail')['shipping_price']}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}} @endif</span>
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

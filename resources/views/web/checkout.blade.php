@extends('web.layout')
@section('content')

<!-- checkout Content -->
<section class="checkout-area">



 <div class="container">
   <div class="row">
     <div class="col-12 col-sm-12">
       <nav aria-label="breadcrumb">
           <ul class="arrows">
               <li class=""><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
               <li class=""><a href="javascript:void(0)">@lang('website.Checkout')</a></li>
               <li class="active">
                   <a href="javascript:void(0)">
                       @if(session('step')==0)
                           @lang('website.Shipping Address')
                       @elseif(session('step')==1)
                           @lang('website.Billing Address')
                       @elseif(session('step')==3)
                           @lang('website.Order Detail')
                       @endif
                   </a>
               </li>
           </ul>
         </nav>
     </div>
     <div class="col-12 col-xl-9 checkout-left">
       <input type="hidden" id="hyperpayresponse" value="@if(!empty(session('paymentResponse'))) @if(session('paymentResponse')=='success') {{session('paymentResponse')}} @else {{session('paymentResponse')}}  @endif @endif">
       <div class="alert alert-danger alert-dismissible" id="paymentError" role="alert" style="display:none;">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           @if(!empty(session('paymentResponse')) and session('paymentResponse')=='error') {{session('paymentResponseData') }} @endif
       </div>

           <div class="checkout-module">
             <ul class="nav nav-pills mb-3 checkoutd-nav d-none d-lg-flex" id="pills-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==0) active @elseif(session('step')>0) active-check @endif" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">@lang('website.Shipping Address')</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==1) active @elseif(session('step')>1) active-check @endif" @if(session('step')>=1) id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  @endif >@lang('website.Billing Address')</a>
                 </li>
                 <!-- <li class="nav-item">
                   <a class="nav-link @if(session('step')==2) active @elseif(session('step')>2) active-check @endif" @if(session('step')>=2) id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" @endif> @lang('website.Shipping Methods')</a>
                 </li> -->
                 <li class="nav-item">
                     <a class="nav-link @if(session('step')==3) active @elseif(session('step')>3) active-check @endif"  @if(session('step')>=3) id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"@endif>@lang('website.Order Detail')</a>
                   </li>
               </ul>
               <ul class="nav nav-pills mb-3 checkoutm-nav d-flex d-lg-none" id="pills-tab" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link @if(session('step')==0) active @elseif(session('step')>0) active-check @endif" id="pills-shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab" aria-controls="pills-shipping" aria-selected="true">1</a>
                 </li>
                 <li class="nav-item second">
                   <a class="nav-link @if(session('step')==1) active @elseif(session('step')>1) active-check @endif" @if(session('step')>=1) id="pills-billing-tab" data-toggle="pill" href="#pills-billing" role="tab" aria-controls="pills-billing" aria-selected="false"  @endif >2</a>
                 </li>
                 <!-- <li class="nav-item third">
                   <a class="nav-link @if(session('step')==2) active @elseif(session('step')>2) active-check @endif" @if(session('step')>=2) id="pills-method-tab" data-toggle="pill" href="#pills-method" role="tab" aria-controls="pills-method" aria-selected="false" @endif>3</a>
                 </li> -->
                 <li class="nav-item fourth">
                   <a class="nav-link @if(session('step')==3) active @elseif(session('step')>3) active-check @endif"  @if(session('step')>=3) id="pills-order-tab" data-toggle="pill" href="#pills-order" role="tab" aria-controls="pills-order" aria-selected="false"@endif>4</a>
                   </li>
               </ul>
               <div class="tab-content" id="pills-tabContent">
                 <div class="tab-pane fade @if(session('step') == 0) show active @endif" id="pills-shipping" role="tabpanel" aria-labelledby="pills-shipping-tab">
                   <form name="signup" enctype="multipart/form-data" class="form-validate"  action="{{ URL::to('/checkout_shipping_address')}}" method="post">
                     <input type="hidden" required name="_token" id="csrf-token" value="{{ Session::token() }}" />
                     <div class="form-group">
                       <label for="firstName">@lang('website.First Name')</label>
                       <input type="text"  required class="form-control field-validate" id="firstname" name="firstname" value="@if(!empty(session('shipping_address'))>0){{session('shipping_address')->firstname}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                       <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your first name')</span>
                     </div>
                     <div class="form-group">
                       <label for="lastName">@lang('website.Last Name')</label>
                       <input type="text" required class="form-control field-validate" id="lastname" name="lastname" value="@if(!empty(session('shipping_address'))>0){{session('shipping_address')->lastname}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Last Name">
                       <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your last name')</span>
                     </div>

                     <div class="form-group">
                       <label for="exampleInputAddress1">@lang('website.Address')</label>
                       <input type="text" required class="form-control field-validate" name="flat" id="flat" aria-describedby="addressHelp" placeholder="@lang('website.address_flat')">
                         <br>
                       <input type="text" required class="form-control field-validate" name="street" id="street" aria-describedby="addressHelp" placeholder="@lang('website.address_street')">
                       <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
                     </div>
                     <div class="form-group">
                       <label for="exampleSelectCountry1">@lang('website.Country')</label>
                       <div class="select-control">
                           <select required class="form-control field-validate" id="entry_country_id" onChange="getZones();" name="countries_id" aria-describedby="countryHelp">
                             <option value="" selected>@lang('website.Select Country')</option>
                             @if(!empty($result['countries'])>0)
                               @foreach($result['countries'] as $countries)
                                   <option value="{{$countries->countries_id}}" @if(!empty(session('shipping_address'))>0) @if(session('shipping_address')->countries_id == $countries->countries_id) selected @endif @endif >{{$countries->countries_name}}</option>
                               @endforeach
                             @endif
                             </select>
                       </div>
                       <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please select your country')</span>
                     </div>
                       <div class="form-group">
                           <label for="exampleSelectCity1">City</label>
                           <input required type="text" class="form-control field-validate" id="city" name="city" value="@if(!empty(session('shipping_address'))>0){{session('shipping_address')->city}}@endif" placeholder="Enter Your City">
                           <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                       </div>
                       <div class="form-group">
                         <label for="exampleInputNumber1">@lang('website.Phone Number')</label>
                         <input required type="text" class="form-control" id="delivery_phone" aria-describedby="numberHelp" placeholder="Enter Your Phone Number" name="delivery_phone" value="@if(!empty(session('shipping_address'))>0){{session('shipping_address')->delivery_phone}}@endif">
                         <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                       </div>
                       <div class="form-group">
                           <label for="exampleInputZpCode1">@lang('website.address_type')</label>
                           <select class="form-control" id="address_type" name="address_type" required>
                               <option value="home"> @lang('website.home')</option>
                               <option value="office">@lang('website.office')</option>
                           </select>
                           <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please select your address type')</span>
                       </div>
                       <div class="col-12 col-sm-12">
                         <div class="row">
                           <button type="submit"  class="btn btn-secondary">@lang('website.Continue')</button>
                         </div>
                       </div>
                   </form>
                 </div>
                 <div class="tab-pane fade @if(session('step') == 1) show active @endif"  id="pills-billing" role="tabpanel" aria-labelledby="pills-billing-tab">
                     <form name="signup" enctype="multipart/form-data" action="{{ URL::to('/checkout_billing_address')}}" method="post">
                       <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                         <div class="form-group">
                             <label for="exampleInputName1">@lang('website.First Name')</label>
                             <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_firstname" name="billing_firstname" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_firstname}}@endif" aria-describedby="NameHelp1" placeholder="Enter Your Name">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your first name')</span>
                           </div>
                           <div class="form-group">
                             <label for="exampleInputName2">@lang('website.Last Name')</label>
                             <input type="text" class="form-control same_address" aria-describedby="NameHelp2" placeholder="Enter Your Name" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_lastname" name="billing_lastname" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_lastname}}@endif">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your last name')</span>
                           </div>

                           <div class="form-group">
                             <label for="exampleInputAddress1">@lang('website.Address')</label>
                               <input type="text" class="form-control same_address" aria-describedby="addressHelp" placeholder="@lang('website.address_flat')" @if(!empty(session('22'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_flat" name="billing_flat" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_flat}}@endif">
                               <br>
                               <input type="text" class="form-control same_address" aria-describedby="addressHelp" placeholder="@lang('website.address_street')" @if(!empty(session('22'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_street" name="billing_street" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_street}}@endif">
                             <span class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
                           </div>
                           <div class="form-group">
                             <label for="exampleSelectCountry1">@lang('website.Country')</label>
                             <div class="select-control">
                                 <select required class="form-control same_address_select" id="billing_countries_id" aria-describedby="countryHelp" onChange="getBillingZones();" name="billing_countries_id" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) disabled @endif @else disabled @endif>
                                   <option value=""  >@lang('website.Select Country')</option>
                                   @if(!empty($result['countries'])>0)
                                     @foreach($result['countries'] as $countries)
                                         <option value="{{$countries->countries_id}}" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->billing_countries_id == $countries->countries_id) selected @endif @endif >{{$countries->countries_name}}</option>
                                     @endforeach
                                   @endif
                                   </select>
                             </div>
                             <span class="help-block error-content" hidden>@lang('website.Please select your country')</span>
                           </div>
                    
                           <div class="form-group">
                               <label for="exampleSelectCity1">@lang('website.City')</label>
                               <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_city" name="billing_city" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_city}}@endif" placeholder="Enter Your City">
                               <span class="help-block error-content" hidden>@lang('website.Please enter your city')</span>
                           </div>

                             <div class="form-group">
                               <label for="exampleInputNumber1">@lang('website.Phone Number')</label>
                               <input type="text" class="form-control same_address" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_phone" name="billing_phone" value="@if(!empty(session('billing_address'))>0){{session('billing_address')->billing_phone}}@endif" aria-describedby="numberHelp" placeholder="Enter Your Phone Number">
                               <span class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                             </div>
                         <div class="form-group">
                             <label for="exampleInputZpCode1">@lang('website.address_type')</label>
                             <select class="form-control" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) readonly @endif @else readonly @endif  id="billing_address_type" name="billing_address_type">
                                 <option value="home" @if(!empty(session('billing_address'))>0 && (session('billing_address')->billing_address_type === 'home')){{'selected'}} @endif> @lang('website.home')</option>
                                 <option value="office" @if(!empty(session('billing_address'))>0 && (session('billing_address')->billing_address_type === 'office')){{'selected'}} @endif>@lang('website.office')</option>
                             </select>
                             <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please select your address type')</span>
                         </div>
                             <div class="form-group">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="same_billing_address" value="1" name="same_billing_address" @if(!empty(session('billing_address'))>0) @if(session('billing_address')->same_billing_address==1) checked @endif @else checked  @endif > @lang('website.Same shipping and billing address')>

                                     <small id="checkboxHelp" class="form-text text-muted"></small>
                                   </div>
                             </div>

                             <div class="col-12 col-sm-12">
                             <div class="row">
                               <button type="submit"  class="btn btn-secondary"><span>@lang('website.Continue')<i class="fas fa-caret-right"></i></span></button>
                               </div>
                             </div>
                       </form>
                 </div>
                 <!-- <div class="tab-pane fade  @if(session('step') == 2) show active @endif" id="pills-method" role="tabpanel" aria-labelledby="pills-method-tab">

                             <div class="col-12 col-sm-12 ">
                                <div class="row"> <p>@lang('website.Please select a prefered shipping method to use on this order')</p></div>
                             </div>
                             <form name="shipping_mehtods" method="post" id="shipping_mehtods_form" enctype="multipart/form-data" action="{{ URL::to('/checkout_payment_method')}}">
                               <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                  <input type="hidden" name="mehtod_name" id="mehtod_name">
                                  <input type="hidden" name="shipping_price" id="shipping_price">
                                  @foreach($result['shipping_methods'] as $shippingMethod)
                                 <input class="shipping_data" id="{{$shippingMethod['name']}}" type="radio" name="shipping_method" value="{{$shippingMethod['name']}}" shipping_price="10"  method_name="{{$shippingMethod['name']}}" checked />
                                 <label for="{{$shippingMethod['name']}}">{{$shippingMethod['name']}} - {{$shippingMethod['services'][0]['currencyCode']}} {{$shippingMethod['services'][0]['rate']}}</label>
                                 @endforeach
                                 <div class="alert alert-danger alert-dismissible error_shipping" role="alert" style="display:none;">
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                     @lang('website.Please select your shipping method')
                                 </div>
                                 <div class="row">
                                   <button type="submit"class="btn btn-secondary"><span>CONTINUE<i class="fas fa-caret-right"></i></span></button>
                                   </div>
                               </form>


                 </div> -->
                 <div class="tab-pane fade @if(session('step') == 3) show active @endif" id="pills-order" role="tabpanel" aria-labelledby="pills-method-order">
                               <?php
                                   $price = 0;
                               ?>
                               <form method='POST' id="update_cart_form" action="{{ URL::to('/place_order')}}" >
                                 {!! csrf_field() !!}

                                       <table class="table top-table">
                                           <thead>
                                               <tr class="d-flex">
                                                   <th class="col-12 col-md-2">@lang('website.items')</th>
                                                   <th class="col-12 col-md-4"></th>
                                                   <th class="col-12 col-md-2">@lang('website.Price')</th>
                                                   <th class="col-12 col-md-2">@lang('website.Qty')</th>
                                                   <th class="col-12 col-md-2">@lang('website.SubTotal')</th>
                                               </tr>
                                           </thead>

                                           @foreach( $result['cart'] as $products)
                                           <?php
                                              $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                              if($default_currency->id == Session::get('currency_id')){
                                                $orignal_price = $products->final_price;
                                              }else{
                                                $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                                                $orignal_price = $products->final_price * $session_currency->value;
                                              }

                                               $price+= $orignal_price * $products->customers_basket_quantity;
                                           ?>

                                           <tbody>
                                               <tr class="d-flex">
                                                   <td class="col-12 col-md-2 item">
                                                       <input type="hidden" name="cart[]" value="{{$products->customers_basket_id}}">
                                                         <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="cart-thumb">
                                                             <img class="img-fluid" src="{{asset('public').'/'.$products->image_path}}" alt="{{$products->products_name}}" alt="">
                                                         </a>
                                                   </td>
                                                   <td class="col-12 col-md-4 item-detail-left">
                                                     <div class="item-detail">
                                                         <h4>{{$products->products_name}}</h4>
                                                         <div class="item-attributes"></div>

                                                         <div class="item-controls">
                                                           <a class="btn btn-default"   href="{{ URL::to('/product-detail/'.$products->products_slug)}}">Edit</span></a>
                                                           <a class="btn btn-default" href="{{ URL::to('/deleteCart?id='.$products->customers_basket_id)}}">Delete</a>

                                                     </div>
                                                       </div>
                                                   </td>

                                                   <?php
                                                      $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                                      if($default_currency->id == Session::get('currency_id')){
                                                        $orignal_price = $products->final_price;
                                                      }else{
                                                        $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                                                        $orignal_price = $products->final_price * $session_currency->value;
                                                      }
                                                   ?>

                                                   <td class="item-price col-12 col-md-2"><span>{{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}</span></td>
                                                   <td class="col-12 col-md-2">
                                                     <div class="input-group item-quantity">

                                                       <input type="text" id="quantity" readonly name="quantity" class="form-control input-number" value="{{$products->customers_basket_quantity}}">

                                                   </td>
                                                   <td class="align-middle item-total col-12 col-md-2 subtotal" align="center"><span class="cart_price_{{$products->customers_basket_id}}">{{Session::get('symbol_left')}}{{$orignal_price * $products->customers_basket_quantity}}{{Session::get('symbol_right')}}</span>
                                                   </td>
                                               </tr>
                                               <!-- <tr class="d-flex">
                                                   <td class="col-12 col-md-6 p-0">

                                                   </td>
                                                   <td class="col-12 col-md-10 d-none d-md-block"></td>
                                               </tr> -->

                                           </tbody>
                                           @endforeach
                                       </table>
                                                   <?php
                                                       if(!empty(session('shipping_detail')) and !empty(session('shipping_detail'))>0){
                                                           @$shipping_price = session('shipping_detail')['shipping_price'];
                                         $shipping_name = session('shipping_detail')['mehtod_name'];
                                                       }else{
                                                           @$shipping_price = 0;
                                         $shipping_name = '';
                                                       }
                                                       $tax_rate = number_format((float)session('tax_rate'), 2, '.', '');
                                                       $coupon_discount = number_format((float)session('coupon_discount'), 2, '.', '');
                                                       $total_price = ($price+$tax_rate+$shipping_price)-$coupon_discount;
                                       session(['total_price'=>$total_price]);

                                        ?>
                               </form>
                                   <div class="col-12 col-sm-12 mb-3">
                                       <div class="row">
                                         <div class="heading"  style="width:100%; padding:0;">
                                           <h2>@lang('website.orderNotesandSummary')</h2>
                                           <hr>
                                         </div>
                                         <div class="form-group" style="width:100%; padding:0;">
                                             <label for="exampleFormControlTextarea1">@lang('website.Please write notes of your order')</label>
                                             <textarea name="comments" class="form-control" id="order_comments" rows="3">@if(!empty(session('order_comments'))){{session('order_comments')}}@endif</textarea>
                                           </div>
                                       </div>

                                   </div>
                                   <div class="col-12 col-sm-12 mb-3">
                                       <div class="row">
                                         <div class="heading"  style="width:100%; padding:0;">
                                           <h2>@lang('website.Payment Methods')</h2>
                                           <hr>
                                         </div>

                                           <div class="form-group" style="width:100%; padding:0;">
                                               <p class="title">@lang('website.Please select a prefered payment method to use on this order')</p>

                                               <div class="alert alert-danger error_payment" style="display:none" role="alert">
                                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                   @lang('website.Please select your payment method')
                                               </div>

                                               <form name="shipping_mehtods" method="post" id="payment_mehtods_form" enctype="multipart/form-data" action="{{ URL::to('/place_order')}}">
                                                 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                   <ul class="list"style="list-style:none; padding: 0px;display: flex; justify-content: space-between;">
                                                       @foreach($result['payment_methods'] as $payment_methods)
                                                                  <li>
                                                                    <input type="radio" name="payment_method" class="payment_method" value="{{$payment_methods->PaymentMethodId}}">
                                                                    <label for="{{$payment_methods->PaymentMethodEn}}">
                                                                    <img src="{{$payment_methods->ImageUrl}}" alt="{{$payment_methods->PaymentMethodEn}}"/>
                                                                    </label>
                                                                  </li>
                                                            
                                                   
                                                       @endforeach
                                                    
                                                               
                                                               <!-- <input type="hidden" name="payment_method_id" value="0"> -->
                                                              <li>
                                                                <input type="radio" name="payment_method" class="payment_method" value="0">
                                                                <label>
                                                              COD
                                                                </label>
                                                              </li>
                                                   </ul>

                                                   <div class="button">
                                               <button id="pay_button" class="btn btn-default payment_btns">@lang('website.Order Now')</button>
                                           </div>
                                               </form>
                                           </div>
                                           
                                       </div>
          
                 </div>
               </div>
         </div>
     </div>
     @php
     $default_currency = DB::table('currencies')->where('is_default',1)->first();
     if($default_currency->id == Session::get('currency_id')){

       $currency_value = 1;
     }else{
       $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();

       $currency_value = $session_currency->value;
     }
     @endphp
     <!-- <div class="col-12 col-xl-3 checkout-right">
       <table class="table right-table">
         <thead>
           <tr>
             <th scope="col" colspan="2" align="center">@lang('website.Order Summary')</th>

           </tr>
         </thead>
         <tbody>
           <tr>
             <th scope="row">@lang('website.SubTotal')</th>
             <td align="right">{{Session::get('symbol_left')}} {{$price+0}} {{Session::get('symbol_right')}}</td>

           </tr>
           <tr>
             <th scope="row">@lang('website.Discount')</th>
             <td align="right">{{Session::get('symbol_left')}} {{number_format((float)session('coupon_discount'), 2, '.', '')+0*$currency_value}} {{Session::get('symbol_right')}}</td>

           </tr>
           <tr>
               <th scope="row">@lang('website.Tax')</th>
               <td align="right">{{Session::get('symbol_left')}} {{$tax_rate*$currency_value}} {{Session::get('symbol_right')}}</td>

             </tr>
             <tr>
               <th scope="row">@lang('website.Service Tax')</th>
               <td align="right">{{Session::get('symbol_left')}} {{$tax_rate*$currency_value}} {{Session::get('symbol_right')}}</td>

             </tr>
             <tr>
                 <th scope="row">@lang('website.Shipping Cost')</th>
                 <td align="right">{{Session::get('symbol_left')}} {{$shipping_price*$currency_value}} {{Session::get('symbol_right')}}</td>

               </tr>
           <tr class="item-price">
             <th scope="row">@lang('website.Total')</th>
             <td align="right" >{{Session::get('symbol_left')}} {{number_format((float)$total_price+0, 2, '.', '')+0*$currency_value}} {{Session::get('symbol_right')}}</td>

           </tr>
         </tbody>
       </table>
       </div> -->
   </div>
 </div>
 </div>
</section>
@section('scripts')
<script>
// jQuery(document).on('click', '#cash_on_delivery_button', function(e){
// 	jQuery("#update_cart_form").submit();
// });
</script>
@endsection

@endsection

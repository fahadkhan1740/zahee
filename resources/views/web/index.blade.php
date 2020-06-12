@extends('web.layout')
@section('content')
       <!-- End Header Content -->

       <!-- NOTIFICATION CONTENT -->
         @include('web.common.notifications')
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
          @include($r)
      <?php
          }
          if($product_section_order['order'] == 3 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
       ?>
          @include($r)
      <?php
          }
          if($product_section_order['order'] == 6 && $product_section_order['status'] == 1){
          $r =   'web.product-sections.' . $product_section_order['file_name'];
          ?>
       @include($r)

   <?php   }  }
      ?>

        <div class="product-wrap">
            @if(count($result['recently_viewed']) >0 )
           <div class="title-wrap d-flex justify-content-between align-items-center">
               <div class="title-box">
                   <h6>Recent Search</h6>
               </div>
               <!-- <div class="titlee-right">
                   <a href="#" class="see-all-btn">See All</a>
               </div> -->
           </div>
           <div class="product-slider b-product-slider">

               @foreach($result['recently_viewed'] as $viewedProd)
               <div class="items-list text-center">
                   <div class="items-box-wrap">
                       <a href="#" class="heart-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                       <a href="{{ URL::to('product-detail/'.$viewedProd->products_slug) }}">
                           <figure>
                               <img src="{{asset('public/'.$viewedProd->image_path)}}" alt="b-product-1.png" />
                           </figure>
                           <div class="items-content">
                               <h6>{{$viewedProd->products_name}}</h6>
                               <p>
                                   @php
                                   $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                   if($default_currency->id == Session::get('currency_id')){
                                       if(!empty($viewedProd->discount_price)){
                                           $discount_price = $viewedProd->discount_price;
                                       }
                                       if(!empty($viewedProd->flash_price)){
                                           $flash_price = $viewedProd->flash_price;
                                       }
                                       $orignal_price = $viewedProd->products_price;
                                   }else{
                                       $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                                       if(!empty($viewedProd->discount_price)){
                                           $discount_price = $viewedProd->discount_price * $session_currency->value;
                                       }
                                       if(!empty($viewedProd->flash_price)){
                                           $flash_price = $viewedProd->flash_price * $session_currency->value;
                                       }
                                       $orignal_price = $viewedProd->products_price * $session_currency->value;
                                   }
                                   if(!empty($viewedProd->discount_price)){

                                       if(($orignal_price+0)>0){
                                           $discounted_price = $orignal_price-$discount_price;
                                           $discount_percentage = $discounted_price/$orignal_price*100;
                                           $discounted_price = $viewedProd->discount_price;

                                       }else{
                                           $discount_percentage = 0;
                                           $discounted_price = 0;
                                       }
                                   }
                                   else{
                                       $discounted_price = $orignal_price;
                                   }
                                  @endphp
                                   @if(!empty($viewedProd->flash_price))
                                       {{Session::get('symbol_left')}}{{$flash_price+0}}{{Session::get('symbol_right')}}
                                   @elseif(!empty($viewedProd->discount_price))
                                       {{Session::get('symbol_left')}}{{$discount_price+0}}{{Session::get('symbol_right')}}
                                   @else
                                       {{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}
                                   @endif
                               </p>
                           </div>
                       </a>
                   </div>
               </div>
               @endforeach
           </div>
            @endif
       </div>

       </div>
       </section>
       </main>
@include('web.common.scripts.Like')
@endsection

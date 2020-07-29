<?php
//dd($products);
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
      <?php }
      $current_date = date("Y-m-d", strtotime("now"));
      $string = substr($products->products_date_added, 0, strpos($products->products_date_added, ' '));
      $date=date_create($string);
      date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));
      //echo $top_seller->products_date_added . "<br>";
      $after_date = date_format($date,"Y-m-d");
?>

<div class="items-list text-center">
    <div class="items-box-wrap">
        <a href="#" class="heart-icon whishlist" products_id="{{$products->products_id}}"><i class="fa fa-heart" aria-hidden="true"></i></a>

            <figure>
            <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}"> <img src="{{asset('public').'/'.$products->image_path}}" alt="{{$products->products_name}}" /></a>
            </figure>
            <div class="items-content">
                <h6><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}"> {{$products->products_name}}</a></h6>
                <p>
                    <!-- <span class="price "> -->
                         @if(empty($products->discount_price))
                         <span class="price "> {{Session::get('symbol_left')}} {{$orignal_price+0}} {{Session::get('symbol_right')}}</span>
                    <!-- </span> -->
                        @else
                        <span class="price new-price">{{Session::get('symbol_left')}} {{$discount_price+0}} {{Session::get('symbol_right')}}</span>
                            <span class="price old-price"> {{Session::get('symbol_left')}} {{$orignal_price+0}} {{Session::get('symbol_right')}}</span>

                        @endif
                </p>
                <div class="items-bottom-button">
                  <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="link-btn btn btn-block btn-secondary">@lang('website.Shop Now!')</a>
                  <a href="javascript:void(0);" class="link-btn btn btn-block btn-secondary cart" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</a>
                </div>
            </div>

    </div>

</div>

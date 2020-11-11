<div class="items-list text-center">
    <div class="items-box-wrap">
        <a href="javascript:void(0)" class="heart-icon whishlist" products_id="{{$products->products_id}}"><i class="fa fa-heart" aria-hidden="true"></i></a>

            <figure>
            <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}"> <img src="{{asset($products->image_path)}}" alt="{{$products->products_name}}" /></a>
            </figure>
            <div class="items-content">
                <h6><a href="{{ URL::to('/product-detail/'.$products->products_slug)}}"> {{$products->products_name}}</a></h6>
                <?php
                // dd(!empty($rproducts->flash_price));
                $discount_price = 0;
          $default_currency = DB::table('currencies')->where('is_default',1)->first();
          if($default_currency->id == Session::get('currency_id')){
            if(!is_null($products->discount_price)){
            $discount_price = $products->discount_price;
            }
            if(!is_null($products->flash_price)){
                $discount_price = $products->flash_price;
            }
            $orignal_price = $products->products_price;
          }else{
            $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
            if(!is_null($products->discount_price)){
              $discount_price = $products->discount_price * $session_currency->value;
            }
            if(!is_null($products->flash_price)){
                $discount_price = $products->flash_price * $session_currency->value;
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
       <p class="primary-color"><?php echo (int)$discount_percentage; ?>% Off</p>
      <?php } else {
           if(($orignal_price+0)>0){
            $discounted_price = $orignal_price-$discount_price;
            $discount_percentage = $discounted_price/$orignal_price*100;
            }else{
              $discount_percentage = 0;
              $discounted_price = 0;
          }
          ?>
 <p class="primary-color"><?php echo (int)$discount_percentage; ?>% Off</p>
      <?php }
      $current_date = date("Y-m-d", strtotime("now"));
      $string = substr($products->products_date_added, 0, strpos($products->products_date_added, ' '));
      $date=date_create($string);
      date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));
      //echo $top_seller->products_date_added . "<br>";
      $after_date = date_format($date,"Y-m-d");
?>
                <p>
                @if(is_null($products->discount_price) && is_null($products->flash_price))
                    <span class="price "> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                @elseif(is_null($products->flash_price) && !is_null($products->discount_price) )
                    <span class="price new-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$discount_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                    <span class="price old-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                @else
                    <span class="price new-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$discount_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                    <span class="price old-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                @endif
                </p>
                <div class="items-bottom-button">
                @if(!in_array($products->products_id,$result['cartArray']))
                    @if($products->defaultStock==0)
                        <!-- <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="link-btn btn btn-block btn-secondary">@lang('website.Shop Now!')</a> -->
                        <a href="javascript:void(0);" class="link-btn btn btn-block btn-danger" products_id="{{$products->products_id}}">@lang('website.Out of Stock')</a>
                    @else
                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="link-btn btn btn-block btn-secondary">@lang('website.Shop Now!')</a>
                        <a href="javascript:void(0);" class="link-btn btn btn-block btn-secondary cart" products_id="{{$products->products_id}}">@lang('website.Add to Cart')</a>
                    @endif
                @else
                    <a class="btn btn-block btn-secondary active" href="{{ URL::to('/viewcart')}}">@lang('website.Go to Cart')</a>
                @endif
                </div>
            </div>

    </div>

</div>

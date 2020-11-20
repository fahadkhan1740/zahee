<div class="product-wrap ads__warp">
    <div class="title-wrap d-flex justify-content-between align-items-center no-slider ">
        <div class="title-box">
            <h6>@lang('website.Trends')</h6>
        </div>
        <div class="titlee-right">
            <a href="{{ URL::to('/shop?load_products=1&type=trends&limit=15')}}"
               class="see-all-btn">@lang('website.See All')</a>
        </div>
    </div>
    <div class="banner  banner-ads-full  row">
        <div class="col-md-12">
            <figure>
                <a href="{{ URL::to('/shop?load_products=1&type=trends&limit=15')}}">
                    <img src="{{asset($result['commonContent']['trend_image'][0]->path)}}" alt="placeholder"/>
                </a>
            </figure>
        </div>
    </div>
</div>

<div class="product-wrap">
    @if($result['special']['success']==1)
        <div class="title-wrap d-flex justify-content-between align-items-center">
            <div class="title-box">
                <h6>@lang('website.Deals of the day')</h6>
            </div>
            <div class="titlee-right">
                <a href="{{ URL::to('/shop?load_products=1&type=special&limit=15')}}"
                   class="see-all-btn">@lang('website.See All')</a>
            </div>
        </div>
        <div class="product-slider b-product-slider">
            @foreach($result['special']['product_data'] as $key=>$products)
                @include('web.common.product-ref')
            @endforeach
        </div>
    @endif


    <div class="banner  banner-ads row">
        @foreach($result['commonContent']['homeBanners'] as $homeBanner)
            @if($homeBanner->status && $homeBanner->languages_id === 1)
                <div class="col-12 col-md-4">
                    <figure style="background-image:url('<?php echo $homeBanner->path ?>')">
                        <a href="{{URL::to($homeBanner->banners_url)}}">
                        </a>
                    </figure>
                </div>
            @endif
        @endforeach
    </div>
</div>


<!-----------new section ------------------>
<!-- Offer Slider -->
<div class="product-wrap">
    @if($result['flash_sale']['success']==1)
        <div class="title-wrap d-flex justify-content-between align-items-center">
            <div class="title-box">
                <h6>@lang('website.Offers')</h6>
            </div>
            <div class="titlee-right">
                <a href="{{ URL::to('/shop?load_products=1&type=flashsale&limit=15')}}"
                   class="see-all-btn">@lang('website.See All')</a>
            </div>
        </div>

        <div class="product-slider b-product-slider">

            @foreach($result['flash_sale']['product_data'] as $key=>$products)
                <div class="items-list text-center">
                    <div class="items-box-wrap">
                        <a href="javascript:void(0)" class="heart-icon whishlist"
                           products_id="{{$products->products_id}}"><i class="fa fa-heart" aria-hidden="true"></i></a>

                        <figure>
                            <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                                <img src="{{asset($products->image_path)}}" alt="{{$products->products_name}}"/>
                            </a>
                        </figure>
                        <div class="items-content">
                            <h6>
                                <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a>
                            </h6>
                            <?php
                            $default_currency = DB::table('currencies')->where('is_default', 1)->first();
                            if ($default_currency->id == Session::get('currency_id')) {
                                if (!empty($products->flash_price)) {
                                    $discount_price = $products->flash_price;
                                }
                                $orignal_price = $products->products_price;
                            } else {
                                $session_currency = DB::table('currencies')->where('id',
                                    Session::get('currency_id'))->first();
                                if (!empty($products->flash_price)) {
                                    $discount_price = $products->flash_price * $session_currency->value;
                                }

                                $orignal_price = $products->products_price * $session_currency->value;
                            }
                            if(!empty($products->flash_price)){

                            if (($orignal_price + 0) > 0) {
                                $discounted_price = $orignal_price - $discount_price;
                                $discount_percentage = $discounted_price / $orignal_price * 100;
                                $discounted_price = $products->flash_price;
                            } else {
                                $discount_percentage = 0;
                                $discounted_price = 0;
                            }
                            ?>

                            <p class="primary-color"><?php echo (int) $discount_percentage; ?>% Off</p>
                            <p>
                                <!-- <span class="price "> -->
                                @if(empty($discount_price))
                                    <span
                                        class="price "> @if(Session::get('direction') == 'ltr') {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                    <!-- </span> -->
                                @else
                                    <span
                                        class="price new-price"> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif  {{$discount_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                    <span
                                        class="price old-price"> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>

                                @endif
                            </p>
                            <?php }?>
                            <div class="items-bottom-button">
                            @if(!in_array($products->products_id,$result['cartArray']))
                                @if($products->defaultStock==0)
                                    <!-- <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="link-btn btn btn-block btn-secondary">@lang('website.Shop Now!')</a> -->
                                        <a href="javascript:void(0);" class="link-btn btn btn-block btn-danger"
                                           products_id="{{$products->products_id}}">@lang('website.Out of Stock')</a>
                                    @else
                                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}"
                                           class="link-btn btn btn-block btn-secondary">@lang('website.Shop Now!')</a>
                                        <a href="javascript:void(0);" class="link-btn btn btn-block btn-secondary cart"
                                           products_id="{{$products->products_id}}">@lang('website.Add to Cart')</a>
                                    @endif
                                @else
                                    <a class="btn btn-block btn-secondary active"
                                       href="{{ URL::to('/viewcart')}}">@lang('website.Go to Cart')</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>


<!-- Best Seller seller -->
<div class="product-wrap">
    @if($result['top_seller']['success']==1)
        <div class="title-wrap d-flex justify-content-between align-items-center">
            <div class="title-box">
                <h6>@lang('website.Most Selling')</h6>
                <div class="titlee-right">
                    <a href="{{ URL::to('/shop?load_products=1&type=topseller&limit=15')}}"
                       class="see-all-btn">@lang('website.See All')</a>
                </div>
            </div>

        </div>
        <div class="product-slider b-product-slider">
            @foreach($result['top_seller']['product_data'] as $key=>$products)
                @include('web.common.product-ref')
            @endforeach
        </div>
    @endif
</div>

<div class="service-24-wrap">
    <div class="row">
        <div class="col-md-3">
            <div class="service-24-box">
                <figure>
                    <img src="https://zaahee.shop/public/web/images/cus/service-24-icon-1.png"
                         alt="service-24-icon-1.png"/>
                </figure>
                <div class="service-24-content">
                    <h6>@lang('24/7 Online Support')</h6>
                    <p>Still not sure what you need? Contact with customer service and we will help you achieve
                        maximized to choose your needs.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="service-24-box">
                <figure>
                    <img src="https://zaahee.shop/public/web/images/cus/service-24-icon-2.png"
                         alt="service-24-icon-2.png"/>
                </figure>
                <div class="service-24-content">
                    <h6>@lang('Money Guarantee')</h6>
                    <p>If you have already been billed by ZaaHee.shop, ZaaHee.shop will issue full or partial refunds.
                        (According to the terms and conditions in ZaaHee.shop).</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="service-24-box">
                <figure>
                    <img src="https://zaahee.shop/public/web/images/cus/service-24-icon-3.png"
                         alt="service-24-icon-3.png"/>
                </figure>
                <div class="service-24-content">
                    <h6>@lang('website.Secure Payment')</h6>
                    <p>We guarantee that every transaction carried out at zaahee.shop is 100% safe.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="service-24-box">
                <figure>
                    <img src="https://zaahee.shop/public/web/images/cus/service-24-icon-4.png"
                         alt="service-24-icon-4.png"/>
                </figure>
                <div class="service-24-content">
                    <h6>@lang('website.Big Saving')</h6>
                    <p>Buy more save more.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bidding Slider -->
<div class="product-wrap">
    @if($result['featured']['success']==1)
        <div class="title-wrap d-flex justify-content-between align-items-center">
            <div class="title-box">
                <h6>@lang('website.What’s HOT')</h6>
            </div>
            <div class="titlee-right">
                <a href="{{ URL::to('/shop?load_products=1&type=mostliked&limit=15')}}"
                   class="see-all-btn">@lang('website.See All')</a>
            </div>
        </div>

        <div class="product-slider">
            @foreach($result['featured']['product_data'] as $key=>$products)
                <?php

                $default_currency = DB::table('currencies')->where('is_default', 1)->first();
                if ($default_currency->id == Session::get('currency_id')) {
                    if (!empty($products->discount_price)) {
                        $discount_price = $products->discount_price;
                    }
                    $orignal_price = $products->products_price;
                } else {
                    $session_currency = DB::table('currencies')->where('id', Session::get('currency_id'))->first();
                    if (!empty($products->discount_price)) {
                        $discount_price = $products->discount_price * $session_currency->value;
                    }
                    $orignal_price = $products->products_price * $session_currency->value;
                }
                if (!empty($products->discount_price)) {
                    if (($orignal_price + 0) > 0) {
                        $discounted_price = $orignal_price - $discount_price;
                        $discount_percentage = $discounted_price / $orignal_price * 100;
                    } else {
                        $discount_percentage = 0;
                        $discounted_price = 0;
                    }
                    ?>

<?php } ?>

                <div class="items-list text-center">
                    <div class="items-box-wrap">
                        <a href="javascript:void(0)" class="heart-icon whishlist"
                           products_id="{{$products->products_id}}"><i class="fa fa-heart" aria-hidden="true"></i></a>
                        <figure>
                            <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                                <img src="{{asset($products->image_path)}}" alt="{{$products->products_name}}"/>
                            </a>
                        </figure>
                        <div class="items-content">
                            <h6>{{$products->products_name}}</h6>

                            <p class="primary-color"><?php echo @round($discount_percentage); ?> % Off</p>
                            <p>
                                <!-- <span class="price "> -->
                                @if(empty($products->discount_price))
                                    <span
                                        class="price "> @if(Session::get('direction') == 'ltr') {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                    <!-- </span> -->
                                @else
                                    <span
                                        class="price new-price"> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif  {{$discount_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                    <span
                                        class="price old-price"> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>

                                @endif
                            </p>
                            <div class="items-bottom-button">
                            @if(!in_array($products->products_id,$result['cartArray']))
                                @if($products->defaultStock==0)
                                    <!-- <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}" class="link-btn btn btn-block btn-secondary">@lang('website.Shop Now!')</a> -->
                                        <a href="javascript:void(0);" class="link-btn btn btn-block btn-danger"
                                           products_id="{{$products->products_id}}">@lang('website.Out of Stock')</a>
                                    @else
                                        <a href="{{ URL::to('/product-detail/'.$products->products_slug)}}"
                                           class="link-btn btn btn-block btn-secondary">@lang('website.Shop Now!')</a>
                                        <a href="javascript:void(0);" class="link-btn btn btn-block btn-secondary cart"
                                           products_id="{{$products->products_id}}">@lang('website.Add to Cart')</a>
                                    @endif
                                @else
                                    <a class="btn btn-block btn-secondary active"
                                       href="{{ URL::to('/viewcart')}}">@lang('website.Go to Cart')</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

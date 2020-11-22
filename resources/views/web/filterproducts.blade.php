@if($result['products']['success']==1)
    @foreach($result['products']['product_data'] as $key=>$products)
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 griding">
            <!-- Product -->
            <div class="product">
                <article>
                    <div class="thumb">
                        <div class="icons mobile-icons d-lg-none d-xl-none">
                            <div class="icon-liked">
                                <a href="#" class="icon active is_liked" products_id="<?=$products->products_id?>">
                                    <i class="fas fa-heart"></i>
                                </a>
                                <span class="badge badge-secondary counter">{{$products->products_liked}}</span>
                            </div>
                            <div class="icon modal_show" data-toggle="modal" data-target="#myModal"
                                 products_id="{{$products->products_id}}"><i class="fas fa-eye"></i></div>
                            <a onclick="myFunction3({{$products->products_id}})" class="icon"><i
                                    class="fas fa-align-right" data-fa-transform="rotate-90"></i></a>
                        </div>
                        <a class="product-img" href="{{ URL::to('/product-detail/'.$products->products_slug)}}">
                            <!-- <figure> -->
                            <img src="{{asset('public/'.$products->image_path)}}" alt="{{$products->products_name}}"/>
                            <!-- </figure> -->
                        <!-- <img class="img-fluid" src="{{asset('public/'.$products->image_path)}}" alt="{{$products->products_name}}"> -->
                        </a>
                    </div>
                    @section('scripts')
                        @include('web.common.scripts.addToCompare')
                    @endsection
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
                    }
                    $current_date = date("Y-m-d", strtotime("now"));

                    $string = substr($products->products_date_added, 0, strpos($products->products_date_added, ' '));
                    $date = date_create($string);
                    date_add($date, date_interval_create_from_date_string($web_setting[20]->value." days"));

                    //echo $top_seller->products_date_added . "<br>";
                    $after_date = date_format($date, "Y-m-d");

                    if ($after_date >= $current_date) {
                        print '<span class="discount-tag">';
                        print __('website.New');
                        print '</span>';
                    }
                    ?>
                    @if((int)$products->discount_price > 0)
                        <span class="tag">
                                    {{(int)$products->discount_price}}% Off
                                    </span>
                    @endif
                    <div class="product-detaill">
                        <div class="product__left">
                            <div class="icons">
                                <div class="icon-liked">
                                    <a href="#" class="icon active is_liked" products_id="<?=$products->products_id?>">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                    <span class="badge badge-secondary counter">{{$products->products_liked}}</span>
                                </div>
                                <div class="icon modal_show" data-toggle="modal" data-target="#myModal"
                                     products_id="{{$products->products_id}}"><i class="fas fa-eye"></i></div>
                            </div>
                            <h4 class="title text-center"><a
                                    href="{{ URL::to('/product-detail/'.$products->products_slug)}}">{{$products->products_name}}</a>
                            </h4>
                            @if($products->product_sub_title)
                                <p>{{$products->product_sub_title}}</p>
                            @endif

                        </div>
                        <div class="product__right">
                            <p>
                                <!-- <span class="price "> -->
                                @if(empty($products->discount_price))
                                    <span
                                        class="price "> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                    <!-- </span> -->
                                @else
                                    <span
                                        class="price new-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$products->discount_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                    <span
                                        class="price old-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>

                                @endif
                            </p>
                            <div class="product-hover d-none d-lg-block d-xl-block">

                                <div class="buttons">
                                    @if(!in_array($products->products_id,$result['cartArray']))
                                        @if($products->defaultStock==0)
                                            <button type="button" class="btn btn-block btn-danger"
                                                    products_id="{{$products->products_id}}">@lang('website.Out of Stock')</button>
                                        @else
                                            <button type="button" class="btn btn-block btn-secondary cart"
                                                    products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
                                        @endif
                                    @else
                                        <a class="btn btn-block btn-secondary active"
                                           href="{{ URL::to('/viewcart')}}">@lang('website.Go to Cart')</a>
                                    @endif
                                </div>
                            </div>
                            <div class="mobile-buttons d-lg-none d-xl-none">
                                @if(!in_array($products->products_id,$result['cartArray']))
                                    @if($products->defaultStock==0)
                                        <button type="button" class="btn btn-block btn-danger"
                                                products_id="{{$products->products_id}}">@lang('website.Out of Stock')</button>
                                    @else
                                        <button type="button" class="btn btn-block btn-secondary cart"
                                                products_id="{{$products->products_id}}">@lang('website.Add to Cart')</button>
                                    @endif
                                @else
                                    <a class="btn btn-block btn-secondary active"
                                       href="{{ URL::to('/viewcart')}}">@lang('website.Go to Cart')</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>

            </div>
        </div>
    @endforeach
    <input id="filter_total_record" type="hidden" value="{{$result['products']['total_record']}}">

    @if(count($result['products']['product_data'])> 0 and $result['limit'] > $result['products']['total_record'])
        <style>
            #load_products {
                display: none;
            }

            #loaded_content {
                display: block !important;
            }

            #loaded_content_empty {
                display: none !important;
            }
        </style>
    @endif
@elseif(count($result['products']['product_data'])==0 or $result['products']['success']==0)
    <style>
        #load_products {
            display: none;
        }

        #loaded_content {
            display: none !important;
        }

        #loaded_content_empty {
            display: block !important;
        }
    </style>
@endif

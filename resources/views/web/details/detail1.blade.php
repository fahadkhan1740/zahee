<main id="scrollbar-body" data-scrollbar>
    <!-- banner wrap -->
    <section class="product-desc-wrap section">
        <div class="container">
            <div class="product-desc-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-slider-warper">
                            <div class="slider pro-full-slider">
                                @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                                    @if($images->image_type == 'ACTUAL')
                                        <div class="items">
                                            <img src="{{asset(''.$images->image_path) }}" alt="Zoom Image"/>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="slider pro-thubnail-slider">
                                @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                                    @if($images->image_type == 'ACTUAL')
                                        <div class="items">
                                            <img src="{{asset(''.$images->image_path) }}" alt="Zoom Image"/>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-deatil-warper">
                            <form name="attributes" id="add-Product-form" method="post">
                                <input type="hidden" name="products_id"
                                       value="{{$result['detail']['product_data'][0]->products_id}}">

                                <input type="hidden" name="products_price" id="products_price"
                                       value="@if(!empty($result['detail']['product_data'][0]->flash_price)) {{$result['detail']['product_data'][0]->flash_price+0}} @elseif(!empty($result['detail']['product_data'][0]->discount_price)){{$result['detail']['product_data'][0]->discount_price+0}}@else{{$result['detail']['product_data'][0]->products_price+0}}@endif">

                                <input type="hidden" name="checkout" id="checkout_url"
                                       value="@if(!empty(app('request')->input('checkout'))) {{ app('request')->input('checkout') }} @else false @endif">

                                <input type="hidden" id="max_order"
                                       value="@if(!empty($result['detail']['product_data'][0]->products_max_stock)) {{ $result['detail']['product_data'][0]->products_max_stock }} @else 0 @endif">
                                <!----attribute option code  ------>

                                @if(!empty($result['cart']))
                                    <input type="hidden" name="customers_basket_id"
                                           value="{{$result['cart'][0]->customers_basket_id}}">
                                @endif
                                <div class="product-controls">
                                    @if(count($result['detail']['product_data'][0]->attributes)>0)
                                        <?php
                                        $index = 0;
                                        ?>
                                        @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
                                            <?php

                                            $functionValue = 'function_'.$key++;
                                            ?>
                                            <input type="hidden" name="option_name[]"
                                                   value="{{ $attributes_data['option']['name'] }}">
                                            <input type="hidden" name="option_id[]"
                                                   value="{{ $attributes_data['option']['id'] }}">
                                            <input type="hidden" name="{{ $functionValue }}" id="{{ $functionValue }}"
                                                   value="0">
                                            <input id="attributeid_<?=$index?>" type="hidden" value="">
                                            <input id="attribute_sign_<?=$index?>" type="hidden" value="">
                                            <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]"
                                                   value="">
                                        @endforeach
                                    @endif
                                <!--end code segmetnt-->
                                    <div class="product-desc product-desc-title">
                                        <ul class="arrows">
                                            <li class=""><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
                                            @if(!empty($result['category_name']) and !empty($result['sub_category_name']))
                                                <li class=""><a
                                                        href="{{ URL::to('/shop?category='.$result['category_slug'])}}">{{$result['category_name']}}</a>
                                                </li>
                                                <li class=""><a
                                                        href="{{ URL::to('/shop?category='.$result['sub_category_slug'])}}">{{$result['sub_category_name']}}</a>
                                                </li>
                                            @elseif(!empty($result['category_name']) and empty($result['sub_category_name']))
                                                <li class=""><a
                                                        href="{{ URL::to('/shop?category='.$result['category_slug'])}}">{{$result['category_name']}}</a>
                                                </li>
                                            @endif
                                            <li class="active">{{$result['detail']['product_data'][0]->products_name}}</li>

                                        </ul>
                                        @if(!empty($result['detail']['product_data'][0]->flash_expires_date))
                                            <div class="counter-container"></div>
                                        @section('scripts')
                                            <script>
                                                var time = "<?=$result['detail']['product_data'][0]->flash_expires_date?>";
                                                // alert(time);
                                                var cd = new Countdown({
                                                    cont: document.querySelector('.counter-container'),
                                                    date: +time * 1000,
                                                    outputTranslation: {
                                                        year: 'Years',
                                                        day: 'Days',
                                                        hour: 'Hours',
                                                        minute: 'Minutes',
                                                        second: 'Seconds',
                                                    },
                                                    endCallback: null,
                                                    outputFormat: 'day|hour|minute|second',
                                                });
                                                cd.start();
                                            </script>
                                        @endsection
                                        @endif
                                        <h4>{{$result['detail']['product_data'][0]->products_name}}</h4>
                                        <h6>{{$result['detail']['product_data'][0]->product_sub_title}}</h6>
                                        <p>
                                            @if($result['detail']['product_data'][0]->defaultStock == 0)
                                                <span class="outstock"
                                                      style="color: #ce3d4b;font-size: 16px;font-weight: 500;"><i
                                                        class="fas fa-times"></i> @lang('website.Out of Stock')</span>
                                            @else
                                                <span class="instock"><i class="fas fa-check"></i> @lang('website.In stock')</span>
                                            @endif
                                        </p>

                                        <div class="product-desc-sub">
                                            <div class="product-desc-sub-ele">
                                                <p><i class="fa fa-star" aria-hidden="true"></i>
                                                    <span class="count">(0)</span></p>
                                            </div>
                                            <div class="product-desc-sub-ele">
                                                <p>Orders <span class="count">({{$result['detail']['product_data'][0]->products_ordered}})</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @if(count($result['detail']['product_data'][0]->attributes)>0)

                                        <div class="product-desc product-desc-color">
                                            @foreach( $result['detail']['product_data'][0]->attributes as $key =>$attributes_data )
                                                <div class="product-desc product-desc-color">
                                                    <div class="product-desc product-desc-size">
                                                        <label>
                                                            {{ $attributes_data['option']['name'] }}
                                                            <input type="hidden"
                                                                   name="{{ $attributes_data['option']['id'] }}"
                                                                   class="currentstock attributeid_<?=$index++?>"
                                                                   attributeid="{{ $attributes_data['option']['id'] }}"/>
                                                        </label>
                                                        <div class="sizee__wrap custom___radio">
                                                            @foreach($attributes_data['values'] as $k => $values_data)
                                                                <label>
                                                                    <input type="radio"
                                                                           {{$key}} attributes_value="{{ $values_data['products_attributes_id'] }}"
                                                                           value="{{ $values_data['id'] }}"
                                                                           prefix="{{ $values_data['price_prefix'] }}"
                                                                           value_price="{{ $values_data['price']+0 }}"
                                                                           name="{{ $attributes_data['option']['id'] }}"
                                                                           onChange="getQuantity(`{{ $attributes_data['option']['id'] }}`)"
                                                                           class="currentstock attributeid_<?=$index++?>"
                                                                           attributeid="{{$attributes_data['option']['id']}}" @if($key == 0)
                                                                        'checked' @endif/>
                                                                    @if($attributes_data['option']['name']  === 'Color' || $attributes_data['option']['name']  === 'اللون')
                                                                        <span class="radio_bx"
                                                                              style=" background:{{ $values_data['value'] }}; "></span>
                                                                    @else
                                                                        <span
                                                                            class="radio_bx">{{ $values_data['value'] }}</span>
                                                                    @endif
                                                                </label>
                                                        @endforeach
                                                        <!-- <span id="current_stocks"></span> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if($result['detail']['product_data'][0]->defaultStock > 0)
                                        <div class="product-desc product-desc-qty">
                                            <div class="product-label-wrap">
                                                <div class="label"><p>Quantity:</p></div>
                                                <div class="qty-wrap qty-sm">
                                                    <select id="number" name="quantity" class="qty form-control">
                                                        @for($i =1; $i <= 10; $i++)
                                                            <option
                                                                value="{{$i}}" @if($result['detail']['product_data'][0]->products_min_order === $i)
                                                                'selected' @endif>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                <!-- <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                                    <input type="number" id="number" readonly name="quantity" class="qty" value="{{$result['detail']['product_data'][0]->products_min_order}}" min="{{$result['detail']['product_data'][0]->products_min_order}}">
                                                    <div class="value-button" id="increase" onclick="increaseValue()" >+</div> -->
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="product-desc product-desc-action">
                                        <div class="product-action-ele">
                                            <h6 class="primary-color">
                                                <?php
                                                $default_currency = DB::table('currencies')->where('is_default',
                                                    1)->first();
                                                if ($default_currency->id == Session::get('currency_id')) {
                                                    if (!empty($result['detail']['product_data'][0]->discount_price)) {
                                                        $discount_price = $result['detail']['product_data'][0]->discount_price;
                                                    }
                                                    if (!empty($result['detail']['product_data'][0]->flash_price)) {
                                                        $flash_price = $result['detail']['product_data'][0]->flash_price;
                                                    }
                                                    $orignal_price = $result['detail']['product_data'][0]->products_price;
                                                } else {
                                                    $session_currency = DB::table('currencies')->where('id',
                                                        Session::get('currency_id'))->first();
                                                    if (!empty($result['detail']['product_data'][0]->discount_price)) {
                                                        $discount_price = $result['detail']['product_data'][0]->discount_price * $session_currency->value;
                                                    }
                                                    if (!empty($result['detail']['product_data'][0]->flash_price)) {
                                                        $flash_price = $result['detail']['product_data'][0]->flash_price * $session_currency->value;
                                                    }
                                                    $orignal_price = $result['detail']['product_data'][0]->products_price * $session_currency->value;
                                                }
                                                if (!empty($result['detail']['product_data'][0]->discount_price)) {
                                                    if (($orignal_price + 0) > 0) {
                                                        $discounted_price = $orignal_price - $discount_price;
                                                        $discount_percentage = $discounted_price / $orignal_price * 100;
                                                        $discounted_price = $result['detail']['product_data'][0]->discount_price;
                                                    } else {
                                                        $discount_percentage = 0;
                                                        $discounted_price = 0;
                                                    }
                                                } elseif (!empty($result['detail']['product_data'][0]->flash_price)) {
                                                    if (($orignal_price + 0) > 0) {
                                                        $discounted_price = $orignal_price - $flash_price;
                                                        $discount_percentage = $discounted_price / $orignal_price * 100;
                                                        $discounted_price = $result['detail']['product_data'][0]->flash_price;
                                                    } else {
                                                        $discount_percentage = 0;
                                                        $discounted_price = 0;
                                                    }
                                                } else {
                                                    $discounted_price = $orignal_price;
                                                }
                                                ?>
                                                @if(empty($result['detail']['product_data'][0]->discount_price) && empty($result['detail']['product_data'][0]->flash_price))
                                                    <span
                                                        class="price "> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                                @elseif(empty($result['detail']['product_data'][0]->flash_price) && !empty($result['detail']['product_data'][0]->discount_price) )
                                                    <span
                                                        class="price new-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$discount_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                                    <span
                                                        class="price old-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                                @else
                                                    <span
                                                        class="price new-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$flash_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                                    <span
                                                        class="price old-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
                                                @endif

                                            </h6>
                                            @if($result['detail']['product_data'][0]->defaultStock > 0)
                                                <div class="button-outer">
                                                    @if(!in_array($result['detail']['product_data'][0]->products_id ,$result['cartArray']))
                                                        <button type="button" class="btn btn-border add-to-Cart"
                                                                products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Add to Cart')</button>
                                                        <a href="javascript:void(0)" class="btn btn-default buy-now"
                                                           products_id="{{$result['detail']['product_data'][0]->products_id}}">Buy
                                                            Now</a>
                                                    @else
                                                        <a href="{{ URL::to('/viewcart')}}"
                                                           class="btn btn-block btn-default"
                                                           products_id="{{$result['detail']['product_data'][0]->products_id}}">@lang('website.Go to Cart')</a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-action-ele ">
                                            <ul>
                                                <li><a href="javascript:void(0)" class="red-color whishlist"
                                                       products_id="{{$result['detail']['product_data'][0]->products_id}}"><i
                                                            class="fa fa-heart" aria-hidden="true"></i> Add to Wish List</a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="javascript:void(0)" class="dropdown-toggle"
                                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false"><i class="fa fa-share-alt"
                                                                                aria-hidden="true"></i> Share</a>
                                                    <ul class="dropdown-menu dropdown-menu-right share__block"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <li class="dropdown-item">
                                                            <a href="mailto:?subject=I ♥ this product on ZaaHee!&amp;body=Check out this amazing product {{$result['detail']['product_data'][0]->products_name}} in Zaahee Here is the link:  {{URL::to('/product-detail/'.$result['detail']['product_data'][0]->products_slug)}}"
                                                               title="Share by Email">
                                                                <img class="share-img"
                                                                     src="{{asset('web/images/cus/email.svg')}}"/>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a href="#"
                                                               onclick="share_fb(`{{URL::to('/product-detail/'.$result['detail']['product_data'][0]->products_slug)}}`);return false;"
                                                               rel="nofollow"
                                                               share_url="{{URL::to('/product-detail/'.$result['detail']['product_data'][0]->products_slug)}}"
                                                               target="_blank">
                                                                <img class="share-img"
                                                                     src="{{asset('web/images/cus/fb.svg')}}"/>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a href="https://t.me/share/url?url={{URL::to('/product-detail/'.$result['detail']['product_data'][0]->products_slug)}}&text={{$result['detail']['product_data'][0]->products_name}}"
                                                               target="_blank">
                                                                <img class="share-img"
                                                                     src="{{asset('web/images/cus/telegram.svg')}}"/>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a href="https://twitter.com/intent/tweet?url={{URL::to('/product-detail/'.$result['detail']['product_data'][0]->products_slug)}}"
                                                               target="_blank">
                                                                <img class="share-img"
                                                                     src="{{asset('web/images/cus/twitter.svg')}}"/>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a href="javascript:void(0)">
                                                                <img class="share-img"
                                                                     src="{{asset('web/images/cus/whatsapp.svg')}}"/>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <a href="javascript:void(0)">
                                                                <img class="share-img"
                                                                     src="{{asset('web/images/cus/instagram.svg')}}"/>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="description-detail-wrap">
                <div class="container">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-des">Description</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-review">Reviews</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-help">Need Help ?</a>
                    </div>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-des" role="tabpanel"
                             aria-labelledby="nav-home-tab">
                            <?=stripslashes($result['detail']['product_data'][0]->products_description)?>
                        </div>
                        <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="rating__wrap">
                                <div class="rating__top__block">
                                    <div class="left__box">
                                        <div class="rating__star">
                                            <h3>5.0</h3>
                                            <img src="https://i.ibb.co/VvShnPk/star.png" alt="star.png"/>
                                            <p class="grey">{{ $result['product_review']['review_count'] }} {{ __('website.reviews') }}</p>
                                        </div>
                                    </div>

                                    @if(auth()->guard('customer')->check())
                                        <div class="right__box col-md-6">
                                            <form
                                                action="{{ route('product.review.store', $result['detail']['product_data'][0]->products_id) }}"
                                                method="POST">
                                                @csrf
                                                {{ __('website.ratings') }}
                                                <div class="form-group">
                                                    <select class="form-control" name="product_review_rating" required>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <textarea
                                                    class="form-control"
                                                    name="product_review_text"
                                                    cols="20"
                                                    rows="5"
                                                    placeholder="Enter your review here"
                                                    style="margin-bottom: 1rem;"
                                                    required
                                                ></textarea>
                                                <button type="submit"
                                                        class="edit__btn">{{ __('website.write_review') }}</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>

                                @forelse($result['product_review']['reviewData'] as $review)
                                    <div class="rating__comment">
                                        <div class="list">
                                            <figure
                                                style="background-image:url('https://via.placeholder.com/100');"></figure>
                                            <div class="comment">
                                                <div class="author">
                                                    <h6>{{ $review->customers_name }}</h6>
                                                    <p class="grey">1 Review</p>

                                                    <div class="rating__star">
                                                        <img src="https://i.ibb.co/VvShnPk/star.png" alt="star.png"/>
                                                        <p>{{ $review->reviews_rating }}</p>
                                                    </div>
                                                </div>

                                                <div class="comment_content">
                                                    <p>{{ $review->reviews_text }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                @endforelse

                            </div>
                        </div>
                        <div class="tab-pane fade @if(app()->getLocale() === 'ar') text-right @endif" id="nav-help" role="tabpanel" aria-labelledby="nav-home-tab">
                            <?=stripslashes($result['detail']['product_data'][0]->products_help)?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="may-like-wrap section">
        <div class="container">
            <div class="title-wrap d-flex justify-content-between align-items-center">
                <div class="title-box">
                    <h6>@lang('website.Related Products')</h6>
                </div>
            </div>
            <div class="product-slider b-product-slider">
                @foreach($result['simliar_products']['product_data'] as $key=>$products)
                    @if($result['detail']['product_data'][0]->products_id != $products->products_id)
                        @if(++$key<=5)
                            @include('web.common.product-ref')
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </section>
</main>

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
                                    <img src="{{asset('').$images->image_path }}" alt="Zoom Image" />
                                </div>

                                    @endif
                                @endforeach


                            </div>
                            <div class="slider pro-thubnail-slider">

                                @foreach( $result['detail']['product_data'][0]->images as $key=>$images )
                                    @if($images->image_type == 'ACTUAL')
                                    <div class="items">
                                        <img src="{{asset('').$images->image_path }}" alt="Zoom Image"/>
                                    </div>
                                @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-deatil-warper">
                            <form name="attributes" id="add-Product-form" method="post" >
                                <input type="hidden" name="products_id" value="{{$result['detail']['product_data'][0]->products_id}}">

                                <input type="hidden" name="products_price" id="products_price" value="@if(!empty($result['detail']['product_data'][0]->flash_price)) {{$result['detail']['product_data'][0]->flash_price+0}} @elseif(!empty($result['detail']['product_data'][0]->discount_price)){{$result['detail']['product_data'][0]->discount_price+0}}@else{{$result['detail']['product_data'][0]->products_price+0}}@endif">

                                <input type="hidden" name="checkout" id="checkout_url" value="@if(!empty(app('request')->input('checkout'))) {{ app('request')->input('checkout') }} @else false @endif" >

                                <input type="hidden" id="max_order" value="@if(!empty($result['detail']['product_data'][0]->products_max_stock)) {{ $result['detail']['product_data'][0]->products_max_stock }} @else 0 @endif" >
                            <!----attribute option code  ------>

                                @if(!empty($result['cart']))
                                    <input type="hidden"  name="customers_basket_id" value="{{$result['cart'][0]->customers_basket_id}}" >
                                @endif
                                <div class="product-controls row">
                                    @if(count($result['detail']['product_data'][0]->attributes)>0)
                                        <?php
                                        $index = 0;
                                        ?>
                                        @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
                                            <?php
                                            $functionValue = 'function_'.$key++;
                                            ?>
                                            <input type="hidden" name="option_name[]" value="{{ $attributes_data['option']['name'] }}" >
                                            <input type="hidden" name="option_id[]" value="{{ $attributes_data['option']['id'] }}" >
                                            <input type="hidden" name="{{ $functionValue }}" id="{{ $functionValue }}" value="0" >
                                            <input id="attributeid_<?=$index?>" type="hidden" value="">
                                            <input id="attribute_sign_<?=$index?>" type="hidden" value="">
                                            <input id="attributeids_<?=$index?>" type="hidden" name="attributeid[]" value="" >
                                            <div class="col-12 col-md-4 box">
                                                <label>{{ $attributes_data['option']['name'] }}</label>
                                                <div class="select-control ">
                                                    <select name="{{ $attributes_data['option']['id'] }}" onChange="getQuantity()" class="currentstock form-control attributeid_<?=$index++?>" attributeid = "{{ $attributes_data['option']['id'] }}">
                                                        @if(!empty($result['cart']))
                                                            @php
                                                                $value_ids = array();
                                                                 foreach($result['cart'][0]->attributes as $values){
                                                                     $value_ids[] = $values->options_values_id;
                                                                 }
                                                            @endphp
                                                            @foreach($attributes_data['values'] as $values_data)
                                                                @if(!empty($result['cart']))
                                                                    <option @if(in_array($values_data['id'],$value_ids)) selected @endif attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @foreach($attributes_data['values'] as $values_data)
                                                                <option attributes_value="{{ $values_data['products_attributes_id'] }}" value="{{ $values_data['id'] }}" prefix = '{{ $values_data['price_prefix'] }}'  value_price ="{{ $values_data['price']+0 }}" >{{ $values_data['value'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                    @endforeach
                                @endif

                                <!--end code segmetnt-->

                                <div class="product-desc product-desc-title">
                                <ul class="arrows">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Cosmetics & Perfumes</a></li>
                                    <li><a href="#">Body and Face</a></li>
                                </ul>
                                <h6>{{$result['detail']['product_data'][0]->products_name}}</h6>

                                <div class="product-desc-sub">
                                    <div class="product-desc-sub-ele">
                                        <p>  <img src="images/rating-star-2.png" alt="rating-star-2.png" />
                                            <span class="count">(12)</span> </p>
                                    </div>
                                    <div class="product-desc-sub-ele">
                                        <p>Orders <span class="count">(122)</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-desc product-desc-detail">
                                <p>   <?=stripslashes($result['detail']['product_data'][0]->products_description)?></p>
                            </div>
                            <div class="product-desc product-desc-qty">
                                <div class="product-label-wrap">
                                    <div class="label"><p>size:</p></div>
                                    <div class="label-value"><p>50g</p></div>
                                </div>

                                <div class="product-label-wrap">
                                    <div class="label"><p>Quantity:</p></div>
                                    <div class="label-value">

                                            <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                            <input type="number" id="number" value="0" />
                                            <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>

                                    </div>
                                </div>
                            </div>
                            <div class="product-desc product-desc-action">
                                <div class="product-action-ele">
                                    <h6 class="primary-color">
                                        <?php
                                        $default_currency = DB::table('currencies')->where('is_default',1)->first();
                                        if($default_currency->id == Session::get('currency_id')){
                                            if(!empty($result['detail']['product_data'][0]->discount_price)){
                                                $discount_price = $result['detail']['product_data'][0]->discount_price;
                                            }
                                            if(!empty($result['detail']['product_data'][0]->flash_price)){
                                                $flash_price = $result['detail']['product_data'][0]->flash_price;
                                            }
                                            $orignal_price = $result['detail']['product_data'][0]->products_price;
                                        }else{
                                            $session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
                                            if(!empty($result['detail']['product_data'][0]->discount_price)){
                                                $discount_price = $result['detail']['product_data'][0]->discount_price * $session_currency->value;
                                            }
                                            if(!empty($result['detail']['product_data'][0]->flash_price)){
                                                $flash_price = $result['detail']['product_data'][0]->flash_price * $session_currency->value;
                                            }
                                            $orignal_price = $result['detail']['product_data'][0]->products_price * $session_currency->value;
                                        }
                                        if(!empty($result['detail']['product_data'][0]->discount_price)){

                                            if(($orignal_price+0)>0){
                                                $discounted_price = $orignal_price-$discount_price;
                                                $discount_percentage = $discounted_price/$orignal_price*100;
                                                $discounted_price = $result['detail']['product_data'][0]->discount_price;

                                            }else{
                                                $discount_percentage = 0;
                                                $discounted_price = 0;
                                            }
                                        }
                                        else{
                                            $discounted_price = $orignal_price;
                                        }
                                        ?>
                                        @if(!empty($result['detail']['product_data'][0]->flash_price))
                                            {{Session::get('symbol_left')}}{{$flash_price+0}}{{Session::get('symbol_right')}}
                                        @elseif(!empty($result['detail']['product_data'][0]->discount_price))
                                            {{Session::get('symbol_left')}}{{$discount_price+0}}{{Session::get('symbol_right')}}
                                        @else
                                            {{Session::get('symbol_left')}}{{$orignal_price+0}}{{Session::get('symbol_right')}}
                                        @endif

                                    </h6>
                                    <div class="button-outer">
                                        <button   type="button" class="btn btn-border add-to-Cart stock-cart" products_id="{{$result['detail']['product_data'][0]->products_id}}">Add to Cart</button>
                                        <a href="#" class="btn btn-default">Buy Now</a>
                                    </div>
                                </div>
                                <div class="product-action-ele">
                                    <ul>
                                        <li><a href="#" class="red-color"><i class="fa fa-heart" aria-hidden="true"></i> Add to Wish List</a></li>
                                        <li><a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a></li>
                                    </ul>
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
                        <a class="nav-item nav-link"  data-toggle="tab" href="#nav-review" >Reviews</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-guide">colour options</a>
                        <a class="nav-item nav-link"  data-toggle="tab" href="#nav-tag" >Need Help ?</a>

                    </div>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-des" role="tabpanel" aria-labelledby="nav-home-tab">
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
                        </div>
                        <div class="tab-pane fade" id="nav-guide" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
                        </div>
                        <div class="tab-pane fade" id="nav-tag" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>

                        </div>
                        <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>

                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="may-like-wrap section">
        <div class="container">

            <div class="title-wrap d-flex justify-content-between align-items-center">
                <div class="title-box">
                    <h6>You may Like</h6>
                </div>
                <!-- <div class="titlee-right">
                    <a href="#" class="see-all-btn">See All</a>
                </div> -->
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

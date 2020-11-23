@extends('web.layout')
@section('content')
<!-- wishlist Content -->
<section class="wishlist-content my-4">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-3">
				<div class="heading">
						<h2>
								@lang('website.My Account')
						</h2>
						<hr >
					</div>

				<ul class="list-group">
						<li class="list-group-item">
								<a class="nav-link" href="{{ URL::to('/profile')}}">
										<i class="fas fa-user"></i>
									@lang('website.Profile')
								</a>
						</li>
						<li class="list-group-item">
								<a class="nav-link" href="{{ URL::to('/wishlist')}}">
										<i class="fas fa-heart"></i>
								 @lang('website.Wishlist')
								</a>
						</li>
						<li class="list-group-item">
								<a class="nav-link" href="{{ URL::to('/orders')}}">
										<i class="fas fa-shopping-cart"></i>
									@lang('website.Orders')
								</a>
						</li>
						<li class="list-group-item">
								<a class="nav-link" href="{{ URL::to('/shipping-address')}}">
										<i class="fas fa-map-marker-alt"></i>
								 @lang('website.Shipping Address')
								</a>
						</li>
						<li class="list-group-item">
								<a class="nav-link" href="{{ URL::to('/logout')}}">
										<i class="fas fa-power-off"></i>
									@lang('website.Logout')
								</a>
						</li>
					</ul>

			</div>
			<div class="col-12 col-lg-9 ">
					<div class="heading">
							<h2>
									@lang('website.Wishlist')
							</h2>
							<hr >
						</div>
						@if( count($result['products']['product_data']) > 0)
					<div class="col-12 media-main">
						@foreach($result['products']['product_data'] as $key=>$products)

								<div class="media">
									<div class="media__pro">
										<img class="img-fluid" src="{{asset(''.$products->image_path)}}" alt="{{$products->products_name}}">
											<?php
													$default_currency = DB::table('currencies')->where('is_default',1)->first();
													if($default_currency->id == Session::get('currency_id')){
													if(!empty($products->discount_price)){
													$discount_price = $products->discount_price;
													} else if(!empty($products->flash_price)) {
														$discount_price = $products->flash_price;
													}
													$orignal_price = $products->products_price;
													}else{
													$session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();
													if(!empty($products->discount_price)){
														$discount_price = $products->discount_price * $session_currency->value;
													} else if(!empty($products->flash_price)){
														$discount_price = $products->flash_price * $session_currency->value;
													}
													$orignal_price = $products->products_price * $session_currency->value;
													}
													if(!empty($products->discount_price) || !empty($products->flash_price)){
													if(($orignal_price+0)>0){
														$discounted_price = $orignal_price-$discount_price;
														$discount_percentage = $discounted_price/$orignal_price*100;
													}
													else{
														$discount_percentage = 0;
														$discounted_price = 0;
													}

												?>
													<span class="discount-tag"><?php echo (int)$discount_percentage; ?>%</span>
                                                <?php }

												 $current_date = date("Y-m-d", strtotime("now"));

												 $string = substr($products->products_date_added, 0, strpos($products->products_date_added, ' '));
												 $date=date_create($string);
												 date_add($date,date_interval_create_from_date_string($web_setting[20]->value." days"));

												 //echo $top_seller->products_date_added . "<br>";
												 $after_date = date_format($date,"Y-m-d");

												 if($after_date>=$current_date){
													 print '<span class="discount-tag">';
													 print __('website.New');
													 print '</span>';
												 }
													?>
									</div>
										<div class="media-body">
											<div class="row">
												<div class="col-12 col-md-8  texting">

													<h5><a href="{{url('/shop')}}">{{$products->products_name}}</a></h5>
													<p>
														@if(empty($products->discount_price) && empty($products->flash_price))
															<span class="price new-price"> @if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
														@elseif(empty($products->flash_price) && !empty($products->discount_price) )
															<span class="price new-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$products->discount_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
															<span class="price old-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
														@else
															<span class="price new-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$products->flash_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
															<span class="price old-price">@if(Session::get('direction') == 'ltr')  {{Session::get('symbol_left')}} @endif {{$orignal_price+0}} @if(Session::get('direction') == 'rtl'){{Session::get('symbol_right')}}  @endif</span>
														@endif
													</p>
													<div class="buttons">
													<a class="btn btn-block btn-secondary" href="{{ URL::to('/product-detail/'.$products->products_slug)}}">@lang('website.View Detail')</a>
                                                        <input type="hidden" id="number"  value="1" />
															@if(!in_array($products->products_id,$result['cartArray']))
																@if($products->defaultStock==0)
																	<a class="btn btn-block btn-danger" products_id="{{$products->products_id}}" href="javascript:void(0)">@lang('website.Out of Stock')</a>
																@else
																   <a  class="btn btn-block btn-secondary cart" products_id="{{$products->products_id}}" href="javascript:void(0)">@lang('website.Add to Cart')</a>
																	<a class="btn btn-block btn-secondary buy-now" products_id="{{$products->products_id}}" href="javascript:void(0)">@lang('website.Buy Now')</a>
																@endif

															@else
																	<a  class="btn btn-block btn-secondary" products_id="{{$products->products_id}}" disabled href="javascript:void(0)">@lang('website.Added')</a>
															@endif
													</div>
												</div>
												<div class="col-12 col-md-4 detail">
													<div class="share"><a href="{{ URL::to("/UnlikeMyProduct")}}/{{$products->products_id}}">Remove &nbsp;<i class="fas fa-trash-alt"></i></a> </div>
												</div>
												</div>
										</div>

								</div>
								<hr class="border-line">
						@endforeach
					</div>
					<div class="toolbar mb-3 loaded_content">
							<div class="form-inline">
								<div class="form-group col-12 col-md-4"></div>

									<div class="form-group col-12 col-md-4"></div>
									<div class="form-group col-12 col-md-4">
											<label class="col-12 col-lg-4 col-form-label">@lang('website.Limit')</label>
											<select class="col-12 col-lg-3 form-control sortbywishlist" name="limit">
													<option value="15" @if(app('request')->input('limit')=='15') selected @endif">15</option>
													<option value="30" @if(app('request')->input('limit')=='30') selected @endif>30</option>
													<option value="45" @if(app('request')->input('limit')=='45') selected @endif>45</option>
											</select>
											<label class="col-12 col-lg-5 col-form-label">@lang('website.per page')</label>
									</div>
							</div>
					</div>
					<hr class="border-line">
					@else
					<div class="col-12 media-main">
					<div class="cart-item-col cart-item-center">
                                                <figure>
                                                    <img src="{{asset('web/images/cus/wishlist.png')}}" alt="empty-cart" style="width:15%">
                                                    <figcaption>No Products in your Wishlist</figcaption>
                                                </figure>

					</div>
					<div class="cart-action-wrap text-center ">
                                    <a href="{{ URL::to('/shop')}}" class="btn btn-default">@lang('website.Back To Shopping')</a>
                                    <!-- <a href="{{ URL::to('/wishlist')}}" class="btn btn-default">@lang('website.Add from wishlist')</a> -->
                                </div>
					@endif

				<!-- ............the end..... -->
			</div>
		</div>
	</div>
</section>
@endsection

;@php
$default_currency = DB::table('currencies')->where('is_default',1)->first();
if($default_currency->id == Session::get('currency_id')){

	$currency_value = 1;
}else{
	$session_currency = DB::table('currencies')->where('id',Session::get('currency_id'))->first();

	$currency_value = $session_currency->value;
}
@endphp
<!-- Include js plugin -->
<!-- Include js plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('public/web/js/popper.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="{{asset('public/web/js/owl.carousel.min.js')}}"></script>




<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

<script src="{{asset('public/web/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/web/api/fancybox/source/jquery.fancybox.js')}}"></script>
<script type="text/javascript" src="{{asset('public/web/js/aos.js')}}"></script>
<script type="text/javascript" src="{{asset('public/web/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/web/js/custom.js')}}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js"></script>


<script type="application/javascript">

@if(Request::path() != 'shop')
  jQuery(function() {
    jQuery( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: '0',
    });
  });
@endif

jQuery( document ).ready( function () {
	jQuery('#loader').hide();

	@if($result['commonContent']['setting'][54]->value=='onesignal')
	 OneSignal.push(function () {
	  OneSignal.registerForPushNotifications();
	  OneSignal.on('subscriptionChange', function (isSubscribed) {
	   if (isSubscribed) {
		OneSignal.getUserId(function (userId) {
		 device_id = userId;
		 //ajax request
		 jQuery.ajax({
			 headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
			url: '{{ URL::to("/subscribeNotification")}}',
			type: "POST",
			data: '&device_id='+device_id,
			success: function (res) {},
		});

		 //$scope.oneSignalCookie();
		});
	   }
	  });

	 });
	@endif

	//load google map
@if(Request::path() == 'contact-us')
	initialize();
@endif

@if(Request::path() == 'checkout')
	getZonesBilling();
	paymentMethods();
@endif
	//default product cart
jQuery(document).on('click', '.cart', function(e){
	var parent = jQuery(this);
	var products_id = jQuery(this).attr('products_id');
	var message ;
  jQuery(function ($) {
	jQuery.ajax({

		url: '{{ URL::to("/addToCart")}}',
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

		type: "POST",
		data: '&products_id='+products_id,
		success: function (res) {
			if(res.status == 'exceed'){
				swal("Something Happened To Stock", "@lang('website.Ops! Product is available in stock But Not Active For Sale. Please contact to the admin')", "error");
			}
			else{
				jQuery('.head-cart-content').html(res);
				jQuery(parent).removeClass('cart');
				jQuery(parent).addClass('active');
				jQuery(parent).html("@lang('website.Go to Cart')");
				swal('', "Product Added Successfully Thanks.Continue Shopping", "success");
                location.reload();
			}

		},
	});
 });
});
jQuery(document).on('click', '.buy-now', function(e){
    if(jQuery('#number').val() > 0) {
        var parent = jQuery(this);
        var products_id = jQuery(this).attr('products_id');
        var qty = document.getElementById('number').value;
        var message;
        jQuery.ajax({
            url: '{{ URL::to("/addToCart")}}',
            headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            data: '&products_id='+products_id+'&quantity='+qty,

            success: function (res) {
                if(res['status'] == 'exceed'){
                    swal("Something Happened To Stock", "@lang('website.Ops! Product is available in stock But Not Active For Sale. Please contact to the admin')", "error");
                }
                else {
                    jQuery('.head-cart-content').html(res);
                    jQuery(parent).addClass('active');
                    location.href = "{{ URL::to('/viewcart') }}"
                }
            }
        });
    } else {
        swal("Please select the quantity", "@lang('Quantity is not selected')", "error");
    }
});
jQuery(document).on('click', '.whishlist', function(e){
	var parent = jQuery(this);
	var products_id = jQuery(this).attr('products_id');
	var message ;
  jQuery(function ($) {
	jQuery.ajax({
		url: '{{ URL::to("/likeMyProduct")}}',
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

		type: "POST",
		data: '&products_id='+products_id,
		success: function (res) {
		    // alert(res);
		    if(isHTML(res)) {
                jQuery('.head-cart-content').html(res);
                // jQuery(parent).html("<i class=\"fa fa-heart\" aria-hidden=\"true\"></i>Remove From Wishlist");
                swal('Wishlist Update', "The Wishlist has been updated successfully", "success");

            } else {
		        location.href="{{URL::to('/login')}}"
            }
		},
	});
 });
});
jQuery(document).on('click', '.update-cart-value', function(e){
	var parent = jQuery(this);
	var products_id = jQuery(this).attr('products_id');
	var baskt_id = jQuery(this).attr('baskt_id');
	var index = jQuery(this).attr('index');
	var qty = document.getElementById('number-'+index).value;
	var message ;
  jQuery(function ($) {
	jQuery.ajax({
		url: '{{ URL::to("/updatesinglecart")}}',
        headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		type: "POST",
		data: '&products_id='+products_id+'&cart_id='+baskt_id+'&quantity='+qty,
		success: function (res) {
            jQuery('.head-cart-content').html(res);
            jQuery(parent).addClass('active');
            location.href = "{{ URL::to('/viewcart') }}"
		},
	});
 });
});

function isHTML(str) {
        var doc = new DOMParser().parseFromString(str, "text/html");
        return Array.from(doc.body.childNodes).some(node => node.nodeType === 1);
    }

jQuery(document).on('click', '.modal_show', function(e){
    // e.preventDefault();
	var parent = jQuery(this);
	var products_id = jQuery(this).attr('products_id');
	var message ;
  jQuery(function ($) {
	jQuery.ajax({

		url: '{{ URL::to("/modal_show")}}',
    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

		type: "POST",
		data: '&products_id='+products_id,
		success: function (res) {
			jQuery("#products-detail").html(res);
			jQuery('#myModal').modal({show:true});
		},
	});
 });
});

// Product Listing Shop Page jquery
    jQuery(document).on('click', '#apply_options_btn', function(e){
        // alert('jdjhd');
        if (jQuery('input:checkbox.filters_box:checked').length > 0) {
            jQuery('#filters_applied').val(1);
            jQuery('#apply_options_btn').removeAttr('disabled');
        } else {
            jQuery('#filters_applied').val(0);
            jQuery('#apply_options_btn').attr('disabled',true);
        }
        jQuery('#load_products_form').submit();
        jQuery('#test').submit();

    });



//load more products
    jQuery(document).on('click', '#load_products', function(e){
        jQuery('#loader').css('display','flex');
        var page_number = jQuery('#page_number').val();
        var total_record = jQuery('#total_record').val();
        var formData = jQuery("#load_products_form").serialize();
        jQuery.ajax({
            headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::to("/filterProducts")}}',
            type: "POST",
            data: formData,
            success: function (res) {
                if(jQuery.trim().res==0){
                    jQuery('#load_products').hide();
                    jQuery('#loaded_content').show();
                }else{
                    page_number++;
                    jQuery('#page_number').val(page_number);
                    jQuery('#swap .row').append(res);
                    var record_limit = jQuery('#record_limit').val();
                    var showing_record = page_number*record_limit;
                    if(total_record<=showing_record){
                        jQuery('.showing_record').html(total_record);
                        jQuery('#load_products').hide();
                        jQuery('#loaded_content').show();
                    }else{
                        jQuery('.showing_record').html(showing_record);
                    }
                }
                jQuery('#loader').hide();
            },
        });
    });

	//commeents
jQuery(document).on('focusout','#order_comments', function(e){
	jQuery('#loader').css('display','flex');
	var comments = jQuery('#order_comments').val();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/commentsOrder")}}',
		type: "POST",
		data: '&comments='+comments,
		async: false,
		success: function (res) {
			jQuery('#loader').hide();
		},
	});
});
		//hyperpayresponse
var resposne = jQuery('#hyperpayresponse').val();
if(typeof resposne  !== "undefined"){
	if(resposne.trim() =='success'){
		jQuery('#loader').css('display','flex');
		jQuery("#update_cart_form").submit();
	}else if(resposne.trim() =='error'){
		jQuery.ajax({
			headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
			url: '{{ URL::to("/checkout/payment/changeresponsestatus")}}',
			type: "POST",
			async: false,
			success: function (res) {
			},
		});
		jQuery('#paymentError').css('display','block');
	}
}
//cash_on_delivery_button
	//shipping_mehtods_form
jQuery(document).on('submit', '#shipping_mehtods_form', function(e){
	jQuery('.error_shipping').hide();
	var checked = jQuery(".shipping_data:checked").length > 0;
	if (!checked){
		jQuery('.error_shipping').show();
		return false;
	}
});
	//update_cart
jQuery(document).on('click', '#update_cart', function(e){
	jQuery('#loader').css('display','flex');
	jQuery("#update_cart_form").submit();
});
	//shipping_data




	//billling method
	//apply_coupon_cart
    jQuery(document).on('click','#coupon-code', function(e){
        jQuery('#loader').css('display','flex');
        var parent = jQuery(this);
        var coupon_code = jQuery('#coupon_code').val();
        jQuery.ajax({
            headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::to("/apply_coupon")}}',
            type: "POST",
            data: '&coupon_code='+coupon_code,
            async: false,
            success: function (res) {
                res = JSON.parse(res);
                if(res.success == 0) {
                    swal("Coupon Error!", res.message, "error");
                } else {
                    swal("Congrates!", res.message, "success");
                    location.re
                }
                console.log(res);
                jQuery('#loader').hide();
            },
        });
    });
	//coupon_code


jQuery( function() {
    	jQuery( "#category_id" ).selectmenu();
		jQuery( ".attributes_data" ).selectmenu();
});

//add-to-Cart with custom options
jQuery(document).on('click', '.add-to-Cart', function(e){
    var formData = jQuery("#add-Product-form").serialize();
    if(jQuery('#number').val() > 0) {
        var url = jQuery('#checkout_url').val();
        var message;
        jQuery.ajax({
            url: '{{ URL::to("/addToCart")}}',
            headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            data: formData,

            success: function (res) {
                if(res['status'] == 'exceed'){
                    swal("Something Happened To Stock", "@lang('website.Ops! Product is available in stock But Not Active For Sale. Please contact to the admin')", "error");
                }
                else {
                    jQuery('.head-cart-content').html(res);
                    jQuery(parent).addClass('active');
                    swal('', "Product Added Successfully Thanks.Continue Shopping", "success",{button: false});

                }
            }
        });
    } else {
        swal("Please select the quantity", "@lang('Quantity is not selcted')", "error");
    }

});

//update-single-Cart with
//validate form
//focus form field
//focus form field
//match password

	// This button will increment the value
	// jQuery('.qtyplus').click(function(e){
	// This button will decrement the value till 0
	//jQuery(".qtyminus").click(function(e) {
	// This button will increment the value


	//default_address
	//deleteMyAddress

//tooltip enable
jQuery(function () {
  jQuery('[data-toggle="tooltip"]').tooltip()
});

function initialize(location){

		@if(!empty($result['commonContent']['setting'][9]->value) or $result['commonContent']['setting'][10]->value)
			var address = '{{$result['commonContent']['setting'][9]->value}}, {{$result['commonContent']['setting'][10]->value}}';
		@else
			var address = '';
		@endif

		var map = new google.maps.Map(document.getElementById('googleMap'), {
			mapTypeId: google.maps.MapTypeId.TERRAIN,
			zoom: 13
		});
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			'address': address
		},
		function(results, status) {
			if(status == google.maps.GeocoderStatus.OK) {
			 new google.maps.Marker({
				position: results[0].geometry.location,
				map: map
			 });
			 map.setCenter(results[0].geometry.location);
			}
		});
	   }
	//default product cart

});
//ready doument end
jQuery('.dropdown-menu').on('click', function(event){
	// The event won't be propagated up to the document NODE and
	// therefore delegated events won't be fired
			event.stopPropagation();
		});
		jQuery(".alert.fade").fadeTo(2000, 500).slideUp(500, function(){
		    jQuery(".alert.fade").slideUp(500);
		});

		function delete_cart_product(cart_id){
			jQuery('#loader').css('display','flex');
			var id = cart_id;
			jQuery.ajax({
				headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
				url: '{{ URL::to("/deleteCart")}}',
				type: "GET",
				data: '&id='+id+'&type=header cart',
				success: function (res) {
					// window.location.reload(true);
				},
			});
};
//paymentMethods
function paymentMethods(){
	//jQuery('#loader').css('display','flex');
	var payment_method = jQuery(".payment_method:checked").val();
	jQuery(".payment_btns").hide();

	jQuery("#"+payment_method+'_button').show();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/paymentComponent")}}',
		type: "POST",
		data: '&payment_method='+payment_method,
		success: function (res) {
			//jQuery('#loader').hide();
		},
	});
}
//pay_instamojo
jQuery(document).on('click', '#pay_instamojo', function(e){
	var formData = jQuery("#instamojo_form").serialize();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/pay-instamojo")}}',
		type: "POST",
		data: formData,
		success: function (res) {
			var data = JSON.parse(res);

			var success = data.success;
			if(success==false){
				var phone = data.message.phone;
				var email = data.message.email;

				if(phone != null){
					var message = phone;
				}else if(email != null){
					var message = email;
				}else{
					var message = 'Something went wrong!';
				}

				jQuery('#insta_mojo_error').show();
				jQuery('#instamojo-error-text').html(message);

			}else{
				jQuery('#insta_mojo_error').hide();
				jQuery('#instamojoModel').modal('hide');
				jQuery('#update_cart_form').prepend('<input type="hidden" name="nonce" value='+JSON.stringify(data)+'>');
				jQuery("#update_cart_form").submit();
			}

		},
	});

});

function passwordMatch(){

	var password = jQuery('#password').val();
	var re_password = jQuery('#re_password').val();

	if(password == re_password){
		return 'matched';
	}else{
		return 'error';
	}
}

function getZones() {
		jQuery(function ($) {
			jQuery('#loader').css('display','flex');
			var country_id = jQuery('#entry_country_id').val();
			jQuery.ajax({
				beforeSend: function (xhr) { // Add this line
								xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
				 },
				url: '{{ URL::to("/ajaxZones")}}',
				type: "POST",
				//data: '&country_id='+country_id,
				 data: {'country_id': country_id,"_token": "{{ csrf_token() }}"},

				success: function (res) {
					var i;
					var showData = [];
					for (i = 0; i < res.length; ++i) {
						var j = i + 1;
						showData[i] = "<option value='"+res[i].zone_id+"'>"+res[i].zone_name+"</option>";
					}
					showData.push("<option value='-1'>@lang('website.Other')</option>");
					jQuery("#entry_zone_id").html(showData);
					jQuery('#loader').hide();
				},
			});
		});
};

function getBillingZones() {
	console.log('here');
	jQuery('#loader').css('display','flex');
	var country_id = jQuery('#billing_countries_id').val();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("/ajaxZones")}}',
		type: "POST",
		 data: {'country_id': country_id},

		success: function (res) {
			var i;
			var showData = [];
			for (i = 0; i < res.length; ++i) {
				var j = i + 1;
				showData[i] = "<option value='"+res[i].zone_id+"'>"+res[i].zone_name+"</option>";
			}
			showData.push("<option value='Other'>@lang('website.Other')</option>");
			jQuery("#billing_zone_id").html(showData);
			jQuery('#loader').hide();
		},
	});

};


'use strict';
function showPreview(objFileInput) {
	if (objFileInput.files[0]) {
		var fileReader = new FileReader();
		fileReader.onload = function (e) {
			jQuery("#uploaded_image").html('<img src="'+e.target.result+'" width="150px" height="150px" class="upload-preview" />');
			jQuery("#uploaded_image").css('opacity','1.0');
			jQuery(".upload-choose-icon").css('opacity','0.8');
		}
		fileReader.readAsDataURL(objFileInput.files[0]);
	}
}

jQuery(document).ready(function() {
  /******************************
      BOTTOM SCROLL TOP BUTTON
   ******************************/

  // declare variable
  var scrollTop = jQuery(".floating-top");

  jQuery(window).scroll(function() {
    // declare variable
    var topPos = jQuery(this).scrollTop();

    // if user scrolls down - show scroll to top button
    if (topPos > 150) {
      jQuery(scrollTop).css("opacity", "1");

    } else {
      jQuery(scrollTop).css("opacity", "0");
    }
});
  //Click event to scroll to top
jQuery(scrollTop).click(function() {
    jQuery('html, body').animate({
      scrollTop: 0
    }, 800);
    return false;

  });
});

jQuery('body').on('mouseenter mouseleave','.dropdown.open',function(e){
  var _d=jQuery(e.target).closest('.dropdown');
  _d.addClass('show');
  setTimeout(function(){
    _d[_d.is(':hover')?'addClass':'removeClass']('show');

  },300);
  jQuery('.dropdown-menu', _d).attr('aria-expanded',_d.is(':hover'));
});

jQuery('.nav-index').on('show.bs.tab', function (e) {
	  console.log('fire');
	  e.target // newly activated tab
	  e.relatedTarget // previous active tab
	  jQuery('.overlay').show();
})

jQuery('.nav-index').on('hidden.bs.tab', function (e) {
	  console.log('expire');
	  e.target // newly activated tab
	  e.relatedTarget // previous active tab
	  jQuery('.overlay').hide();
})



jQuery(document).ready(function() {
  @if(!empty($result['detail']['product_data'][0]->attributes))
    @foreach( $result['detail']['product_data'][0]->attributes as $key=>$attributes_data )
  @php
    $functionValue = 'attributeid_'.$key;
    $attribute_sign = 'attribute_sign_'.$key++;
  @endphp

  //{{ $functionValue }}();
	function {{ $functionValue }}(){
	    var value_price = jQuery('option:selected', ".{{$functionValue}}").attr('value_price');
	    jQuery("#{{ $functionValue }}").val(value_price);
	  }
	  //change_options
	jQuery(document).on('change', '.{{ $functionValue }}', function(e){

		    var {{ $functionValue }} = jQuery("#{{ $functionValue }}").val();

		    var old_sign = jQuery("#{{ $attribute_sign }}").val();

		    var value_price = jQuery('option:selected', this).attr('value_price');
		    var prefix = jQuery('option:selected', this).attr('prefix');
		    var current_price = jQuery('#products_price').val();
		    var {{ $attribute_sign }} = jQuery("#{{ $attribute_sign }}").val(prefix);

		    if(old_sign.trim()=='+'){
		      var current_price = current_price - {{ $functionValue }};
		    }

		    if(old_sign.trim()=='-'){
		      var current_price = parseFloat(current_price) + parseFloat({{ $functionValue }});
		    }

		    if(prefix.trim() == '+' ){
		      var total_price = parseFloat(current_price) + parseFloat(value_price);
		    }
		    if(prefix.trim() == '-' ){
		      total_price = current_price - value_price;
		    }

		    jQuery("#{{ $functionValue }}").val(value_price);
		    jQuery('#products_price').val(total_price);
		    var qty = jQuery('.qty').val();
		    var products_price = jQuery('#products_price').val();
		    var total_price = qty * products_price * <?=$currency_value?>;
		    jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+total_price.toFixed(2)+'<?=Session::get('symbol_right')?>');

	});
	@endforeach

	calculateAttributePrice();
	function calculateAttributePrice(){
	  var products_price = jQuery('#products_price').val();
	  jQuery(".currentstock").each(function() {
	    var value_price  = jQuery('option:selected', this).attr('value_price');
	    var prefix = jQuery('option:selected', this).attr('prefix');

	    if(prefix.trim()=='+'){
	      products_price = products_price - value_price;
	    }

	    if(prefix.trim()=='-'){
	      products_price = products_price - value_price;
	    }

	  });
	  jQuery('#products_price').val(products_price);
	  jQuery('.total_price').html('<?=Session::get('symbol_left')?>'+products_price.toFixed(2)+'<?=Session::get('symbol_right')?>');
	}

	@endif

});


	@if(!empty($result['detail']['product_data'][0]->products_type) and $result['detail']['product_data'][0]->products_type==1)
		getQuantity();
		cartPrice();
	@endif

function cartPrice(){
	var i = 0;
	jQuery(".currentstock").each(function() {
		var value_price = jQuery('option:selected', this).attr('value_price');
		var attributes_value = jQuery('option:selected', this).attr('attributes_value');
		var prefix = jQuery('option:selected', this).attr('prefix');
		jQuery('#attributeid_' + i).val(value_price);
		jQuery('#attribute_sign_' + i++).val(prefix);

	});
}

//ajax call for add option value
function getQuantity(){
	var attributeid = [];
	var i = 0;

	jQuery(".currentstock").each(function() {
		var value_price = jQuery('option:selected', this).attr('value_price');
		var attributes_value = jQuery('option:selected', this).attr('attributes_value');
		jQuery('#function_' + i).val(value_price);
		jQuery('#attributeids_' + i++).val(attributes_value);
	});

	var formData = jQuery('#add-Product-form').serialize();
	jQuery.ajax({
		headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
		url: '{{ URL::to("getquantity")}}',
		type: "POST",
		data: formData,
		dataType: "json",
		success: function (res) {

			jQuery('#current_stocks').html(res.remainingStock);
			var min_level = 0;
			var max_level = 0;
			var inventory_ref_id = res.inventory_ref_id;

			if(res.minMax != ''){
				min_level = res.minMax[0].min_level;
				max_level = res.minMax[0].max_level;
			}

			if(res.remainingStock>0){

				jQuery('.stock-cart').removeAttr('hidden');
				jQuery('.stock-out-cart').attr('hidden',true);
				var max_order = jQuery('#max_order').val();

				if(max_order.trim()!=0){
					if(max_order.trim()>=res.remainingStock){
						jQuery('.qty').attr('max',res.remainingStock);
					}else{
						jQuery('.qty').attr('max',max_order);
					}
				}else{
					jQuery('.qty').attr('max',res.remainingStock);
				}


			}else{
				jQuery('.stock-out-cart').removeAttr('hidden');
				jQuery('.stock-cart').attr('hidden',true);
				jQuery('.qty').attr('max',0);
			}

		},
	});
}

function share_fb(url) {
    window.open('https://www.facebook.com/sharer/sharer.php?u='+url,'facebook-share-dialog',"width=626, height=436")
}
</script>



@if(session('direction') == 'rtl')
<script src="{{asset('public/web/js/rtl_scripts.js')}}"></script>
@else
<script src="{{asset('public/web/js/scripts.js')}}"></script>
@endif
<!-- <script src="{{asset('public/web/js/setup.js')}}"></script> -->

<script>


// Fancy Box For Product Detail Page
jQuery(document).ready(function() {
    jQuery(".fancybox-button").fancybox({
        // openEffect  : 'none',
        // closeEffect : 'none',
        // prevEffect		: 'none',
        // nextEffect		: 'none',
        // closeBtn		: true,
        // margin      : [20, 60, 20, 60],
        // helpers		: {
        //     title	: { type : 'inside' },
        //     buttons	: {}
        // }
        'transitionIn'	:	'elastic',
        'transitionOut'	:	'elastic',
        'speedIn'		:	600,
        'speedOut'		:	200,
        'overlayShow'	:	false
    });
});

// Product SLICK
jQuery('.pro-full-slider').not('.slick-initialized').slick({
    slidesToShow: 1,
    slidesToScroll:1,
    arrows: false,
    infinite: false,
    draggable: false,
    fade: true,
    asNavFor: '.pro-thubnail-slider'
});
jQuery('.pro-thubnail-slider').not('.slick-initialized').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.pro-full-slider',
    centerMode: true,
    centerPadding: '60px',
    dots: false,
    arrows: true,
    focusOnSelect: true
});

// Product vertical SLICK
jQuery('.slider-for-vertical').slick({
    slidesToShow: 1,
    slidesToScroll:1,
    arrows: false,
    infinite: false,
    draggable: false,
    fade: true,
    asNavFor: '.slider-nav-vertical'
});
jQuery('.slider-nav-vertical').slick({
    dots: false,
    arrows: true,
    vertical: true,
    asNavFor: '.slider-for-vertical',
    slidesToShow: 3,
    // centerMode: true,
    slidesToScroll: 1,
    verticalSwiping: true,
    focusOnSelect: true
});

// Zoom Core Scripts

(function(o){var t={url:!1,callback:!1,target:!1,duration:120,on:"mouseover",touch:!0,onZoomIn:!1,onZoomOut:!1,magnify:1};o.zoom=function(t,n,e,i){var u,c,a,r,m,l,s,f=o(t),h=f.css("position"),d=o(n);return t.style.position=/(absolute|fixed)/.test(h)?h:"relative",t.style.overflow="hidden",e.style.width=e.style.height="",o(e).addClass("zoomImg").css({position:"absolute",top:0,left:0,opacity:0,width:e.width*i,height:e.height*i,border:"none",maxWidth:"none",maxHeight:"none"}).appendTo(t),{init:function(){c=f.outerWidth(),u=f.outerHeight(),n===t?(r=c,a=u):(r=d.outerWidth(),a=d.outerHeight()),m=(e.width-c)/r,l=(e.height-u)/a,s=d.offset()},move:function(o){var t=o.pageX-s.left,n=o.pageY-s.top;n=Math.max(Math.min(n,a),0),t=Math.max(Math.min(t,r),0),e.style.left=t*-m+"px",e.style.top=n*-l+"px"}}},o.fn.zoom=function(n){return this.each(function(){var e=o.extend({},t,n||{}),i=e.target&&o(e.target)[0]||this,u=this,c=o(u),a=document.createElement("img"),r=o(a),m="mousemove.zoom",l=!1,s=!1;if(!e.url){var f=u.querySelector("img");if(f&&(e.url=f.getAttribute("data-src")||f.currentSrc||f.src),!e.url)return}c.one("zoom.destroy",function(o,t){c.off(".zoom"),i.style.position=o,i.style.overflow=t,a.onload=null,r.remove()}.bind(this,i.style.position,i.style.overflow)),a.onload=function(){function t(t){f.init(),f.move(t),r.stop().fadeTo(o.support.opacity?e.duration:0,1,o.isFunction(e.onZoomIn)?e.onZoomIn.call(a):!1)}function n(){r.stop().fadeTo(e.duration,0,o.isFunction(e.onZoomOut)?e.onZoomOut.call(a):!1)}var f=o.zoom(i,u,a,e.magnify);"grab"===e.on?c.on("mousedown.zoom",function(e){1===e.which&&(o(document).one("mouseup.zoom",function(){n(),o(document).off(m,f.move)}),t(e),o(document).on(m,f.move),e.preventDefault())}):"click"===e.on?c.on("click.zoom",function(e){return l?void 0:(l=!0,t(e),o(document).on(m,f.move),o(document).one("click.zoom",function(){n(),l=!1,o(document).off(m,f.move)}),!1)}):"toggle"===e.on?c.on("click.zoom",function(o){l?n():t(o),l=!l}):"mouseover"===e.on&&(f.init(),c.on("mouseenter.zoom",t).on("mouseleave.zoom",n).on(m,f.move)),e.touch&&c.on("touchstart.zoom",function(o){o.preventDefault(),s?(s=!1,n()):(s=!0,t(o.originalEvent.touches[0]||o.originalEvent.changedTouches[0]))}).on("touchmove.zoom",function(o){o.preventDefault(),f.move(o.originalEvent.touches[0]||o.originalEvent.changedTouches[0])}).on("touchend.zoom",function(o){o.preventDefault(),s&&(s=!1,n())}),o.isFunction(e.callback)&&e.callback.call(a)},a.src=e.url})},o.fn.zoom.defaults=t})(window.jQuery);
jQuery(function(){
    // ZOOM
    jQuery('.zoom-image').zoom();

});
</script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-analytics.js"></script>

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyBttfQixBsmyVJJzdVd3YzSLwx75e-7_Mc",
        authDomain: "zaahee-ce982.firebaseapp.com",
        databaseURL: "https://zaahee-ce982.firebaseio.com",
        projectId: "zaahee-ce982",
        storageBucket: "zaahee-ce982.appspot.com",
        messagingSenderId: "241507832628",
        appId: "1:241507832628:web:994a96a6d954de820b4b61",
        measurementId: "G-ZCRSSWC09R"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
</script>


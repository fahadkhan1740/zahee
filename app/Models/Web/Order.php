<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\Products;
use App\Models\Web\Currency;
use App\Models\Web\Shipping;
use App\Models\Web\Cart;
use App\Http\Controllers\Web\AlertController;
use Auth;
use Lang;

class Order extends Model
{

  //place_order
	public function place_order($request){



          $cart = new Cart();
					$date_added								=	date('Y-m-d h:i:s');
					$customers_id            				=   auth()->guard('customer')->user()->id;
					//$customers_telephone            		=   $request->customers_telephone;

					$email            						=  auth()->guard('customer')->user()->email;
					$delivery_firstname  	          		=   session('shipping_address')->firstname;

					$delivery_lastname            			=   session('shipping_address')->lastname;
					$delivery_street_address            	=   session('shipping_address')->street;
					$delivery_flat_address            	=   session('shipping_address')->flat;
					$delivery_suburb            			=   '';
					$delivery_city            				=   session('shipping_address')->city;
					$delivery_phone            				=   session('shipping_address')->delivery_phone;
					$delivery_address_type          				=   session('shipping_address')->address_type;


					$country = DB::table('countries')->where('countries_id','=', session('shipping_address')->countries_id)->get();

					$delivery_country            			=   $country[0]->countries_name;

					$billing_firstname            			=   session('billing_address')->billing_firstname;
					$billing_lastname            			=   session('billing_address')->billing_lastname;
					$billing_street_address            		=   session('billing_address')->billing_street;
					$billing_flat_address            		=   session('billing_address')->billing_flat;
					$billing_suburb	            			=   '';
					$billing_city            				=   session('billing_address')->billing_city;
					$billing_phone            				=   session('billing_address')->billing_phone;
					$billing_address_type            		=   session('billing_address')->billing_address_type;



					$country = DB::table('countries')->where('countries_id','=', session('billing_address')->billing_countries_id)->get();

					$billing_country            			=   $country[0]->countries_name;

					$payment_method            				=   $request->payment_method;

					$order_information 						=	array();


					$last_modified            			=   date('Y-m-d H:i:s');
					$date_purchased            			=   date('Y-m-d H:i:s');

					//price
					if(!empty(session('shipping_detail'))){
						$shipping_price = session('shipping_detail')['shipping_price'];
					}else{
						$shipping_price = 0;
					}
					$tax_rate = number_format((float)session('tax_rate'), 2, '.', '');
					$coupon_discount = number_format((float)session('coupon_discount'), 2, '.', '');
					$order_price = (session('products_price')+$tax_rate+$shipping_price)-$coupon_discount;

					$shipping_cost            			=   !empty(session('shipping_detail')['shipping_price'])?session('shipping_detail')['shipping_price']:0;
					$shipping_method            		=   !empty(session('shipping_detail')['mehtod_name'])?session('shipping_detail')['mehtod_name']:'Flat Rate';

					//$orders_date_finished            	=   $request->orders_date_finished;

					if(!empty(session('order_comments'))){
						$comments						=	session('order_comments');
					}else{
						$comments            			=   '';
					}

					$web_setting = DB::table('settings')->get();
					$currency            				=   $web_setting[19]->value;
					$total_tax							=	number_format((float)session('tax_rate'), 2, '.', '');
					$products_tax 						= 	1;

					$coupon_amount = 0;
					if(!empty(session('coupon')) and count(session('coupon'))>0){

						$code = array();
						$exclude_product_ids = array();
						$product_categories = array();
						$excluded_product_categories = array();
						$exclude_product_ids = array();

						$coupon_amount    =		number_format((float)session('coupon_discount'), 2, '.', '')+0;

						foreach(session('coupon') as $coupons_data){

							//update coupans
							$coupon_id = DB::statement("UPDATE `coupons` SET `used_by`= CONCAT(used_by,',$customers_id') WHERE `code` = '".$coupons_data->code."'");

						}
						$code = json_encode(session('coupon'));

					}else{
						$code            					=   '';
						$coupon_amount            			=   '';
					}


					//payment methods
				if($payment_method == 0){
						$payments_setting = $this->payments_setting_for_cod();
						$orders_status            			=   '1';
						$payment_status='success';

					} else {
						$orders_status            			=   '0';
						$payment_status='Processing';
						$token= "cxu2LdP0p0j5BGna0velN9DmzKJTrx3Ftc0ptV8FmvOgoDqvXivkxZ_oqbi_XM9k7jgl3SUriQyRE2uaLWdRumxDLKTn1iNglbQLrZyOkmkD6cjtpAsk1_ctrea_MeOQCMavsQEJ4EZHnP4HoRDOTVRGvYQueYZZvVjsaOLOubLkdovx6STu9imI1zf5OvuC9rB8p0PNIR90rQ0-ILLYbaDZBoQANGND10HdF7zM4qnYFF1wfZ_HgQipC5A7jdrzOoIoFBTCyMz4ZuPPPyXtb30IfNp47LucQKUfF1ySU7Wy_df0O73LVnyV8mpkzzonCJHSYPaum9HzbvY5pvCZxPYw39WGo8pOMPUgEugtaqepILwtGKbIJR3_T5Iimm_oyOoOJFOtTukb_-jGMTLMZWB3vpRI3C08itm7ealISVZb7M3OMPPXgcss9_gFvwYND0Q3zJRPmDASg5NxRlEDHWRnlwNKqcd6nW4JJddffaX8p-ezWB8qAlimoKTTBJCe5CnjT4vNjnWlJWscvk38VNIIslv4gYpC09OLWn4rDNeoUaGXi5kONdEQ0vQcRjENOPAavP7HXtW1-Vz83jMlU3lDOoZsdEKZReNYpvdFrGJ5c3aJB18eLiPX6mI4zxjHCZH25ixDCHzo-nmgs_VTrOL7Zz6K7w6fuu_eBK9P0BDr2fpS";

						$data = array (
							'PaymentMethodId' => $payment_method,
							'CustomerName' => $billing_firstname.' '. $billing_lastname,
							'DisplayCurrencyIso' => 'KWD',
							'InvoiceValue' => (float)$order_price,
							'CallBackUrl' => 'https://zaahee.shop/',
							'ErrorUrl' => 'https://zaahee.shop/',
                        );



						$basURL = "https://apitest.myfatoorah.com";

						$curl = curl_init();
						curl_setopt_array($curl, array(
						CURLOPT_URL => "$basURL/v2/ExecutePayment",
						CURLOPT_CUSTOMREQUEST => "POST",
						CURLOPT_POSTFIELDS =>  json_encode($data),
						CURLOPT_HTTPHEADER => array("Authorization: Bearer $token","Content-Type: application/json"),
						));
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

						$paymentExecuteResponse = curl_exec($curl);
						$err = curl_error($curl);

						curl_close($curl);

					}

					//check if order is verified
					if($payment_status=='success'){

										$orders_id = DB::table('orders')->insertGetId(
											[	 'customers_id' => $customers_id,
												 'customers_name'  => $delivery_firstname.' '.$delivery_lastname,
												 'customers_street_address' => $delivery_street_address.' ,'.$delivery_flat_address,
												 'customers_city' => $delivery_city,
												 'customers_country'  =>  $delivery_country,
												 'customers_telephone' => $delivery_phone,
												 'email'  => $email,


												 'delivery_name'  =>  $delivery_firstname.' '.$delivery_lastname,
												 'delivery_street_address' => $delivery_street_address.' ,'.$delivery_flat_address,

												 'delivery_city' => $delivery_city,

												 'delivery_country'  => $delivery_country,

												 'billing_name'  => $billing_firstname.' '.$billing_lastname,
												 'billing_street_address' => $billing_street_address.' ,'.$billing_flat_address,
												 'billing_city' => $billing_city,
												 'billing_country'  =>  $billing_country,

												 'payment_method'  =>  $payment_method,

												 'last_modified' => $last_modified,
												 'date_purchased'  => $date_purchased,
												 'order_price'  => $order_price,
												 'shipping_cost' =>$shipping_cost,
												 'shipping_method'  =>  $shipping_method,
												 'currency'  =>  $currency,
												 'order_information' => 	json_encode($order_information),
												 'coupon_code'		 =>		$code,
												 'coupon_amount' 	 =>		$coupon_amount,
											 	 'total_tax'		 =>		$total_tax,
												 'ordered_source' 	 => 	'1',
												 'delivery_phone'	 =>	 	$delivery_phone,
												 'billing_phone'	 =>	 	$billing_phone,
											]);

										 //orders status history
										 $orders_history_id = DB::table('orders_status_history')->insertGetId(
											[	 'orders_id'  => $orders_id,
												 'orders_status_id' => $orders_status,
												 'date_added'  => $date_added,
												 'customer_notified' =>'1',
												 'comments'  =>  $comments
											]);


										 $cart = $cart->myCart(array());


										 foreach($cart as $products){
											//get products info
											$orders_products_id = DB::table('orders_products')->insertGetId(
												[
													 'orders_id' 		 => 	$orders_id,
													 'products_id' 	 	 =>		$products->products_id,
													 'products_name'	 => 	$products->products_name,
													 'products_price'	 =>  	$products->price,
													 'final_price' 		 =>  	$products->final_price*$products->customers_basket_quantity,
													 'products_tax' 	 =>  	$products_tax,
													 'products_quantity' =>  	$products->customers_basket_quantity,
												]);

											$inventory_ref_id = DB::table('inventory')->insertGetId([
													'products_id'   		=>   $products->products_id,
													'reference_code'  		=>   '',
													'stock'  				=>   $products->customers_basket_quantity,
													'admin_id'  			=>   0,
													'added_date'	  		=>   time(),
													'purchase_price'  		=>   0,
													'stock_type'  			=>   'out',
												]);

											DB::table('customers_basket')->where('products_id',$products->products_id)->update(['is_order'=>'1']);

											if(!empty($products->attributes)){
												foreach($products->attributes as $attribute){
													DB::table('orders_products_attributes')->insert(
													[
														 'orders_id' => $orders_id,

														 'products_id'  => $products->products_id,
														 'orders_products_id'  => $orders_products_id,
														 'products_options' =>$attribute->attribute_name,
														 'products_options_values'  =>  $attribute->attribute_value,
														 'options_values_price'  =>  $attribute->values_price,
														 'price_prefix'  =>  $attribute->prefix
													]);

													DB::table('inventory_detail')->insert([
														'inventory_ref_id'  =>   $inventory_ref_id,
														'products_id'  		=>   $products->products_id,
														'attribute_id'		=>   $attribute->products_attributes_id,
													]);
												}
											}

										 }

										$responseData = array('success'=>'1', 'data'=>array(), 'message'=>"Order has been placed successfully.");

										//send order email to user
										$order = DB::table('orders')
											->LeftJoin('orders_status_history', 'orders_status_history.orders_id', '=', 'orders.orders_id')
											->LeftJoin('orders_status', 'orders_status.orders_status_id', '=' ,'orders_status_history.orders_status_id')
											->where('orders.orders_id', '=', $orders_id)->orderby('orders_status_history.date_added', 'DESC')->get();

									//foreach
									foreach($order as $data){
										$orders_id	 = $data->orders_id;

										$orders_products = DB::table('orders_products')
											->join('products', 'products.products_id','=', 'orders_products.products_id')
											->select('orders_products.*', 'products.products_image as image')
											->where('orders_products.orders_id', '=', $orders_id)->get();
											$i = 0;
											$total_price  = 0;
											$product = array();
											$subtotal = 0;
											foreach($orders_products as $orders_products_data){
												$product_attribute = DB::table('orders_products_attributes')
													->where([
														['orders_products_id', '=', $orders_products_data->orders_products_id],
														['orders_id', '=', $orders_products_data->orders_id],
													])
													->get();

												$orders_products_data->attribute = $product_attribute;
												$product[$i] = $orders_products_data;
												//$total_tax	 = $total_tax+$orders_products_data->products_tax;
												$total_price = $total_price+$orders_products[$i]->final_price;
												$subtotal += $orders_products[$i]->final_price;
												$i++;
											}

										$data->data = $product;
										$orders_data[] = $data;
									}

										$orders_status_history = DB::table('orders_status_history')
											->LeftJoin('orders_status', 'orders_status.orders_status_id', '=' ,'orders_status_history.orders_status_id')
											->orderBy('orders_status_history.date_added', 'desc')
											->where('orders_id', '=', $orders_id)->get();

										$orders_status = DB::table('orders_status')->get();

										$ordersData['orders_data']		 	 	=	$orders_data;
										$ordersData['total_price']  			=	$total_price;
										$ordersData['orders_status']			=	$orders_status;
										$ordersData['orders_status_history']    =	$orders_status_history;
										$ordersData['subtotal']    				=	$subtotal;

										//notification/email
										// $myVar = new AlertController();
										//$alertSetting = $myVar->orderAlert($ordersData);

										if(session('step')=='4'){
											session(['step' => array()]);
										}

										session(['paymentResponseData'=>'']);
										session(['paymentResponse'=>'']);

										//change status of cart products
										DB::table('customers_basket')->where('customers_id',auth()->guard('customer')->user()->id)->update(['is_order'=>'1']);
										return $payment_status;
					} else if($payment_status == 'Processing') {
						$orders_id = DB::table('orders')->insertGetId(
							[	 'customers_id' => $customers_id,
								 'customers_name'  => $delivery_firstname.' '.$delivery_lastname,
								 'customers_street_address' => $delivery_street_address.' ,'.$delivery_flat_address,
								 'customers_city' => $delivery_city,
								 'customers_country'  =>  $delivery_country,
								 'customers_telephone' => $delivery_phone,
								 'email'  => $email,


								 'delivery_name'  =>  $delivery_firstname.' '.$delivery_lastname,
								 'delivery_street_address' => $delivery_street_address.' ,'.$delivery_flat_address,

								 'delivery_city' => $delivery_city,

								 'delivery_country'  => $delivery_country,

								 'billing_name'  => $billing_firstname.' '.$billing_lastname,
								 'billing_street_address' => $billing_street_address.' ,'.$billing_flat_address,
								 'billing_city' => $billing_city,
								 'billing_country'  =>  $billing_country,

								 'payment_method'  =>  $payment_method,
								 'last_modified' => $last_modified,
								 'date_purchased'  => $date_purchased,
								 'order_price'  => $order_price,
								 'shipping_cost' =>$shipping_cost,
								 'shipping_method'  =>  $shipping_method,
								 'currency'  =>  $currency,
								 'order_information' => 	json_encode($order_information),
								 'coupon_code'		 =>		$code,
								 'coupon_amount' 	 =>		$coupon_amount,
								  'total_tax'		 =>		$total_tax,
								 'ordered_source' 	 => 	'1',
								 'delivery_phone'	 =>	 	$delivery_phone,
								 'billing_phone'	 =>	 	$billing_phone,
							]);

						 //orders status history
						 $orders_history_id = DB::table('orders_status_history')->insertGetId(
							[	 'orders_id'  => $orders_id,
								 'orders_status_id' => $orders_status,
								 'date_added'  => $date_added,
								 'customer_notified' =>'1',
                                 'comments'  =>  $comments,
                                 'orders_status_id' => 1
							]);


						 $cart = $cart->myCart(array());


						 foreach($cart as $products){
							//get products info
							$orders_products_id = DB::table('orders_products')->insertGetId(
								[
									 'orders_id' 		 => 	$orders_id,
									 'products_id' 	 	 =>		$products->products_id,
									 'products_name'	 => 	$products->products_name,
									 'products_price'	 =>  	$products->price,
									 'final_price' 		 =>  	$products->final_price*$products->customers_basket_quantity,
									 'products_tax' 	 =>  	$products_tax,
									 'products_quantity' =>  	$products->customers_basket_quantity,
								]);

							$inventory_ref_id = DB::table('inventory')->insertGetId([
									'products_id'   		=>   $products->products_id,
									'reference_code'  		=>   '',
									'stock'  				=>   $products->customers_basket_quantity,
									'admin_id'  			=>   0,
									'added_date'	  		=>   time(),
									'purchase_price'  		=>   0,
									'stock_type'  			=>   'out',
								]);

							DB::table('customers_basket')->where('products_id',$products->products_id)->update(['is_order'=>'1']);

							if(!empty($products->attributes)){
								foreach($products->attributes as $attribute){
									DB::table('orders_products_attributes')->insert(
									[
										 'orders_id' => $orders_id,

										 'products_id'  => $products->products_id,
										 'orders_products_id'  => $orders_products_id,
										 'products_options' =>$attribute->attribute_name,
										 'products_options_values'  =>  $attribute->attribute_value,
										 'options_values_price'  =>  $attribute->values_price,
										 'price_prefix'  =>  $attribute->prefix
									]);

									DB::table('inventory_detail')->insert([
										'inventory_ref_id'  =>   $inventory_ref_id,
										'products_id'  		=>   $products->products_id,
										'attribute_id'		=>   $attribute->products_attributes_id,
									]);
								}
							}

						 }

						$responseData = array('success'=>'1', 'data'=>array(), 'message'=>"");

						//send order email to user
						$order = DB::table('orders')
							->LeftJoin('orders_status_history', 'orders_status_history.orders_id', '=', 'orders.orders_id')
							->LeftJoin('orders_status', 'orders_status.orders_status_id', '=' ,'orders_status_history.orders_status_id')
							->where('orders.orders_id', '=', $orders_id)->orderby('orders_status_history.date_added', 'DESC')->get();

					//foreach
					foreach($order as $data){
						$orders_id	 = $data->orders_id;

						$orders_products = DB::table('orders_products')
							->join('products', 'products.products_id','=', 'orders_products.products_id')
							->select('orders_products.*', 'products.products_image as image')
							->where('orders_products.orders_id', '=', $orders_id)->get();
							$i = 0;
							$total_price  = 0;
							$product = array();
							$subtotal = 0;
							foreach($orders_products as $orders_products_data){
								$product_attribute = DB::table('orders_products_attributes')
									->where([
										['orders_products_id', '=', $orders_products_data->orders_products_id],
										['orders_id', '=', $orders_products_data->orders_id],
									])
									->get();

								$orders_products_data->attribute = $product_attribute;
								$product[$i] = $orders_products_data;
								//$total_tax	 = $total_tax+$orders_products_data->products_tax;
								$total_price = $total_price+$orders_products[$i]->final_price;
								$subtotal += $orders_products[$i]->final_price;
								$i++;
							}

						$data->data = $product;
						$orders_data[] = $data;
					}

						$orders_status_history = DB::table('orders_status_history')
							->LeftJoin('orders_status', 'orders_status.orders_status_id', '=' ,'orders_status_history.orders_status_id')
							->orderBy('orders_status_history.date_added', 'desc')
							->where('orders_id', '=', $orders_id)->get();

						$orders_status = DB::table('orders_status')->get();

						$ordersData['orders_data']		 	 	=	$orders_data;
						$ordersData['total_price']  			=	$total_price;
						$ordersData['orders_status']			=	$orders_status;
						$ordersData['orders_status_history']    =	$orders_status_history;
						$ordersData['subtotal']    				=	$subtotal;


						if(session('step')=='4'){
							session(['step' => array()]);
						}

						session(['paymentResponseData'=>'']);
						session(['paymentResponse'=>'']);

						//change status of cart products
						DB::table('customers_basket')->where('customers_id',auth()->guard('customer')->user()->id)->update(['is_order'=>'1']);

						// Curl Payment URL
						$json  = json_decode((string)$paymentExecuteResponse, true);
						$payment_url = $json["Data"]["PaymentURL"];

						header("Location: $payment_url");
						exit();
					}
					else if($payment_status == "failed"){
						return $payment_status;
					}

	}


//get product vendor id

	public function getvendorID($id) {
		$product = 	DB::SELECT('SELECT manufacturers_id from products where  products_id=' . $id);

		return $product[0]->manufacturers_id;
	}
    public function orders($request){
        $index = new Index();
		$result = array();

		$result['commonContent'] = $index->commonContent();

		//orders
		$orders = DB::table('orders')->LeftJoin('orders_products', 'orders_products.orders_id', '=', 'orders.orders_id')->orderBy('date_purchased','DESC')->where('customers_id','=', auth()->guard('customer')->user()->id)->get(['orders.*','orders_products.products_name']);

		$index = 0;
		$total_price = array();

		foreach($orders as $orders_data){
			$orders_products = DB::table('orders_products')
				->select('final_price', DB::raw('SUM(final_price) as total_price'))
				->where('orders_id', '=' ,$orders_data->orders_id)
				->get();

			$orders[$index]->total_price = $orders_products[0]->total_price;

		//    DB::enableQueryLog();
			$orders_status_history = DB::table('orders_status_history')
				->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
				->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
				// ->LeftJoin('orders_products', 'orders_products.orders_id', '=', 'orders_status_history.orders_id')
				->select('orders_status_description.orders_status_name', 'orders_status.orders_status_id')
				->where('orders_status_history.orders_id', '=', $orders_data->orders_id)->where('orders_status_description.language_id',session('language_id'))->orderby('orders_status_history.orders_status_history_id', 'DESC')->limit(1)->get();
		//    dd(DB::getQueryLog());

			if(count($orders_status_history) > 0) {
				$orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
				$orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
			} else {
				$orders[$index]->orders_status_id = '';
				$orders[$index]->orders_status = '';
			}
			$index++;

		}
		// dd($orders);
		$result['orders'] = $orders;
		return $result;
	}
	public function viewOrder($request,$id){
			$index = new Index();

			$title = array('pageTitle' => Lang::get("website.View Order"));
			$result = array();
			$result['commonContent'] = $index->commonContent();

			//orders
			$orders = DB::table('orders')
			->orderBy('date_purchased','DESC')
			->where('orders_id','=',$id)->where('customers_id',auth()->guard('customer')->user()->id)->get();
			if(count($orders)>0){
			$index = 0;
			foreach($orders as $orders_data){

				$products_array = array();
				$index2 = 0;
				$order_products = DB::table('orders_products')
					->join('products','products.products_id','=','orders_products.products_id')
					->join('image_categories','products.products_image','=','image_categories.image_id')
					->select('image_categories.path as image', 'products.products_model as model', 'orders_products.*')
					->where('orders_products.orders_id',$orders_data->orders_id)->groupBy('products.products_id')->get();

				foreach($order_products as $products){
					array_push($products_array,$products);
					$attributes = DB::table('orders_products_attributes')->where([['orders_id',$products->orders_id],['orders_products_id',$products->orders_products_id]])->get();
					if(count($attributes)==0){
						$attributes = $attributes;
					}

					$products_array[$index2]->attributes = $attributes;
					$index2++;

				}

                $orders_status_history = DB::table('orders_status_history')
                    ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                    ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                    ->select('orders_status_description.orders_status_name', 'orders_status.orders_status_id')
                    ->where('orders_status_history.orders_id', '=', $orders_data->orders_id)->where('orders_status_description.language_id',session('language_id'))->orderby('orders_status_history.orders_status_history_id', 'DESC')->limit(1)->get();


				$orders[$index]->statusess = $orders_status_history;
				$orders[$index]->products = $products_array;
                if(count($orders_status_history) > 0) {
                    $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
                    $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;
                } else {
                    $orders[$index]->orders_status = '';
                    $orders[$index]->orders_status = '';
                }
				$index++;

			}

				$result['orders'] = $orders;
				$result['res'] = "view-order";
				return  $result;
			}else{
				$result['res'] = "order";
				return "order";
			}
		}

	public function calculateTax($tax_zone_id){
		$cart = new Cart();

			$result = array();

			if($tax_zone_id== -1){
				$tax = 0;
			}else{

				$cart = $cart->myCart($result);

				$index = '0';
				$total_tax = '0';

				foreach($cart as $products_data){

					$final_price = $products_data->final_price;

					$products = DB::table('products')
						->LeftJoin('tax_rates', 'tax_rates.tax_class_id','=','products.products_tax_class_id')
						->where('tax_rates.tax_zone_id', $tax_zone_id)
						->where('products_id', $products_data->products_id)->get();

					if(count($products)>0){
						$tax_value = $products[0]->tax_rate/100*$final_price;
						$total_tax = $total_tax+$tax_value;
						$index++;
					}

				}

				if($total_tax>0){
					$tax = $total_tax;
				}else{
					$tax = '0';
				}
			}

			return $tax;

		}

	public function getOrders(){
				$orders =  DB::select(DB::raw('SELECT orders_id FROM orders WHERE YEARWEEK(CURDATE()) BETWEEN YEARWEEK(date_purchased) AND YEARWEEK(date_purchased)'));
			return $orders;
		}

		public function allOrders(){
			$allOrders =  DB::table('orders')->get();
		return $allOrders;
		}

		public function mostOrders($orders_data){
			$mostOrdered = DB::table('orders_products')
							->select('orders_products.products_id')
							->where('orders_id', $orders_data->orders_id)
							->get();
			return $mostOrdered;
		}

		public function countCompare(){
			$count	= DB::table('compare')->where('customer_id',auth()->guard('customer')->user()->id)->count();
		return $count;
		}

		public function getPages($slug){
			$pages = DB::table('pages')
						->leftJoin('pages_description','pages_description.page_id','=','pages.page_id')
						->where([['pages.status','1'],['type',2],['pages_description.language_id',session('language_id')],['pages.slug',$slug]])
						->orwhere([['pages.status','1'],['type',2],['pages_description.language_id',Session::get('language_id')],['pages.slug',$slug]])
						->get();
		return $pages;
		}

	public function payments_setting_for_brain_tree(){
		$payments_setting = DB::table('payment_methods_detail')
		->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
		->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
		->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method')
		->where('language_id', session('language_id'))
		->where('payment_description.payment_methods_id',1)
		->orwhere('language_id', 1)
		->where('payment_description.payment_methods_id',1)
		->get()->keyBy('key');
		return $payments_setting;
	}

	public function payments_setting_for_stripe(){
		$payments_setting = DB::table('payment_methods_detail')
		->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
		->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
		->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method')
		->where('language_id', session('language_id'))
		->where('payment_description.payment_methods_id',2)
		->orwhere('language_id', 1)
		->where('payment_description.payment_methods_id',2)
		->get()->keyBy('key');
		return $payments_setting;
	}

	public function payments_setting_for_cod(){
		$payments_setting = DB::table('payment_description')
		->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_description.payment_methods_id')
		->select('payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method')
		->where('language_id', session('language_id'))
		->where('payment_description.payment_methods_id',4)
		->orwhere('language_id', 1)
		->where('payment_description.payment_methods_id',4)
		->first();
		return $payments_setting;
	}

	public function payments_setting_for_paypal(){
		$payments_setting = DB::table('payment_methods_detail')
		->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
		->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
		->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method')
		->where('language_id', session('language_id'))
		->where('payment_description.payment_methods_id',3)
		->orwhere('language_id', 1)
		->where('payment_description.payment_methods_id',3)
		->get()->keyBy('key');
		return $payments_setting;
	}

	public function payments_setting_for_instamojo(){
		$payments_setting = DB::table('payment_methods_detail')
		->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
		->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
		->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method')
		->where('language_id', session('language_id'))
		->where('payment_description.payment_methods_id',5)
		->orwhere('language_id', 1)
		->where('payment_description.payment_methods_id',5)
		->get()->keyBy('key');
		return $payments_setting;
	}

	public function payments_setting_for_hyperpay(){
		$payments_setting = DB::table('payment_methods_detail')
		->leftjoin('payment_description', 'payment_description.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
		->leftjoin('payment_methods', 'payment_methods.payment_methods_id', '=', 'payment_methods_detail.payment_methods_id')
		->select('payment_methods_detail.*', 'payment_description.name', 'payment_methods.environment', 'payment_methods.status', 'payment_methods.payment_method')
		->where('language_id', session('language_id'))
		->where('payment_description.payment_methods_id',6)
		->orwhere('language_id', 1)
		->where('payment_description.payment_methods_id',6)
		->get()->keyBy('key');
		return $payments_setting;
	}

	public function getCountries($countries_id){
		$countries = DB::table('countries')->where('countries_id','=',$countries_id)->get();
    return $countries;
	}

	public function getZones($zone_id){
		$zones = DB::table('zones')->where('zone_id','=',$zone_id)->get();
    return $zones;
	}

	public function getShippingMethods(){
		$shippings = DB::table('shipping_methods')->get();
    return $shippings;
	}

	public function getShippingDetail($shipping_methods){
		$shippings_detail = DB::table('shipping_description')->where('language_id',Session::get('language_id'))->where('table_name',$shipping_methods->table_name)
		->orwhere('language_id', 1)->where('table_name',$shipping_methods->table_name)->get();
    return $shippings_detail;
	}

	public function getUpsShipping(){
		$ups_shipping = DB::table('ups_shipping')->where('ups_id', '=', '1')->get();
    return $ups_shipping;
	}

	public function getUpsShippingRate(){
		$ups_shipping = DB::table('flate_rate')->where('id', '=', '1')->get();
    return $ups_shipping;
	}

	public function priceByWeight($weight){
		$priceByWeight = DB::table('products_shipping_rates')->where('weight_from','<=',$weight)->where('weight_to','>=',$weight)->get();
    return $priceByWeight;
	}

	public function braintreeDescription(){
		$braintree_description = DB::table('payment_description')->where([['payment_name','Braintree'],['language_id',Session::get('language_id')]])
		->orwhere([['payment_name','Braintree'],['language_id',1]])->get();
    return $braintree_description;
	}

	public function stripeDescription(){
		$stripe_description = DB::table('payment_description')->where([['payment_name','Stripe'],['language_id',Session::get('language_id')]])
		->orwhere([['payment_name','Stripe'],['language_id',1]])->get();
		return $stripe_description;
	}

	public function codDescription(){
		$cod_description = DB::table('payment_description')->where([['payment_name','Cash On Delivery'],['language_id',Session::get('language_id')]])
		->orwhere([['payment_name','Cash On Delivery'],['language_id',1]])->get();
    return $cod_description;
	}

	public function paypalDescription(){
		$paypal_description = DB::table('payment_description')->where([['payment_name','Paypal'],['language_id',Session::get('language_id')]])
		->orwhere([['payment_name','Paypal'],['language_id',1]])->get();
    return $paypal_description;
	}

	public function instamojoDescription(){
		$instamojo_description = DB::table('payment_description')->where([['payment_name','Instamojo'],['language_id',Session::get('language_id')]])
		->orwhere([['payment_name','Instamojo'],['language_id',1]])->get();
    return $instamojo_description;
	}

	public function hyperpayDescription(){
		$hyperpay_description = DB::table('payment_description')->where([['payment_name','hyperpay'],['language_id',Session::get('language_id')]])
		->orwhere([['payment_name','hyperpay'],['language_id',1]])->get();
    return $hyperpay_description;
	}

	public function ordersCheck($request){
		$ordersCheck = DB::table('orders')->where(['customers_id'=>auth()->guard('customer')->user()->id], ['orders_id'=>$request->orders_id])->get();
    return $ordersCheck;
	}

	public function InsertOrdersCheck($request,$date_added,$comments){
		$orders_history_id = DB::table('orders_status_history')
            ->where('orders_id'  ,'=', $request->orders_id)
            ->update([
				 'orders_status_id' => $request->orders_status_id,
				 'customer_notified' =>'1',
				 'comments'  =>  $comments
			]);
			return $orders_history_id;
	}




}

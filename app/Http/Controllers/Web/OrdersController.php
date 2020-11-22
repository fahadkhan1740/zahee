<?php

namespace App\Http\Controllers\Web;

//use Mail;
//validator is builtin class in laravel
use Illuminate\Support\Facades\Cache;
use Validator;

//for password encryption or hash protected
use Hash;

//for authenitcate login data
use Auth;

//for requesting a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//for Carbon a value
use Carbon;
use Session;
use Lang;
use App\Models\Web\Index;
use App\Models\Web\Languages;
use App\Models\Web\Products;
use App\Models\Web\Currency;
use App\Models\Web\Shipping;
use App\Models\Web\Cart;
use App\Models\Web\Order;

//email
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function __construct(
        Index $index,
        Languages $languages,
        Products $products,
        Currency $currency,
        Cart $cart,
        Shipping $shipping,
        Order $order
    ) {
        $this->index = $index;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->cart = $cart;
        $this->shipping = $shipping;
        $this->order = $order;
        $this->theme = new ThemeController();
    }

    //test stripe
    public function stripeForm(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        return view("stripeForm", $title)->with('result', $result);
    }

    //checkout
    public function checkout(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $final_theme = $this->theme->theme();
        $result = array();
        //cart data

        $result['cart'] = $this->cart->myCart($result);
        if (count($result['cart']) == 0) {
            return redirect("/");
        }
        //apply coupon
        if (!empty(session('coupon')) and count(session('coupon')) > 0) {
            $session_coupon_data = session('coupon');
            session(['coupon' => array()]);
            $response = array();
            if (!empty($session_coupon_data)) {
                foreach ($session_coupon_data as $key => $session_coupon) {
                    $response = $this->cart->common_apply_coupon($session_coupon->code);
                }
            }
        }

        $result['commonContent'] = $this->index->commonContent();

        $address = array();

        if (empty(session('step'))) {
            session(['step' => '0']);
        }

        $address = $this->shipping->getDefaulthippingAddress();

        if (!is_null($address)) {
            $address = $address;
        } else {
        /*        $address = $this->shipping->getShippingAddress('');
                if (!empty($address)) {
                    $address = $address[0];
                    $address->delivery_phone = auth()->guard('customer')->user()->customers_telephone;
                } else {
                    $address = '';
                }*/
            $address = '';
        }

        /* if(!empty(auth()->guard('customer')->user()->customers_default_address_id)) {
         	$address_id = auth()->guard('customer')->user()->customers_default_address_id;
         	$address = $this->shipping->getShippingAddress($address_id);
         	if(!empty($address)){
         		$address = $address[0];
         		$address->delivery_phone=auth()->guard('customer')->user()->customers_telephone;
         	}else{
         		$address = '';
         	}
         }*/

        if (empty(session('shipping_address'))) {
            session(['shipping_address' => $address]);
        }

        //shipping counties
        if (!empty(session('shipping_address')->countries_id)) {
            $countries_id = session('shipping_address')->countries_id;
        } else {
            $countries_id = '';
        }

        $result['countries'] = $this->shipping->countries();

        //price
        $price = 0;
        if (count($result['cart']) > 0) {
            foreach ($result['cart'] as $products) {
                $price += $products->final_price * $products->customers_basket_quantity;
            }
            session(['products_price' => $price]);
        }

        try {
            //shipping methods
            $result['shipping_methods'] = $this->shipping_methods();

            // Get Payment methods from Myfootarah

            $token = "cxu2LdP0p0j5BGna0velN9DmzKJTrx3Ftc0ptV8FmvOgoDqvXivkxZ_oqbi_XM9k7jgl3SUriQyRE2uaLWdRumxDLKTn1iNglbQLrZyOkmkD6cjtpAsk1_ctrea_MeOQCMavsQEJ4EZHnP4HoRDOTVRGvYQueYZZvVjsaOLOubLkdovx6STu9imI1zf5OvuC9rB8p0PNIR90rQ0-ILLYbaDZBoQANGND10HdF7zM4qnYFF1wfZ_HgQipC5A7jdrzOoIoFBTCyMz4ZuPPPyXtb30IfNp47LucQKUfF1ySU7Wy_df0O73LVnyV8mpkzzonCJHSYPaum9HzbvY5pvCZxPYw39WGo8pOMPUgEugtaqepILwtGKbIJR3_T5Iimm_oyOoOJFOtTukb_-jGMTLMZWB3vpRI3C08itm7ealISVZb7M3OMPPXgcss9_gFvwYND0Q3zJRPmDASg5NxRlEDHWRnlwNKqcd6nW4JJddffaX8p-ezWB8qAlimoKTTBJCe5CnjT4vNjnWlJWscvk38VNIIslv4gYpC09OLWn4rDNeoUaGXi5kONdEQ0vQcRjENOPAavP7HXtW1-Vz83jMlU3lDOoZsdEKZReNYpvdFrGJ5c3aJB18eLiPX6mI4zxjHCZH25ixDCHzo-nmgs_VTrOL7Zz6K7w6fuu_eBK9P0BDr2fpS";
            $basURL = "https://apitest.myfatoorah.com";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$basURL/v2/InitiatePayment",
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\"InvoiceAmount\": $price,\"CurrencyIso\": \"KWD\"}",
                CURLOPT_HTTPHEADER => array("Authorization: Bearer $token", "Content-Type: application/json"),
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            $response = json_decode($response);

            if (isset($response->IsSuccess)) {
                $result['payment_methods'] = $response->Data->PaymentMethods;
            } else {
                $result['payment_methods'] = [];
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();

            return redirect('general_error/'.$msg);
        }

        return view("web.checkout", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    //checkout
    public function checkout_shipping_address(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $result = array();
        $result['commonContent'] = $this->index->commonContent();

        if (session('step') == '0') {
            session(['step' => '1']);
        }

        foreach ($request->all() as $key => $value) {
            $shipping_data[$key] = $value;

            //billing address
            if ($key == 'firstname') {
                $billing_data['billing_firstname'] = $value;
            } else {
                if ($key == 'lastname') {
                    $billing_data['billing_lastname'] = $value;
                } else {
                    if ($key == 'flat') {
                        $billing_data['billing_flat'] = $value;
                    } else {
                        if ($key == 'street') {
                            $billing_data['billing_street'] = $value;
                        } else {
                            if ($key == 'countries_id') {
                                $billing_data['billing_countries_id'] = $value;
                            } else {
                                if ($key == 'zone_id') {
                                    $billing_data['billing_zone_id'] = $value;
                                } else {
                                    if ($key == 'city') {
                                        $billing_data['billing_city'] = $value;
                                    } else {
                                        if ($key == 'address_type') {
                                            $billing_data['billing_address_type'] = $value;
                                        } else {
                                            if ($key == 'delivery_phone') {
                                                $billing_data['billing_phone'] = $value;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if (empty(session('billing_address')) or session('billing_address')->same_billing_address == 1) {
            $billing_address = (object) $billing_data;
            $billing_address->same_billing_address = 1;
            session(['billing_address' => $billing_address]);
        }

        $address = (object) $shipping_data;
        session(['shipping_address' => $address]);

        return redirect()->back();
    }

    //checkout_billing_address
    public function checkout_billing_address(Request $request)
    {
        if (session('step') == '1') {
            session(['step' => '3']);
        }

        if (empty($request->same_billing_address)) {
            foreach ($request->all() as $key => $value) {
                $billing_data[$key] = $value;
            }

            $billing_address = (object) $billing_data;
            $billing_address->same_billing_address = 0;
            session(['billing_address' => $billing_address]);
        } else {
            $billing_address = session('billing_address');
            $billing_address->same_billing_address = 1;
            session(['billing_address' => $billing_address]);
        }

        return redirect()->back();
    }

    //checkout_payment_method
    public function checkout_payment_method(Request $request)
    {
        if (session('step') == '2') {
            session(['step' => '3']);
        }
        $result['commonContent'] = $this->index->commonContent();

        $shipping_detail = array();
        foreach ($request->all() as $key => $value) {
            if ($key == 'shipping_price' and !empty($result['commonContent']['setting'][82]->value) and $result['commonContent']['setting'][82]->value <= session('total_price')) {
                $shipping_detail['shipping_price'] = 0;
            } else {
                $shipping_detail[$key] = $value;
            }
        }

        session(['shipping_detail' => (object) $shipping_detail]);
        return redirect()->back();
    }

    //order_detail
    public function paymentComponent(Request $request)
    {
        session(['payment_method' => $request->payment_method]);
        $this->place_order($request);
        //return view('paymentComponent');
    }

    //generate token
    public function generateBraintreeTokenWeb()
    {
        $payments_setting = $this->order->payments_setting_for_brain_tree();
        if ($payments_setting['merchant_id']->status == 1) {
            //braintree transaction get nonce
            $is_transaction = '0';            # For payment through braintree

            if ($payments_setting['merchant_id']->environment == '0') {
                $braintree_environment = 'sandbox';
            } else {
                $environment = 'production';
            }

            $braintree_merchant_id = $payments_setting['merchant_id']->value;
            $braintree_public_key = $payments_setting['public_key']->value;
            $braintree_private_key = $payments_setting['private_key']->value;

            //for token please check braintree.php file
            require_once app_path('braintree/Braintree.php');
        } else {
            $clientToken = '';
        }
        return $clientToken;
    }

    //place_order
    public function place_order(Request $request)
    {
        $payment_status = $this->order->place_order($request);
        if ($payment_status == 'success') {
            return redirect('orders')->with('success', Lang::get("website.Payment has been processed successfully"));
        }
        return redirect()->back()->with('error', Lang::get("website.Error while placing order"));
    }

    //orders
    public function orders(Request $request)
    {
        $title = array('pageTitle' => Lang::get("website.My Orders"));
        $final_theme = $this->theme->theme();

        $result = $this->order->orders($request);

        return view("web.orders", ['title' => $title, 'final_theme' => $final_theme])->with('result', $result);
    }

    //viewMyOrder
    public function viewOrder(Request $request, $id)
    {
        $title = array('pageTitle' => Lang::get("website.View Order"));
        $final_theme = $this->theme->theme();
        $result = $this->order->viewOrder($request, $id);

        if (@$result['res'] = "view-order") {
            return view("web.view-order", $title)->with(['result' => $result, 'final_theme' => $final_theme]);
        }
        return redirect('orders');
    }

    //calculate tax
    public function calculateTax($tax_zone_id)
    {
        $tax = $this->order->calculateTax($tax_zone_id);
        return $tax;
    }

    //shipping methods
    public function shipping_methods()
    {
        $result = array();
        if (!empty(session('shipping_address'))) {
            $countries_id = session('shipping_address')->countries_id;
            //			$toPostalCode = session('shipping_address')->postcode;
            $toCity = session('shipping_address')->city;
            $toAddress = 'gh';
            $countries = $this->order->getCountries($countries_id);
            $toCountry = $countries[0]->countries_iso_code_2;
        } else {
            $countries_id = '';
            $toPostalCode = '';
            $toCity = '';
            $toAddress = '';
            $toCountry = '';
        }

        //product weight
        $cart = $this->cart->myCart($result);

        $index = '0';
        $total_weight = '0';

        foreach ($cart as $products_data) {
            if ($products_data->unit == 'Gram') {
                $productsWeight = $products_data->weight / 453.59237;
            } else {
                if ($products_data->unit == 'Kilogram') {
                    $productsWeight = $products_data->weight / 0.45359237;
                } else {
                    $productsWeight = $products_data->weight;
                }
            }

            $total_weight += $productsWeight;
        }

        $products_weight = $total_weight;

        //website path
        //$websiteURL =  "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $websiteURL = "https://".$_SERVER['SERVER_NAME'].'/';
        $replaceURL = str_replace('getRate', '', $websiteURL);
        $requiredURL = $replaceURL.'app/ups/ups.php';

        //default shipping method
        $shippings = $this->order->getShippingMethods();
        $result = array();
        $mainIndex = 0;
        foreach ($shippings as $shipping_methods) {
            //dd($shipping_methods);

            $shippings_detail = $this->order->getShippingDetail($shipping_methods);

            if ($shipping_methods->methods_type_link == 'flateRate' and $shipping_methods->status == '1') {
                $ups_shipping = $this->order->getUpsShippingRate();
                $data2 = array(
                    'name' => $shippings_detail[0]->name, 'rate' => $ups_shipping[0]->flate_rate,
                    'currencyCode' => $ups_shipping[0]->currency, 'shipping_method' => 'flateRate'
                );
                if (count($ups_shipping) > 0) {
                    $success = array(
                        'success' => '1', 'message' => "Rate is returned.", 'name' => $shippings_detail[0]->name,
                        'is_default' => $shipping_methods->isDefault
                    );
                    $success['services'][0] = $data2;
                    $result[$mainIndex] = $success;
                    $mainIndex++;
                }
            }
        }

        return $result;
    }

    //get default payment method
    public function getPaymentMethods()
    {
        /**   BRAIN TREE **/
        //////////////////////
        $result = array();
        //		$payments_setting = $this->order->payments_setting_for_brain_tree();
        //		if($payments_setting['merchant_id']->environment=='0'){
        //			$braintree_enviroment = 'Test';
        //		}else{
        //			$braintree_enviroment = 'Live';
        //		}
//
        //		$braintree = array(
        //			'environment' => $braintree_enviroment,
        //			'name' => $payments_setting['merchant_id']->name,
        //			'public_key' => $payments_setting['public_key']->value,
        //			'active' => $payments_setting['merchant_id']->status,
        //			'payment_method'=>$payments_setting['merchant_id']->payment_method,
        //			'payment_currency' => Session::get('currency_code'),
        //		);
        /**  END BRAIN TREE **/
        //////////////////////

        /**   STRIPE**/
        //////////////////////

        //	  $payments_setting = $this->order->payments_setting_for_stripe();
        //		if($payments_setting['publishable_key']->environment=='0'){
        //			$stripe_enviroment = 'Test';
        //		}else{
        //			$stripe_enviroment = 'Live';
        //		}
//
        //		$stripe = array(
        //			'environment' => $stripe_enviroment,
        //			'name' => $payments_setting['publishable_key']->name,
        //			'public_key' => $payments_setting['publishable_key']->value,
        //			'active' => $payments_setting['publishable_key']->status,
        //			'payment_currency' => Session::get('currency_code'),
        //			'payment_method'=>$payments_setting['publishable_key']->payment_method
        //		);

        /**   END STRIPE**/
        //////////////////////

        /**   CASH ON DELIVERY**/
        //////////////////////

        $payments_setting = $this->order->payments_setting_for_cod();

        $cod = array(
            'environment' => 'Live',
            'name' => $payments_setting->name,
            'public_key' => '',
            'active' => $payments_setting->status,
            'payment_currency' => Session::get('currency_code'),
            'payment_method' => $payments_setting->payment_method
        );

        /**   END CASH ON DELIVERY**/
        /*************************/

        /**   PAYPAL**/
        /*************************/
        //		$payments_setting = $this->order->payments_setting_for_paypal();
//
        //		if($payments_setting['id']->environment=='0'){
        //			$paypal_enviroment = 'Test';
        //		}else{
        //			$paypal_enviroment = 'Live';
        //		}
//
        //		$paypal = array(
        //			'environment' => $paypal_enviroment,
        //			'name' => $payments_setting['id']->name,
        //			'public_key' => $payments_setting['id']->value,
        //			'active' => $payments_setting['id']->status,
        //			'payment_method'=>$payments_setting['id']->payment_method,
        //			'payment_currency' => Session::get('currency_code'),
//
        //		);

        /**   END PAYPAL**/
        /*************************/

        /**   INSTAMOJO**/
        /*************************/
        //		$payments_setting = $this->order->payments_setting_for_instamojo();
        //		if($payments_setting['auth_token']->environment=='0'){
        //			$instamojo_enviroment = 'Test';
        //		}else{
        //			$instamojo_enviroment = 'Live';
        //		}
//
        //		$instamojo = array(
        //			'environment' => $instamojo_enviroment,
        //			'name' => $payments_setting['auth_token']->name,
        //			'public_key' => $payments_setting['api_key']->value,
        //			'active' => $payments_setting['api_key']->status,
        //			'payment_currency' => Session::get('currency_code'),
        //			'payment_method' => $payments_setting['api_key']->payment_method,
        //		);

        /**   END INSTAMOJO**/
        /*************************/

        /**   END HYPERPAY**/
        /*************************/
        //		$payments_setting = $this->order->payments_setting_for_hyperpay();
        //		//dd($payments_setting);
        //		if($payments_setting['userid']->environment=='0'){
        //			$hyperpay_enviroment = 'Test';
        //		}else{
        //			$hyperpay_enviroment = 'Live';
        //		}
//
        //		$hyperpay = array(
        //			'environment' => $hyperpay_enviroment,
        //			'name' => $payments_setting['userid']->name,
        //			'public_key' => $payments_setting['userid']->value,
        //			'active' => $payments_setting['userid']->status,
        //			'payment_currency' => Session::get('currency_code'),
        //			'payment_method' => $payments_setting['userid']->payment_method,
        //		);
        /**   END HYPERPAY**/
        /*************************/

        //		$result[0] = $braintree;
        //		$result[1] = $stripe;
        $result[2] = $cod;
        //		$result[3] = $paypal;
        //		$result[4] = $instamojo;
        //		$result[5] = $hyperpay;

        return $result;
    }

    public function commentsOrder(Request $request)
    {
        session(['order_comments' => $request->comments]);

        info(session()->getId());

        Cache::put('order_comments_'.session()->getId(), $request->comments, 30);
    }

    public function payIinstamojo(Request $request)
    {
        $commonContent = $this->index->commonContent();

        if (empty($commonContent['setting'][18]->value)) {
            $siteName = Lang::get('website.Empty Site Name');
        } else {
            $siteName = $commonContent['setting'][18]->value;
        }

        //payment methods
        $payments_setting = $this->order->payments_setting_for_instamojo();
        $instamojo_api_key = $payments_setting['api_key']->value;
        $instamojo_auth_token = $payments_setting['auth_token']->value;

        $websiteURL = "http://".$_SERVER['SERVER_NAME'].'/';
        $fullname = $request->fullname;
        $email_id = $request->email_id;
        $phone_number = $request->phone_number;
        $amount = $request->amount;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key:".$instamojo_api_key,
                "X-Auth-Token:".$instamojo_auth_token
            )
        );
        $payload = array(
            'purpose' => $siteName.' Payment',
            'amount' => $amount,
            'phone' => $phone_number,
            'buyer_name' => $fullname,
            'send_email' => true,
            'send_sms' => true,
            'email' => $email_id,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);

        session(['instamojo_info' => $response]);

        print_r($response);
    }

    //hyperpaytoken
    public function hyperpay(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $result = array();
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $replaceURL = str_replace('/hyperpay', '/hyperpay/checkpayment', $actual_link);

        $amount = number_format((float) session('total_price') + 0, 2, '.', '');
        $payments_setting = $this->order->payments_setting_for_hyperpay();
        //check envinment
        if ($payments_setting['userid']->environment == '0') {
            $env_url = "https://test.oppwa.com/v1/checkouts";
            $order_url = "test";
        } else {
            $env_url = "https://oppwa.com/v1/checkouts";
            $order_url = "live";
        }

        $url = $env_url;
        $data = "authentication.userId=".$payments_setting['userid']->value.
            "&authentication.password=".$payments_setting['password']->value.
            "&authentication.entityId=".$payments_setting['entityid']->value.
            "&amount=".$amount.
            "&currency=SAR".
            "&paymentType=DB".
            "&customer.email=".auth()->guard('customer')->user()->email.
            "&testMode=EXTERNAL".
            "&merchantTransactionId=".uniqid();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $data = json_decode($responseData);

        if ($data->result->code == '000.200.100') {
            $result['token'] = $data->id;
            $result['webURL'] = $replaceURL;
            $result['order_url'] = $order_url;

            return view("web.hyperpay", $title)->with('result', $result);
        }
        return redirect()->back()->with('error', $data->result->description);
    }

    //checkpayment
    public function checkpayment(Request $request)
    {
        $title = array('pageTitle' => Lang::get('website.Checkout'));
        $result = array();

        $payments_setting = $this->order->payments_setting_for_hyperpay();
        //check envinment
        if ($payments_setting['userid']->environment == '0') {
            $env_url = "https://test.oppwa.com";
        } else {
            $env_url = "https://oppwa.com";
        }

        $url = $env_url.$request->resourcePath;
        $url .= "?authentication.userId=".$payments_setting['userid']->value;
        $url .= "&authentication.password=".$payments_setting['password']->value;
        $url .= "&authentication.entityId=".$payments_setting['entityid']->value;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $data = json_decode($responseData);

        if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $data->result->code)) {
            $transaction_id = $data->ndc;
            session(['paymentResponseData' => $data]);
            session(['paymentResponse' => 'success']);
            return redirect('/checkout');
        }
        session(['paymentResponseData' => $data->result->description]);
        session(['paymentResponse' => 'error']);
        return redirect('/checkout');
    }

    //changeresponsestatus
    public function changeresponsestatus(Request $request)
    {
        session(['paymentResponseData' => '']);
        session(['paymentResponse' => '']);
    }

    //updatestatus
    public function updatestatus(Request $request)
    {
        if (!empty($request->orders_id)) {
            $date_added = date('Y-m-d h:i:s');
            $comments = '';
            $ordersCheck = $this->order->ordersCheck($request);

            if (count($ordersCheck) > 0) {
                $orders_history_id = $this->order->InsertOrdersCheck($request, $date_added, $comments);
                return redirect()->back()->with('message', Lang::get("labels.OrderStatusChangedMessage"));
            }
            return redirect()->back()->with('error', Lang::get("labels.OrderStatusChangedMessage"));
        }
        return redirect()->back()->with('error', Lang::get("labels.OrderStatusChangedMessage"));
    }
}

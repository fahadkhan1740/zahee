<?php

namespace App\Models\Web;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Core\Categories;
use Illuminate\Support\Facades\Lang;
use Session;


class Shipping extends Model
{

	public function addMyAddress($request){

		$customers_id            				=   auth()->guard('customer')->user()->id;
		$entry_firstname            		    =   $request->entry_firstname;
		$entry_lastname             		    =   $request->entry_lastname;
		$entry_flat       		                =   $request->flat;
		$entry_street_address       		    =   $request->street;
		$entry_postcode             			=   $request->entry_postcode;
		$entry_city             				=   $request->entry_city;
		$entry_state             				=   $request->entry_state;
		$entry_country_id             			=   $request->entry_country_id;
		$entry_zone_id             				=   $request->entry_zone_id;
		$entry_gender							=   $request->entry_gender;
		$delivery_phone							=   $request->delivery_phone;
		$address_type            			=   $request->address_type;
        $customers_default_address_id			=   $request->customers_default_address_id;
        $is_default                             =  $request->is_default;

		if(!empty($customers_id)){
			$address_book_data = array(
				'entry_firstname'               =>   $entry_firstname,
				'entry_lastname'                =>   $entry_lastname,
				'entry_street_address'          =>   $entry_street_address,
				'entry_flat_address'           =>   $entry_flat,
				'entry_city'             		=>   $entry_city,
					'entry_country_id'            	=>   $entry_country_id,
					'entry_gender'					=>   $entry_gender,
					'contact_number'					=>   $delivery_phone,
					'address_type'					=>   $address_type,
					'entry_latitude'        =>   '',
					'entry_longitude'       =>   ''
			);

			//add address into address book
			$address_book_id = DB::table('address_book')->insertGetId($address_book_data);

			//default address id
				DB::table('user_to_address')
				->insert(['user_id' => auth()->guard('customer')->user()->id,'address_book_id' => $address_book_id,'is_default' => $is_default]);
		}

	}
		//get all customer addresses url
	public function getShippingAddress($address_id){

		$addresses = DB::table('user_to_address')
					->leftjoin('address_book','user_to_address.address_book_id','=','address_book.address_book_id')
					->leftJoin('countries', 'countries.countries_id', '=' ,'address_book.entry_country_id')
					// ->leftJoin('zones', 'zones.zone_id', '=' ,'address_book.entry_zone_id')
					->select(
						'user_to_address.is_default as default_address',
						'address_book.address_book_id as address_id',
						'address_book.entry_gender as gender',
						'address_book.entry_firstname as firstname',
						'address_book.entry_lastname as lastname',
						'address_book.entry_street_address as street',
						'address_book.entry_flat_address as flat',
						'address_book.contact_number',
						'address_book.address_type',
						'address_book.entry_city as city',
						'countries.countries_id as countries_id',
						'countries.countries_name as country_name'
							)
					->where('user_to_address.user_id', auth()->guard('customer')->user()->id);

			if(!empty($address_id)){
				$addresses->where('address_book.address_book_id', '=', $address_id);
			}
						$result = $addresses->get();

			return $result;

		}

	public function countries(){
			$allCountries = DB::table('countries')->get();
		return($allCountries);

	}
		//get all zones
	public function zones($country_id){

			$zones = DB::table('zones');

			if(!empty($country_id)){
				$zones->where('zone_country_id', $country_id);
			}

			$getZones = $zones->get();
			return $getZones;

		}


        public function updateAddressBook($address_book_data,$address_book_id, $is_default){
        DB::table('address_book')->where('address_book_id', $address_book_id)->update($address_book_data);

        //default address id
		DB::table('user_to_address')->where('address_book_id', $address_book_id)->update(['is_default' => $is_default]);
	}

	public function updateCustomer($customers_id,$address_book_id){
		DB::table('customers')->where('customers_id', $customers_id)->update(['default_address_id' => $address_book_id]);
    }

    public function getDefaulthippingAddress() {
        $addresses = DB::table('user_to_address')
					->leftjoin('address_book','user_to_address.address_book_id','=','address_book.address_book_id')
					->leftJoin('countries', 'countries.countries_id', '=' ,'address_book.entry_country_id')
					// ->leftJoin('zones', 'zones.zone_id', '=' ,'address_book.entry_zone_id')
					->select(
						'user_to_address.is_default as default_address',
						'address_book.address_book_id as address_id',
						'address_book.entry_gender as gender',
						'address_book.entry_firstname as firstname',
						'address_book.entry_lastname as lastname',
						'address_book.entry_street_address as street',
						'address_book.entry_flat_address as flat',
						'address_book.contact_number',
						'address_book.address_type',
						'address_book.entry_city as city',
						'countries.countries_id as countries_id',
						'countries.countries_name as country_name'
							)
                    ->where('user_to_address.user_id', auth()->guard('customer')->user()->id)
                    ->where('user_to_address.is_default', 1);

			if(!empty($address_id)){
				$addresses->where('address_book.address_book_id', '=', $address_id);
			}
						$result = $addresses->first();

			return $result;

    }

	public function deleteAddress($id){

		$customers_id            				=   auth()->guard('customer')->user()->id;
		$address_book_id            			=   $id;

		if(!empty($customers_id)){

			//delete address into address book
			DB::table('user_to_address')->where('address_book_id', $address_book_id)->delete();

			$defaultAddress = DB::table('user_to_address')->where([['user_id', $customers_id],
										 ['address_book_id', $address_book_id],])->get();
			if(count($defaultAddress)>0){
				//default address id
				$customers_default_address_id = '0';
				DB::table('user_to_address')->where('user_id', $customers_id)->update(['is_default' => $customers_default_address_id]);
			}

			//$address_book_data = DB::table('address_book')->get();
		}

		print 'success';

	}

	public function myDefaultAddress($request){

		$customers_id   	=   auth()->guard('customer')->user()->id;
		$address_book_id	=   $request->address_id;
		DB::table('user_to_address')->where('user_id', $customers_id)->where('address_book_id', '!=',$address_book_id)->where('is_default','=', 1)->update(['is_default' => 0]);
		DB::table('user_to_address')->where('user_id', $customers_id)->where('address_book_id', '=',$address_book_id)->update(['is_default' => 1]);

	}


}

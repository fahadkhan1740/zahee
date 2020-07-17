@extends('web.layout')
@section('content')

<!--Shipping Content -->
<section class="shipping-content">
  <div class="container">
    <div class="row">
        <div class="col-12 col-sm-12">
          <nav aria-label="breadcrumb">
              <ul class="arrows">
                <li class=""><a href="{{ URL::to('/')}}">@lang('website.Home')</a></li>
                <li class="active" aria-current="page">@lang('website.Shipping Address')</li>
              </ul>
            </nav>
        </div>
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
                  @lang('website.Shipping Address')
              </h2>
              <hr >
            </div>
            @if(!empty($result['action']) and $result['action']=='detele')
                  <div class="alert alert-success alert-dismissible" role="alert">
                      @lang('website.Your address has been deteled successfully')

                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
              @endif

              @if(!empty($result['action']) and $result['action']=='default')
                  <div class="alert alert-success alert-dismissible" role="alert">
                      @lang('website.Your address has been changed successfully')
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
              @endif
          <table class="table shipping-table">
            <thead>
              <tr>
                <th scope="col">@lang('website.Default')</th>
                <th scope="col" class="d-none d-md-block acton_col">@lang('website.Action')</th>
              </tr>
            </thead>
            <tbody>
            @if(!empty($result['address']) and count($result['address'])>0)
            @foreach($result['address'] as $address_data)
              <tr>
                <td >
                  <div class="form-check">
                  <input class="form-check-input default_address" address_id="{{$address_data->address_id}}" type="radio" name="default" @if($address_data->default_address == 1) checked @endif>
                  <label class="form-check-label" for="gridCheck">
                    {{$address_data->firstname}}, {{$address_data->lastname}}, {{$address_data->flat}} {{$address_data->street}}, {{$address_data->city}}, {{$address_data->country_name}}
                  </label>
                </div>
              </td>
              <td class="edit-tag">
                <ul>
                  <li><a href="{{ URL::to('/shipping-address?address_id='.$address_data->address_id)}}"> <i class="fas fa-pen"></i> Edit</a></li>
                  @if($address_data->default_address == 0)
                 <li> <a  href="{{url('delete-address')}}/{{$address_data->address_id}}" ><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                  @endif
                </ul>
                @include('web.common.scripts.deleteAddress')
              </td>
            </tr>
           @endforeach
           @else
            <tr>
                <td valign="center">@lang('website.Shipping addresses are not added yet')</td>
              </tr>
           @endif
            </tbody>
          </table>
          <h5 class="h5-heading d-block d-md-none mb-1">Personal Information</h5>
          <div class="main-form">
              <form name="addMyAddress" class="form-validate" enctype="multipart/form-data" action="@if(!empty($result['editAddress'])){{ URL::to('/update-address')}}@else{{ URL::to('/addMyAddress')}}@endif" method="post">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                @if(!empty($result['editAddress']))
                <input type="hidden" name="address_book_id" value="{{$result['editAddress'][0]->address_id}}">
                @endif
                    @if( count($errors) > 0)
                       @foreach($errors->all() as $error)
                           <div class="alert alert-danger" role="alert">
                                 <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                 <span class="sr-only">@lang('website.Error'):</span>
                                 {{ $error }}
                           </div>
                        @endforeach
                   @endif
                  @if(session()->has('error'))
                   <div class="alert alert-success">
                       {{ session()->get('error') }}
                   </div>
               @endif
                   @if(Session::has('error'))

                       <div class="alert alert-danger" role="alert">
                             <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                             <span class="sr-only">@lang('website.Error'):</span>
                             {{ session()->get('error') }}
                         </div>

                   @endif

                   @if(Session::has('error'))
                       <div class="alert alert-danger" role="alert">
                             <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                             <span class="sr-only">@lang('website.Error'):</span>
                             {!! session('loginError') !!}
                       </div>
                   @endif

                   @if(session()->has('success') )
                       <div class="alert alert-success">
                           {{ session()->get('success') }}
                       </div>
                   @endif

                  @if(!empty($result['action']) and $result['action']=='update')
                       <div class="alert alert-success">

                           @lang('website.Your address has been updated successfully')
                       </div>
                   @endif

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputfirstname"><span class="star">*</span>@lang('website.First Name')</label>
                      <input type="text" name="entry_firstname" class="form-control field-validate" id="entry1_firstname" @if(!empty($result['editAddress'])) value="{{$result['editAddress'][0]->firstname}}" @endif>
                      <span class="help-block error-content7" hidden>@lang('website.Please enter your first name')</span>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputlastname">@lang('website.Last Name')</label>
                      <input type="text" name="entry_lastname" class="form-control field-validate" id="entry1_lastname" @if(!empty($result['editAddress'])) value="{{$result['editAddress'][0]->lastname}}" @endif>
                      <span class="help-block error-content7" hidden>@lang('website.Please enter your address')</span>                  </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputAddress1">@lang('website.Address')</label>
                        <input type="text" required class="form-control field-validate" name="flat" id="flat" @if(!empty($result['editAddress'])) value="{{$result['editAddress'][0]->flat}}" @endif aria-describedby="addressHelp" placeholder="@lang('website.address_flat')">
                        <br>
                        <input type="text" required class="form-control field-validate" name="street" id="street" aria-describedby="addressHelp" @if(!empty($result['editAddress'])) value="{{$result['editAddress'][0]->street}}" @endif placeholder="@lang('website.address_street')">
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your address')</span>
                    </div>
                    <div class="form-group select-control col-md-6">
                      <label for="inputState"><span class="star">*</span> @lang('website.Country')</label>
                      <select name="entry_country_id" onChange="getZones();" id="entry_country_id" class="form-control field-validate">
                          <option value="">@lang('website.select Country')</option>
                          @foreach($result['countries'] as $countries)
                          <option value="{{$countries->countries_id}}" @if(!empty($result['editAddress'])) @if($countries->countries_id==$result['editAddress'][0]->countries_id) selected @endif @endif>{{$countries->countries_name}}</option>
                          @endforeach
                      </select>
                      <span class="help-block error-content1" hidden>@lang('website.Please select your country')</span>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group select-control col-md-6">
                      <label for="inputState"><span class="star">*</span> @lang('website.City')</label>
                      <input type="text" name="entry_city" class="form-control field-validate" id="entry_city1" @if(!empty($result['editAddress'])) value="{{$result['editAddress'][0]->city}}" @endif>
                      <span class="help-block error-content7" hidden>@lang('website.Please enter your city')</span>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group select-control col-md-6">
                        <label for="exampleInputNumber1">@lang('website.Phone Number')</label>
                        <input required type="text" class="form-control" id="delivery_phone" aria-describedby="numberHelp" @if(!empty($result['editAddress'])) value="{{$result['editAddress'][0]->contact_number}}" @endif placeholder="Enter Your Phone Number" name="delivery_phone" value="@if(!empty(session('shipping_address'))>0){{session('shipping_address')->delivery_phone}}@endif">
                        <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please enter your valid phone number')</span>
                    </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group select-control col-md-6">
                          <label for="exampleInputZpCode1">@lang('website.address_type')</label>
                          <select class="form-control" id="address_type" name="address_type" required>
                              <option value="Home (7:00 A.M. - 9:00 P.M., All Day)" @if(!empty($result['editAddress']) && $result['editAddress'][0]->address_type == 'Home (7:00 A.M. - 9:00 P.M., All Day)' ) checked @endif > @lang('website.home')</option>
                              <option value="Office/Commercial (10:00 A.M. - 6:00 P.M. Delivery)" @if(!empty($result['editAddress']) && $result['editAddress'][0]->address_type == 'Office/Commercial (10:00 A.M. - 6:00 P.M. Delivery)' ) checked @endif>@lang('website.office')</option>
                          </select>
                          <span style="color:red;" class="help-block error-content" hidden>@lang('website.Please select your address type')</span>
                      </div>
                  </div>
                  <div class="button">
                  @if(!empty($result['editAddress']))
                      <a href="{{ URL::to('/shipping-address')}}" class="btn btn-default">@lang('website.cancel')</a>
                  @endif
                      <button type="submit" class="btn btn-default">@if(!empty($result['editAddress']))  @lang('website.Update')  @else @lang('website.Add Address') @endif </button>
                  </div>
                </form>
          </div>
        <!-- ............the end..... -->
      </div>
    </div>
  </div>
</section>


@endsection

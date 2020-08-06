
<header>
    <div class="headerTop">
        <div class="container">
            <div class="headerTopLeft"></div>
            <div class="headerTopRight">
                            <div class="navbar-lang">
                                <!--  CHANGE LANGUAGE CODE SECTION -->
                                @if(count($languages) > 1)
                                @section('scripts')
                                      @include('web.common.scripts.changeLanguage')
                                    @endsection
                                    <div class="dropdown">
                                        <a href= "#" class="dropdown-toggle"  data-toggle="dropdown" >
                                            {{	session('language_name')}}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            @foreach($languages as $language)
                                                <li  @if(session('locale')==$language->code) style="background:lightgrey;" @endif>
                                                    <button  onclick="myFunction1({{$language->languages_id}})" style="background:none;">
                                                        <span>{{$language->name}}</span>
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                  
                                @endif
                            </div>
            </div>
        </div>
    </div>
    <div class="headerBottom">
        <div class="container">
            <div class="headerBottomLeft">
                <!-- <a href="index.html" class="site-logo"><img src="images/logo.png" alt="logo.png" /></a> -->
            </div>
            <div class="headerBottomRight">
                <div class="search-wrap">
                    <form method="POST" action="{{URL::to('/shop')}}">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search" name="search"/>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>

{{--                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>--}}
                        </div>
                    </form>
                </div>
                <div class="account-wrap">
                    <ul>
                    @if(auth()->guard('customer')->check())
                        <li>
                                <a href="{{ url('/profile') }}">
                                        <span><?php if(auth()->guard('customer')->check()){ ?>@lang('website.Welcome')&nbsp;! {{auth()->guard('customer')->user()->first_name}} <?php }?>
                                        </span>
                                </a>
                        </li>
                        @else
                        <li><a href="{{url('/login')}}"><i class="fa fa-user" aria-hidden="true"></i>@lang('website.Login/Register')</a></li>
                  @endif
                  </li>
                        <li class="cart-header dropdown head-cart-content">
                            @include('web.headers.cartButtons.cartButton')
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-md">
        <div class="container">
            <div class="logo-wrap">
                <a href="{{ URL::to('/')}}" class="site-logo"><img src="{{asset('public/web/images/cus/logo.png')}}" alt="logo1.png" /></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="{{ Request::is('/shop') ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ URL::to('/shop')}}">@lang('website.All Categories')</a>
                    </li>
                    @foreach($result['commonContent']['categories'] as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/shop?category='.$category->slug)}}">{{$category->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>

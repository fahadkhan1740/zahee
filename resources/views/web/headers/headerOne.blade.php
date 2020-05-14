
<header>
    <div class="headerTop">
        <div class="container">
            <div class="headerTopLeft"></div>
            <div class="headerTopRight">
                            <div class="navbar-lang">
                                <!--  CHANGE LANGUAGE CODE SECTION -->
                                @if(count($languages) > 1)
                                    <div class="dropdown">
                                        <a href= "#" class="dropdown-toggle"  data-toggle="dropdown" >
{{--                                            <img src="{{asset('public').session('language_image')}}" width="17px" />--}}
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
                                    @include('web.common.scripts.changeLanguage')
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
                    <form>
                        <div class="input-field">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="text" class="form-control" placeholder="Search" />
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
                <a href="{{ URL::to('/')}}" class="site-logo"><img src="{{asset('web/images/cus/logo.png')}}" alt="logo1.png" /></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="{{ Request::is('/all-category') ? 'nav-item active' : 'nav-item' }}">
                        <a class="nav-link" href="{{ URL::to('/all-category')}}">@lang('website.All Categories')</a>
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

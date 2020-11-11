<header>
    <div class="headerTop">
        <div class="container">
            <div class="headerTopLeft"></div>
            <div class="headerTopRight">
                <ul>
                    <li><a href="#">Wishlist</a></li>
                    <li class="divide">|</li>
                    <li>
                        <select class="selectpicker" data-width="fit">
                            <option data-content='<span class="flag-icon flag-icon-us"></span> English'></option>
                            <option  data-content='<span class="flag-icon flag-icon-mx"></span> Español'></option>
                        </select>
                    </li>
			<li>
		 <select>
                            <option> Kuwait</option>
                            <option  > Qatar</option>
			    <option> UAE</option>
                            <option  > Bahrain</option>
                            <option> Saudi Arabia</option>
                            <option> Oman</option>
                        </select>
                    </li>
                </ul>
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
                        <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> Login & Signup</a></li>
                        <li class="divide">|</li>
                        <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a></li>

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
                    <li class="nav-item ">
                        <a class="nav-link" href="#">All Categories </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pet Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Grocery</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Cosmetic & Perfumes   </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Health Supplements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Protein &others</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!--Promotion Bar-->
<style>
    body  {
      background-image: linear-gradient(to right, rgba(166, 77, 255,0), rgba(146, 101, 191, 0.2));
    }
    </style>
<div class="notification-bar mobilehide">
    <a href="#" class="notification-bar__message">{{$nav->code}}</a>
    <span class="close-announcement">×</span>
</div>
<!--End Promotion Bar-->
<!--Search Form Drawer-->
<div class="search">
    <div class="search__form">
        <form class="search-bar__form" action="#">
            <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
            <input class="search__input" type="search" name="q" value="" placeholder="Search entire store..." aria-label="Search" autocomplete="off">
        </form>
        <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
    </div>
</div>
<!--End Search Form Drawer-->
<!--Top Header-->
<div class="top-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 col-sm-8 col-md-5 col-lg-4"> @if(Auth::guard('web')->user() != '') <p class="phone-no">Welcome <b>{{Auth::guard('web')->user()->name}}</b></p> @endif </div>
            <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                <div class="text-center">
                    <p class="top-header_middle-text">{{$nav->order}}</p>
                </div>
            </div>
            <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                <ul class="customer-links list-inline"> @if(Auth::guard('web')->user() == '') <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
                    <li><a href="{{route('web.register')}}">Create Account</a></li> @else <li><a href="{{route('web.orders')}}">My Orders</a></li><li><a href="{{route('web.address')}}">My Address</a></li>
                    <li><a href="{{route('web.logout')}}">Logout</a></li> @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!--End Top Header-->
<!--Header-->
<div class="header-wrap animated d-flex border-bottom">
    <div class="container-fluid" style="width:100%">
        <div class="row align-items-center">
            <!--Desktop Logo-->
            <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                <a href="{{route('web.home')}}">
                    <img src="https://res.cloudinary.com/dzujz2mkt/image/upload/v1688378123/maiyee.png" height="55" width="110" alt="Belle Multipurpose Html Template" title="Belle Multipurpose Html Template" />
                </a>
            </div>
            <!--End Desktop Logo-->
            <div class="col-3 col-sm-3 col-md-3 col-lg-8">
                <div class="d-block d-lg-none">
                    <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        <i class="icon anm anm-times-l"></i>
                        <i class="anm anm-bars-r"></i>
                    </button>
                </div>
                <!--Desktop Menu-->
                <nav class="grid__item" id="AccessibleNav">
                    <!-- for mobile -->
                    <ul id="siteNav" class="site-nav medium center hidearrow">
                        <li class="lvl1"><a href="{{route('web.home')}}">Home </a></li>
                        <li class="lvl1"><a href="{{route('web.about')}}">About Us </a></li>
                        <li class="lvl1 parent dropdown">
                            <a href="#">Indian wear<i class="anm anm-angle-down-l"></i></a>
                            <ul class="dropdown"> @foreach($cat as $cats) @if($cats->menu == 'indian') <li><a href="{{route('front.cat',$cats->id)}}" class="site-nav">{{$cats->cat_name}}</a></li> @endif @endforeach </ul>
                        </li>
                        <li class="lvl1 parent dropdown"><a href="#">Western wear<i class="anm anm-angle-down-l"></i></a>
                            <ul class="dropdown"> @foreach($cat as $cats) @if($cats->menu == 'western') <li><a href="{{route('front.cat',$cats->id)}}" class="site-nav">{{$cats->cat_name}}</a></li> @endif @endforeach </ul>
                        </li>
                        <li class="lvl1 parent dropdown"><a href="#">Special category<i class="anm anm-angle-down-l"></i></a>
                            <ul class="dropdown"> @foreach($cat as $cats) @if($cats->menu == 'special') <li><a href="{{route('front.cat',$cats->id)}}" class="site-nav">{{$cats->cat_name}}</a></li> @endif @endforeach </ul>
                        </li>
                        <li class="lvl1"><a href="{{route('web.exhibition')}}">Exhibition </a></li>
                        <li class="lvl1"><a href="{{route('web.wardrobe')}}">Wardrobe </a></li>
                    </ul>
                </nav>
                <!--End Desktop Menu-->
            </div>
            <!--Mobile Logo-->
            <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
                <div class="logo">
                    <a href="{{route('web.home')}}">
                        <img src="https://res.cloudinary.com/dzujz2mkt/image/upload/v1688378123/maiyee.png" height="55" width="110" alt="Belle Multipurpose Html Template" title="Belle Multipurpose Html Template" />
                    </a>
                </div>
            </div>
            <!--Mobile Logo-->
            <div class="col-3 col-sm-3 col-md-3 col-lg-2">
                <div class="site-cart"> @if(Auth::guard('web')->user() != '') <a href="#" class="site-header__cart" title="Cart">
                        <i class="icon anm anm-bag-l"></i>
                        <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count">{{$cartCount}}</span>
                    </a> @else <a href="#" data-toggle="modal" data-target="#myModal">
                        <h2><i class="icon anm anm-bag-l"></i></h2>
                    </a> @endif
                    <!--Minicart Popup-->
                    <div id="header-cart" class="block block-cart">
                        <ul class="mini-products-list">
                            <li class="item"> @foreach($cartNav as $carts) <a class="product-image" href="#">
                                    <img src="{{asset('admin/color/'. $carts->color->image)}}" alt="3/4 Sleeve Kimono Dress" title="" />
                                </a>
                                <div class="product-details">
                                    <a class="pName" href="{{route('web.cart')}}">{{$carts->product->name}}</a>
                                    <div class="variant-cart">Black / {{$carts->size->size}}</div>
                                    <div class="wrapQtyBtn">
                                        <div class="qtyField">
                                            <span class="label">Qty:</span>
                                            {{$carts->quantity}}
                                        </div>
                                    </div>
                                    <div class="priceRow">
                                        <div class="product-price">
                                            <span class="money">₹{{$carts->price}}</span>
                                        </div>
                                    </div>
                                </div> @endforeach
                            </li>
                        </ul>
                        <div class="total">
                            <div class="total-in">
                                <span class="label">Cart Subtotal:</span><span class="product-price"><span class="money">₹{{$cartTotalnav}}</span></span>
                            </div>
                            <div class="buttonSet text-center">
                                <a href="{{route('web.cart')}}" class="btn btn-secondary btn--small">View Cart</a>
                                <a href="{{route('web.checkout')}}" class="btn btn-secondary btn--small">Checkout</a>
                            </div>
                        </div>
                    </div>
                    <!--End Minicart Popup-->
                </div>
                <div class="site-header__search">
                    @if(Auth::guard('web')->user() != '')
                    <a href="{{route('web.wish')}}"> <h2><i class="icon anm anm-heart-l mr-2"></i></h2> </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Header-->
<!--Mobile Menu-->
<div class="mobile-nav-wrapper" role="navigation">
    <div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i> Close Menu</div>
    <ul id="MobileNav" class="mobile-nav">
        <li class="lvl1 parent megamenu"><a href="{{route('web.home')}}">Home</a></li>

        <li class="lvl1 parent megamenu"><a href="{{route('web.about')}}">About Us</a>
        </li>
        <li class="lvl1 parent megamenu">
            <a href="#">Indian wear<i class="anm anm-plus-l"></i></a>
                            <ul class="dropdown"> @foreach($cat as $cats) @if($cats->menu == 'indian') <li><a href="{{route('front.cat',$cats->id)}}" class="site-nav">{{$cats->cat_name}}</a></li> @endif @endforeach </ul>
        </li>
        <li class="lvl1 parent megamenu"><a href="#">Western wear<i class="anm anm-plus-l"></i></a>
                            <ul class="dropdown"> @foreach($cat as $cats) @if($cats->menu == 'western') <li><a href="{{route('front.cat',$cats->id)}}" class="site-nav">{{$cats->cat_name}}</a></li> @endif @endforeach </ul>
                        </li>
                        <li class="lvl1 parent megamenu"><a href="#">Special category<i class="anm anm-plus-l"></i></a>
                            <ul class="dropdown"> @foreach($cat as $cats) @if($cats->menu == 'special') <li><a href="{{route('front.cat',$cats->id)}}" class="site-nav">{{$cats->cat_name}}</a></li> @endif @endforeach </ul>
                        </li>
                        <li class="lvl1 parent megamenu"><a href="{{route('web.exhibition')}}">Exhibition </a></li>
                        <li class="lvl1 parent megamenu"><a href="{{route('web.wardrobe')}}">Wardrobe </a></li>
        </li>
    </ul>
</div>
<!--End Mobile Menu-->
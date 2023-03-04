@php
$categories = App\Models\Category::where('status',1)->orderBy('category_name','ASC')->limit(5)->get();
$categories_skip = App\Models\Category::where('status',1)->orderBy('category_name','ASC')->skip(5)->limit(5)->get();
$categories_2 = App\Models\Category::where('status',1)->orderBy('category_name','ASC')->get();
@endphp
<header class="header-area header-style-1 header-height-2">
    <div class="mobile-promotion">
        <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
    </div>
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><a href="{{ route('cart.page') }}">My Cart</a></li>
                            <li><a href="{{ route('checkout') }}">Checkout</a></li>
                            <li><a href="shop-order.html">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>100% Secure delivery without contacting the courier</li>
                                <li>Supper Value Deals - Save more with coupons</li>
                                <li>Trendy 25silver jewelry, save up 35% off today</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li>Need help? Call Us: <strong class="text-brand"> + 1800 900</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ url('/') }}"><img src="{{asset('user/assets/imgs/theme/logo.svg')}}" alt="logo" /></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="#">
                            <select class="select-active">
                                <option>All Categories</option>
                                @foreach ($categories_2 as $item)
                                    <option>{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                            <input type="text" placeholder="Search for items..." />
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="{{ route('compare.list') }}">
                                    <img class="svgInject" alt="Nest" src="{{asset('user/assets/imgs/theme/icons/icon-compare.svg')}}" />
                                    <span class="pro-count blue" id="compareQty">0</span>
                                </a>
                                <a href="{{ route('compare.list') }}"><span class="lable">Compare</span></a>
                            </div>

                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist.list') }}">
                                    <img class="svgInject" alt="Nest" src="{{asset('user/assets/imgs/theme/icons/icon-heart.svg')}}" />
                                    <span class="pro-count blue" id="wishQty">0</span>
                                </a>
                                <a href="{{ route('wishlist.list') }}"><span class="lable">Wishlist</span></a>
                            </div>

                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('cart.page') }}">
                                    <img alt="Nest" src="{{asset('user/assets/imgs/theme/icons/icon-cart.svg')}}" />
                                    <span class="pro-count blue" id="cartQty">0</span>
                                </a>
                                <a href="{{ route('cart.page') }}"><span class="lable">Cart</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    {{-- Start miniCart with Ajax --}}
                                    <div id="miniCart"></div>
                                    {{-- End miniCart with Ajax --}}
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span id="cartsubTotal"></span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('cart.page') }}" class="outline">View cart</a>
                                            <a href="{{ route('checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2">
                                <a href="javascript:;">
                                    <img class="svgInject" alt="Nest" src="{{asset('user/assets/imgs/theme/icons/icon-user.svg')}}" />
                                </a>
                                @auth
                                    <a href="javascript:;"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('login') }}"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('compare.list') }}"><i class="fi fi-rs-label mr-10"></i>Compare List</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('wishlist.list') }}"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('login') }}"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user.logout') }}"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>
                                    <span class="lable" style="margin-right: 2px; margin-left:2px;">/</span>
                                    <a href="{{ route('register') }}"><span class="lable ml-0">Register</span></a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ url('/') }}"><img src="{{asset('user/assets/imgs/theme/logo.svg')}}" alt="logo" /></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span> All Categories
                            <i class="fi-rs-angle-down"></i>
                        </a>
                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                            <div class="d-flex categori-dropdown-inner">
                                <ul>
                                    @foreach ($categories as $item)
                                        <li>
                                            <a href="{{ route('product.category',[$item->category_slug, $item->id]) }}"> <img src="{{asset($item->category_image)}}" alt="" />{{$item->category_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="end">
                                    @foreach ($categories_skip as $item)
                                        <li>
                                            <a href="{{ route('product.category',[$item->category_slug, $item->id]) }}"> <img src="{{asset($item->category_image)}}" alt="" />{{$item->category_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>

                                <li>
                                    <a class="active" href="{{ url('/') }}">Home </a>
                                </li>
                                @foreach ($categories as $cat)
                                    @php
                                        $sub_categories = App\Models\SubCategory::where('status',1)->where('category_id',$cat->id)->orderBy('subcategory_name','ASC')->get();
                                        $count = App\Models\SubCategory::where('status',1)->where('category_id',$cat->id)->count();
                                    @endphp
                                    <li>
                                        <a href="{{ route('product.category',[$cat->category_slug, $cat->id]) }}">{{$cat->category_name}}<i class="{{ ($count != 0)?'fi-rs-angle-down':'' }}"></i></a>
                                        @if ($count != 0)
                                            <ul class="sub-menu">
                                                @foreach ($sub_categories as $sub)
                                                    <li><a href="{{ route('product.subcategory',[$sub->subcategory_slug, $sub->id]) }}">{{ $sub->subcategory_name }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                <li>
                                    <a href="page-contact.html">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>


                <div class="hotline d-none d-lg-flex">
                    <img src="{{asset('user/assets/imgs/theme/icons/icon-headphone.svg')}}" alt="hotline" />
                    <p>1900 - 888<span>24/7 Support Center</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="{{ route('wishlist.list') }}">
                                <img alt="Nest" src="{{asset('user/assets/imgs/theme/icons/icon-heart.svg')}}" />
                                <span class="pro-count white"id="mbwishQty">0</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="#">
                                <img alt="Nest" src="{{asset('user/assets/imgs/theme/icons/icon-cart.svg')}}" />
                                <span class="pro-count white" id="mbcartQty">0</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <div id="mbminiCart"></div>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span id="mbcartsubTotal"></span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="{{ route('cart.page') }}">View cart</a>
                                        <a href="{{ route('checkout') }}">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
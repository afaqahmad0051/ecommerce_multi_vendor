<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Vendor - Register</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('user/assets/imgs/theme/favicon.svg')}}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('user/assets/css/main.css?v=5.3')}}" />
</head>

<body>
    <!-- Header  -->
    @include('user.body.header')

   <!-- End Header  -->

    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="{{asset('user/assets/imgs/theme/logo.svg')}}" alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li class="menu-item-has-children">
                                <a href="{{ url('/') }}">Home</a>

                            </li>
                            @php
                                $categories = App\Models\Category::where('status',1)->orderBy('category_name','ASC')->get();
                            @endphp
                            @foreach ($categories as $cat)
                                @php
                                    $sub_categories = App\Models\SubCategory::where('status',1)->where('category_id',$cat->id)->orderBy('subcategory_name','ASC')->get();
                                    $count = App\Models\SubCategory::where('status',1)->where('category_id',$cat->id)->count();
                                @endphp
                                <li class="menu-item-has-children">
                                    <a href="{{ route('product.category',[$cat->category_slug, $cat->id]) }}">{{$cat->category_name}}</a>
                                    <ul class="dropdown">
                                        @foreach ($sub_categories as $sub)
                                            <li><a href="{{ route('product.subcategory',[$sub->subcategory_slug, $sub->id]) }}">{{ $sub->subcategory_name }}</a></li>                                        
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="{{ route('vendor.login') }}"><i class="fi-rs-user"></i>Log In</a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Follow Us</h6>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-facebook-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-twitter-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-instagram-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest-white.svg" alt="" /></a>
                    <a href="#"><img src="assets/imgs/theme/icons/icon-youtube-white.svg" alt="" /></a>
                </div>
                <div class="site-copyright">COPYRIGHT {{ date('Y') }} &copy;. Nest. All right reserved.</div>
            </div>
        </div>
    </div>
    <!--End header-->

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Vendor Register
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Create an Account</h1>
                                            <p class="mb-30">Already have an account? <a href="{{ route('vendor.login') }}">Login</a></p>
                                        </div>
                                        <form method="POST" action="{{ route('vendor.register') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="name" id="name" placeholder="Shop Name" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" name="username" id="username" placeholder="User Name" />
                                            </div>
                                            <div class="form-group">
                                                <input type="email" required="" name="email" id="email" placeholder="Email" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" name="phone" id="phone" placeholder="Phone" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password" id="password" placeholder="Password" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" />
                                            </div>
                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                            </div>
                                            <div class="form-group mb-30">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Submit &amp; Register</button>
                                            </div>
                                            <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <div class="card-login mt-115">
                                    <a href="#" class="social-login facebook-login">
                                        <img src="{{asset('user/assets/imgs/theme/icons/logo-facebook.svg')}}" alt="" />
                                        <span>Continue with Facebook</span>
                                    </a>
                                    <a href="#" class="social-login google-login">
                                        <img src="{{asset('user/assets/imgs/theme/icons/logo-google.svg')}}" alt="" />
                                        <span>Continue with Google</span>
                                    </a>
                                    <a href="#" class="social-login apple-login">
                                        <img src="{{asset('user/assets/imgs/theme/icons/logo-apple.svg')}}" alt="" />
                                        <span>Continue with Apple</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('user.body.footer')
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{asset('user/assets/imgs/theme/loading.gif')}}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{asset('user/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('user/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('user/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{asset('user/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/slick.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/wow.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/select2.min.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/counterup.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/images-loaded.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/isotope.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/jquery.vticker-min.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/jquery.theia.sticky.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/jquery.elevatezoom.js')}}"></script>
    <!-- Template  JS -->
    <script src="{{asset('user/assets/js/main.js?v=5.3')}}"></script>
    <script src="{{asset('user/assets/js/shop.js?v=5.3')}}"></script>
</body>

</html>
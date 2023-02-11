<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
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
    {{-- Toastr --}}
	<link rel="stylesheet" type="text/css" href="{{asset('toastr/toastr.css')}}" >
</head>

<body>
    <!-- Header  -->
    @include('user.body.header')
   <!-- End Header  -->

    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{ url('/') }}"><img src="{{asset('user/assets/imgs/theme/logo.svg')}}" alt="logo" /></a>
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
                        <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
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
                <div class="site-copyright">Copyright 2022 © Nest. All rights reserved. Powered by AliThemes.</div>
            </div>
        </div>
    </div>
    <!--End header-->
    @yield('user')

    @include('user.body.footer')
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="assets/imgs/theme/loading.gif" alt="" />
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
     {{-- Toastr --}}
	<script type="text/javascript" src="{{asset('toastr/toastr.min.js')}}"></script>
	<script>
		@if(Session::has('message'))
		var type = "{{ Session::get('alert-type','info') }}"
		switch(type){
		   case 'info':
		   toastr.info(" {{ Session::get('message') }} ");
		   break;
	   
		   case 'success':
		   toastr.success(" {{ Session::get('message') }} ");
		   break;
	   
		   case 'warning':
		   toastr.warning(" {{ Session::get('message') }} ");
		   break;
	   
		   case 'error':
		   toastr.error(" {{ Session::get('message') }} ");
		   break; 
		}
		@endif 
	</script>
</body>

</html>
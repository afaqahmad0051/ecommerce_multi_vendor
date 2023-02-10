<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - Multipurpose eCommerce HTML Template</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('user/assets/imgs/theme/favicon.svg')}}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('user/assets/css/plugins/animate.min.css')}}" />
    <link rel="stylesheet" href="{{asset('user/assets/css/main.css?v=5.3')}}" />
    {{-- Toastr --}}
	<link rel="stylesheet" type="text/css" href="{{asset('toastr/toastr.css')}}" >

</head>

<body>
    <!-- Modal -->

    <!-- Quick view -->
    @include('user.body.quick_view')
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
                                <a href="index.html">Home</a>

                            </li>
                            <li class="menu-item-has-children">
                                <a href="shop-grid-right.html">shop</a>
                                <ul class="dropdown">
                                    <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                    <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                    <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                    <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                    <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Single Product</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Product – Right Sidebar</a></li>
                                            <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                            <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                            <li><a href="shop-product-vendor.html">Product – Vendor Infor</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="shop-filter.html">Shop – Filter</a></li>
                                    <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                    <li><a href="shop-cart.html">Shop – Cart</a></li>
                                    <li><a href="shop-checkout.html">Shop – Checkout</a></li>
                                    <li><a href="shop-compare.html">Shop – Compare</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Shop Invoice</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                            <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                            <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                            <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                            <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                            <li><a href="shop-invoice-6.html">Shop Invoice 6</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#">Mega menu</a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children">
                                        <a href="#">Women's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Dresses</a></li>
                                            <li><a href="shop-product-right.html">Blouses & Shirts</a></li>
                                            <li><a href="shop-product-right.html">Hoodies & Sweatshirts</a></li>
                                            <li><a href="shop-product-right.html">Women's Sets</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Men's Fashion</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Jackets</a></li>
                                            <li><a href="shop-product-right.html">Casual Faux Leather</a></li>
                                            <li><a href="shop-product-right.html">Genuine Leather</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Technology</a>
                                        <ul class="dropdown">
                                            <li><a href="shop-product-right.html">Gaming Laptops</a></li>
                                            <li><a href="shop-product-right.html">Ultraslim Laptops</a></li>
                                            <li><a href="shop-product-right.html">Tablets</a></li>
                                            <li><a href="shop-product-right.html">Laptop Accessories</a></li>
                                            <li><a href="shop-product-right.html">Tablet Accessories</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="blog-category-fullwidth.html">Blog</a>
                                <ul class="dropdown">
                                    <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                    <li><a href="blog-category-list.html">Blog Category List</a></li>
                                    <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                    <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Single Product Layout</a>
                                        <ul class="dropdown">
                                            <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                            <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                            <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="page-about.html">About Us</a></li>
                                    <li><a href="page-contact.html">Contact</a></li>
                                    <li><a href="page-account.html">My Account</a></li>
                                    <li><a href="page-login.html">Login</a></li>
                                    <li><a href="page-register.html">Register</a></li>
                                    <li><a href="page-forgot-password.html">Forgot password</a></li>
                                    <li><a href="page-reset-password.html">Reset password</a></li>
                                    <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                    <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="page-terms.html">Terms of Service</a></li>
                                    <li><a href="page-404.html">404 Page</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Language</a>
                                <ul class="dropdown">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Spanish</a></li>
                                </ul>
                            </li>
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
                    <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt="" /></a>
                    <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-twitter-white.svg')}}" alt="" /></a>
                    <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-instagram-white.svg')}}" alt="" /></a>
                    <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-pinterest-white.svg')}}" alt="" /></a>
                    <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-youtube-white.svg')}}" alt="" /></a>
                </div>
                <div class="site-copyright">Copyright 2022 © Nest. All rights reserved. Powered by AliThemes.</div>
            </div>
        </div>
    </div>
    <!--End header-->
    <main class="main">
        @yield('main')
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
    {{-- Toastr --}}
    
    <script src="{{asset('user/assets/js/toast.min.js')}}"></script>
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
    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        })
        // Product Modal View
        function productView(id) {
            // console.log(id);
            $.ajax({
                type:'GET',
                url:'/product/quick/view/'+id,
                dataType:'json',
                success:function(data){
                    console.log(data);
                    $('#pname').text(data.product.product_name);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.category_name);
                    $('#pbrand').text(data.product.brand.brand_name);
                    $('#pimage').attr('src','/'+data.product.product_thumbnail);
                    $('#product_id').val(id);
                    $('#qty').val(1);

                    if (data.product.discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text('£ '+data.product.selling_price);
                        $('#user_bargain').show();
                    }
                    else{
                        $('#pprice').text('£'+data.product.discount_price);
                        $('#oldprice').text('£'+data.product.selling_price);
                        $('#user_bargain').hide();
                    }
                    //Product Stock
                    if (data.product.product_qty>0) {
                        $('#stock_in').text('');
                        $('#stock_out').text('');
                        $('#stock_in').text('Available');
                    }
                    else{
                        $('#stock_in').text('');
                        $('#stock_out').text('');
                        $('#stock_out').text('Out of stock');
                    }
                    //Product Size
                    $('select[name="size"]').empty();
                    $.each(data.size,function(key,value) {
                        $('select[name="size"]').append('<option value="'+value+' ">'+value+'</option>')
                        if (data.size == '') {
                            $('#sizeArea').hide();
                        }
                    })

                    //Product Color
                    $('select[name="color"]').empty();
                    $.each(data.color,function(key,value) {
                        $('select[name="color"]').append('<option value="'+value+' ">'+value+'</option>')
                        if (data.color == '') {
                            $('#colorArea').hide();
                        }
                    })
                }
            })
        }
        //Add to Cart
        function addToCart() {
            var id = $('#product_id').val();
            var product_name = $('#pname').text();
            var color = $('#color option:selected').text();
            var size = $('#size option:selected').text();
            var quantity = $('#qty').val();
            var user_offer = $('#user_offer').val();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{
                    //New Variable:Variable Name Declared above
                    color:color,
                    size:size,
                    quantity:quantity,
                    product_name:product_name,
                    user_offer:user_offer,
                },
                url:'cart/data/'+id,
                success:function(data){
                    console.log(data);
                    miniCart();
                    $('#closeModal').click();
                    $('#user_offer').val('');
                    $('#qty').val(1);

                    const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                        type: 'success',
                        title: data.success,
                        })
                    }
                    else{
                        Toast.fire({
                        type: 'error',
                        title: data.error,
                        })
                    }
                }
            })
        }
        //Detail Page Add to Cart
        function addToCartDetail() {
            var id = $('#dproduct_id').val();
            var product_name = $('#dpname').text();
            var color = $('#dcolor option:selected').text();
            var size = $('#dsize option:selected').text();
            var quantity = $('#dqty').val();
            var user_offer = $('#duser_offer').val();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{
                    //New Variable:Variable Name Declared above
                    color:color,
                    size:size,
                    quantity:quantity,
                    product_name:product_name,
                    user_offer:user_offer,
                },
                url:'/cart/details/'+id,
                success:function(data){
                    console.log(data);
                    miniCart();
                    $('#duser_offer').val('');
                    $('#dqty').val(1);

                    const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                        type: 'success',
                        title: data.success,
                        })
                    }
                    else{
                        Toast.fire({
                        type: 'error',
                        title: data.error,
                        })
                    }
                }
            })
        }
    </script>
    <script>
        function miniCart() {
            $.ajax({
                type:'GET',
                url:'/cart/mini',
                dataType:'json',
                success:function(response){
                    console.log(response);
                    $('#cartQty').text(response.cartQty);
                    $('span[id="cartsubTotal"]').text('£'+response.cartTotal);
                    var miniCart = ""
                    $.each(response.cart, function(key,value) {
                        miniCart += `<ul>
                            <li>
                                <div class="shopping-cart-img">
                                    <a href="javascript:;"><img alt="Nest" src="/${value.options.image}" style="width:50px; height:50ox;" /></a>
                                </div>
                                <div class="shopping-cart-title" style="margin: -73px 74px 14px; width:146px;">
                                    <h4><a href="javascript:;">${value.name}</a></h4>
                                    <h4><span>${value.qty} × </span>${value.price}</h4>
                                </div>
                                <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                                    <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
                                </div>
                            </li>
                        </ul><br>`
                    });
                    $('#miniCart').html(miniCart);
                }
            })
        }
        miniCart();
        // Cart Remove
        function miniCartRemove(rowId) {
            $.ajax({
                type:'GET',
                url:'/cart/mini/remove/'+rowId,
                dataType:'json',
                success:function(data){
                    miniCart();
                    const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                        type: 'success',
                        title: data.success,
                        })
                    }
                    else{
                        Toast.fire({
                        type: 'error',
                        title: data.error,
                        })
                    }
                }
            })
        }

    </script>
</body>

</html>
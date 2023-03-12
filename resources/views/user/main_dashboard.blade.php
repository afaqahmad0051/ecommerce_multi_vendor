<!DOCTYPE html>
<html class="no-js" lang="en">
@php
    $seo = App\Models\Seo::find(1);
    $setting = App\Models\SiteSetting::find(1);
@endphp
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="title" content="{{ $seo->meta_title }}" />
    <meta name="author" content="{{ $seo->meta_author }}" />
    <meta name="keyword" content="{{ $seo->meta_keyword }}" />
    <meta name="description" content="{{ $seo->meta_descripiton }}" />
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    {{-- Stripe Payment  --}}
    <script src="https://js.stripe.com/v3/"></script>
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
                    <form action="{{ route('product.search') }}" method="POST">
                        @csrf
                        <input name="search" id="search" placeholder="Search for items..." />
                        <div id="searchProducts"></div>
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
                        @auth
                            <a href="{{ route('user.logout') }}"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                        @else
                            <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>
                        @endauth
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>{{$setting->support_phone}}</a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6>Follow Us</h6>
                    <a href="{{ $setting->facebook }}" target="_blank"><img src="{{asset('user/assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt="" /></a>
                    <a href="{{ $setting->twitter }}" target="_blank"><img src="{{asset('user/assets/imgs/theme/icons/icon-twitter-white.svg')}}" alt="" /></a>
                    <a href="{{ $setting->instagram }}" target="_blank"><img src="{{asset('user/assets/imgs/theme/icons/icon-instagram-white.svg')}}" alt="" /></a>
                    <a href="#" target="_blank"><img src="{{asset('user/assets/imgs/theme/icons/icon-pinterest-white.svg')}}" alt="" /></a>
                    <a href="#" target="_blank"><img src="{{asset('user/assets/imgs/theme/icons/icon-youtube-white.svg')}}" alt="" /></a>
                </div>
                <div class="site-copyright"><strong class="text-brand">Nest </strong> &copy; {{ date('Y') }}, All rights reserved</div>
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
    <script src="{{asset('user/assets/js/product-search.js')}}"></script>
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
                    $('#user_offer').val('');
                    $('#pname').text(data.product.product_name);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.category_name);
                    $('#pbrand').text(data.product.brand.brand_name);
                    $('#pimage').attr('src','/'+data.product.product_thumbnail);
                    $('#product_id').val(id);
                    $('#qty').val(1);
                    $('#pvendor_id').text(data.product.vendor_id);

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
            var vendor_id = $('#pvendor_id').text();
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
                    vendor_id:vendor_id,
                },
                url:'/cart/data/'+id,
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
            var vendor_id = $('#dvendor_id').val();
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
                    vendor_id:vendor_id,
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
                    $('#mbcartQty').text(response.cartQty);
                    $('span[id="cartsubTotal"]').text('£'+response.cartTotal);
                    $('span[id="mbcartsubTotal"]').text('£'+response.cartTotal);
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
                    $('#mbminiCart').html(miniCart);
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
    <script>
        //Add to wishlist
        function addToWishList(product_id) {
            $.ajax({
                type:'POST',
                dataType:'json',
                url:'/add-to-wishlist/'+product_id,

                success:function(data){
                    wishlist();
                    const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                        })
                    }
                    else{
                        Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                        })
                    }
                }
            });
        }

        //Wishlist Display
        function wishlist() {
            $.ajax({
                type:'GET',
                dataType:'json',
                url:'/wishlist/products',
                success:function(response){
                    $('#wishQty').text(response.count);
                    $('#mbwishQty').text(response.count);
                    $('#wishcount').text(response.count);
                    var rows = "";
                    $.each(response.wishlist, function(key, value) {
                        rows += `<tr class="pt-30">
                            <td class="image product-thumbnail pt-40"><img src="/${value.product.product_thumbnail}" alt="#" /></td>
                            <td class="product-des product-name">
                                <h6><a class="product-name mb-10" href="javascript:;">${value.product.product_name}</a></h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                ${value.product.discount_price == null
                                ?
                                `<h3 class="text-brand">£${value.product.selling_price}</h3>`
                                :
                                `<h3 class="text-brand">£${value.product.discount_price}</h3>`
                                }
                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                ${value.product.product_qty > 0
                                ?
                                `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                :
                                `<span class="stock-status out-stock mb-0"> Stock Out </span>`
                                }
                            </td>
                            <td class="action text-center" data-title="Remove">
                                <a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fi-rs-trash"></i></a>
                            </td>
                        </tr>`
                    });
                    $('#wishlist').html(rows);
                }
            })
        }
        wishlist();

        //Wishlist Remove
        function wishlistRemove(id){
            $.ajax({
                type:'GET',
                dataType:'json',
                url:'/wishlist/remove/'+id,

                success:function(data){
                    wishlist();
                    const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                        })
                    }
                    else{
                        Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                        })
                    }
                }
            });
        }
    </script>
    <script>
        //Add to compare
        function addToCompare(product_id) {
            $.ajax({
                type:'POST',
                dataType:'json',
                url:'/add-to-compare/'+product_id,

                success:function(data){
                    compare();
                    const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                        })
                    }
                    else{
                        Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                        })
                    }
                }
            });
        }
        
        //Wishlist Display
        function compare() {
            $.ajax({
                type:'GET',
                dataType:'json',
                url:'/compare/products',
                success:function(response){
                    $('#compareQty').text(response.count);
                    $('#comparecount').text(response.count);
                    var rows = "";
                    $.each(response.compare, function(key, value) {
                        rows += `<tr class="pr_image">
                        <td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td>
                        <td class="row_img"><img src="/${value.product.product_thumbnail}" alt="compare-img" style="width:300px; height:300px;"/></td>
                        </tr>
                        <tr class="pr_title">
                            <td class="text-muted font-sm fw-600 font-heading">Name</td>
                            <td class="product_name">
                                <h6><a href="javascript:;" class="text-heading">${value.product.product_name}</a></h6>
                            </td>
                        </tr>
                        <tr class="pr_price">
                            <td class="text-muted font-sm fw-600 font-heading">Price</td>
                            <td class="product_price">
                                ${value.product.discount_price == null
                                ?
                                `<h4 class="price text-brand">£${value.product.selling_price}</h4>`
                                :
                                `<h4 class="price text-brand">£${value.product.discount_price}</h4>`
                                }
                            </td>
                        </tr>
                        <tr class="description">
                            <td class="text-muted font-sm fw-600 font-heading">Description</td>
                            <td class="row_text font-xs">
                                <p class="font-sm text-muted">${value.product.short_desc != null?value.product.short_desc:''}</p>
                            </td>
                        </tr>
                        <tr class="pr_stock">
                            <td class="text-muted font-sm fw-600 font-heading">Stock status</td>
                            <td class="row_stock">
                                ${value.product.product_qty > 0
                                ?
                                `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                :
                                `<span class="stock-status out-stock mb-0"> Stock Out </span>`
                                }
                            </td>
                        </tr>
                        <tr class="pr_remove text-muted">
                            <td class="text-muted font-md fw-600"></td>
                            <td class="row_remove">
                                <a type="submit" class="text-muted" id="${value.id}" onclick="compareRemove(this.id)"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                            </td>
                        </tr>`
                    });
                    $('#compare').html(rows);
                }
            })
        }
        compare();

        
        //Wishlist Remove
        function compareRemove(id){
            $.ajax({
                type:'GET',
                dataType:'json',
                url:'/compare/remove/'+id,

                success:function(data){
                    compare();
                    const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                        })
                    }
                    else{
                        Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                        })
                    }
                }
            });
        }
    </script>
    
    <script>
        // Cart main page 
        function Cart() {
            $.ajax({
                type:'GET',
                url:'/cart/main',
                dataType:'json',
                success:function(response){
                    couponCalculation();
                    console.log(response);
                    var rows = ""
                    $.each(response.cart, function(key,value) {
                        rows += `<tr class="pt-30">
                            <td class="image product-thumbnail pt-40"><img src="/${value.options.image}" alt="#"></td>
                            <td class="product-des product-name">
                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="javascript:;">${value.name}</a></h6>
                            </td>

                            <td class="price" data-title="Price">
                                <h5 class="text-body">£${value.price} </h5>
                            </td>
                            <td class="price" data-title="Price">
                                ${value.options.color == null
                                ?
                                `<h5 class="text-brand">....</h5>`
                                :
                                `<h5 class="text-brand">${value.options.color}</h5>`
                                }
                            </td>
                            <td class="price" data-title="Price">
                                ${value.options.size == null
                                ?
                                `<h5 class="text-brand">....</h5>`
                                :
                                `<h5 class="text-brand">${value.options.size}</h5>`
                                }
                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                <div class="detail-extralink mr-15">
                                    <div class="detail-qty border radius">
                                        <a type="submit" class="qty-down"  id="${value.rowId}" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a> 
                                        <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">
                                        <a type="submit" class="qty-up" id="${value.rowId}" onclick="cartIncrement(this.id)"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                <h5 class="text-brand">£${value.subtotal} </h5>
                            </td>
                            <td class="action text-center" data-title="Remove"><a type="submit" class="text-body" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fi-rs-trash"></i></a></td>
                        </tr>`
                    });
                    $('#cart_page').html(rows);
                }
            })
        }
        Cart();
        // Cart Remove
        function cartRemove(rowId) {
            $.ajax({
                type:'GET',
                url:'/cart/main/remove/'+rowId,
                dataType:'json',
                success:function(data){
                    couponCalculation();
                    Cart();
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

        //Product Decrement In Cart
        function cartDecrement(rowId) {
            $.ajax({
                type: 'GET',
                url: '/cart/decrement/'+rowId,
                dataType:'json',
                success:function(data){
                    couponCalculation();
                    Cart();
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

        //Product Increment In Cart
        function cartIncrement(rowId) {
            $.ajax({
                type: 'GET',
                url: '/cart/increment/'+rowId,
                dataType:'json',
                success:function(data){
                    couponCalculation();
                    Cart();
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

        //User Bargaining
        $(document).ready(function(e) {
            $('#user_offer').keyup(function() {
                var timeout;
                var delay = 1000;
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    UserBargain();
                }, delay);
            });
            function UserBargain() {
                var id = $('#product_id').val();
                var user_offer = $('#user_offer').val();
                $.ajax({
                    type:'GET',
                    dataType:'json',
                    data:{
                        //New Variable:Variable Name Declared above
                        user_offer:user_offer,
                    },
                    url:'/product/bargain/'+id,
                    success:function(data){
                        console.log(data);
    
                        const Toast = Swal.mixin({
                        toast:true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                        })
                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                            })
                        }
                        else{
                            Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                            })
                        }
                    }
                })
            }
        });

        //Detail Page User Bargaining
        $(document).ready(function(e) {
            $('#duser_offer').keyup(function() {
                var timeout;
                var delay = 1000;
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    dUserBargain();
                }, delay);
            });
            
            //Detail Page Add to Cart
            function dUserBargain() {
                var id = $('#dproduct_id').val();
                var user_offer = $('#duser_offer').val();
                $.ajax({
                    type:'GET',
                    dataType:'json',
                    data:{
                        //New Variable:Variable Name Declared above
                        user_offer:user_offer,
                    },
                    url:'/product/detail/bargain/'+id,
                    success:function(data){
                        console.log(data);
    
                        const Toast = Swal.mixin({
                        toast:true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                        })
                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                            })
                        }
                        else{
                            Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                            })
                        }
                    }
                })
            }
        });
    </script>
    <script>
        //Coupon Apply
        function applyCoupon() {
            var coupon_name = $('#coupon_name').val();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{
                    coupon_name:coupon_name
                },
                url:'/coupon/apply',
                success:function(data){
                    // console.log(data);
                    couponCalculation();
                    if (data.validity == true) {
                        $('#couponField').hide();
                    }
                    const Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                        })
                    }
                    else{
                        Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                        })
                    }
                }
            })
        }

        //Coupon Calculation Apply
        function couponCalculation() {
            $.ajax({
                type:'GET',
                url:'/coupon/calculation',
                dataType:'json',
                success:function(data){
                    // console.log(data);
                    if (data.total) {
                        $('#couponCalField').html(
                            `<tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Subtotal</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">£${data.total}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td scope="col" colspan="2">
                                    <div class="divider-2 mt-10 mb-10"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Total</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">£${data.total}</h6>
                                </td>
                            </tr>`
                        )
                    }else{
                        $('#couponCalField').html(
                            `<tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Subtotal</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">£${data.subtotal}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td scope="col" colspan="2">
                                    <div class="divider-2 mt-10 mb-10"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Coupon</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">${data.coupon_name} <a type="submit" onclick="couponRemove()"><i class="fi-rs-trash"></i></a> </h6>
                                </td>
                            </tr>
                            <tr>
                                <td scope="col" colspan="2">
                                    <div class="divider-2 mt-10 mb-10"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Total Discount</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">£${data.discount_amount}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td scope="col" colspan="2">
                                    <div class="divider-2 mt-10 mb-10"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-muted">Grand Total</h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">£${data.total_amount}</h4>
                                </td>
                            </tr>`
                        )
                    }
                }
            })
        }
        couponCalculation();
    </script>
    <script>
        // Coupon Remove
        function couponRemove() {
            $.ajax({
                type:'GET',
                url:'/coupon/remove',
                dataType:'json',
                success:function(data){
                    couponCalculation();
                    $('#couponField').show();
                    $('#coupon_name').val('');
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
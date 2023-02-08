@extends('user.main_dashboard')
@section('main')
@php
    $categories = isset($data['categories'])?$data['categories']:'';
    $product = isset($data['product'])?$data['product']:'';
    $bread_subcat = isset($data['bread_subcat'])?$data['bread_subcat']:'';
    $new_product = isset($data['new_product'])?$data['new_product']:'';
@endphp
<div class="page-header mt-30 mb-50">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h3 class="mb-15">{{ $bread_subcat->subcategory_name }}</h3>
                    <div class="breadcrumb">
                        <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> Shop <span></span> {{ $bread_subcat->category->category_name }} <span></span> {{ $bread_subcat->subcategory_name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ count($product) }}</strong> items for you!</p>
                </div>
                <div class="sort-by-product-area">
                    <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Show:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">50</a></li>
                                <li><a href="#">100</a></li>
                                <li><a href="#">150</a></li>
                                <li><a href="#">200</a></li>
                                <li><a href="#">All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                                <li><a href="#">Avg. Rating</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product-grid">
                @foreach ($product as $item)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s" style="height: 390px; width:200px;">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    @php
                                        $img = App\Models\ProductImage::where('product_id',$item->id)->first();
                                    @endphp
                                    <a href="{{ route('product.details',[$item->product_slug, $item->id]) }}">
                                        <img class="default-img" src="{{ asset($item->product_thumbnail) }}" alt="" />
                                        <img class="hover-img" src="{{ asset($img->photo_name) }}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $item->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                </div>
                                @php
                                    if ($item->discount_price != null || $item->discount_price != 0 || $item->discount_price != '') {
                                        $amount = $item->selling_price - $item->discount_price;
                                        $discount = $amount / $item->selling_price * 100;
                                    }
                                @endphp
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($item->discount_price == null || $item->discount_price == 0 || $item->discount_price == '')
                                        <span class="new">New</span>
                                    @else
                                        @if ($discount != null && $discount <= 25)
                                            <span class="sale">Sale</span>
                                        @else
                                            <span class="hot">Save {{ round($discount) }}%</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    @php
                                        $subcat = App\Models\SubCategory::where('id',$item->subcategory_id)->first();
                                    @endphp
                                    @if ($item->subcategory_id != null || $item->subcategory_id != 0 || $item->subcategory_id != '' && $item->category_id != null || $item->category_id != 0 || $item->category_id != '')
                                    <a href="{{ route('product.subcategory',[$subcat->subcategory_slug, $subcat->id]) }}">{{ $item['subcategory']['subcategory_name'] }}</a>
                                    @endif
                                </div>
                                <h2><a href="{{ route('product.details',[$item->product_slug, $item->id]) }}">{{ $item->product_name }}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    @if ($item->vendor_id == null || $item->vendor_id == 0 || $item->vendor_id == '')
                                        <span class="font-small text-muted">By <a href="javascript:;">Admin</a></span>
                                    @else
                                        <span class="font-small text-muted">By <a href="{{ route('vendor.details',$item->id) }}">{{ $item['vendor']['name'] }}</a></span>
                                    @endif
                                </div>
                                <div class="product-card-bottom">
                                    @if ($item->discount_price == null || $item->discount_price == 0 || $item->discount_price == '')
                                        <div class="product-price">
                                            <span>£{{ $item->selling_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>£{{ $item->discount_price }}</span>
                                            <span class="old-price">£{{ $item->selling_price }}</span>
                                        </div>
                                    @endif
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!--end product card-->
            </div>
            <!--product grid-->
            <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!--End Deals-->
        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-category-2 mb-30">
                <h5 class="section-title style-1 mb-30">Category</h5>
                <ul>
                    @foreach ($categories as $cat)
                        @php
                            $product = App\Models\Product::where('category_id',$cat->id)->get();
                        @endphp
                        <li>
                            <a href="{{ route('product.category',[$cat->category_slug, $cat->id]) }}"> <img src="{{ asset($cat->category_image) }}" alt="" />{{ $cat->category_name }}</a><span class="count">{{count($product)}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- Product sidebar Widget -->
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                <h5 class="section-title style-1 mb-30">New products</h5>
                @foreach ($new_product as $product)
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="{{ asset($product->product_thumbnail) }}" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <label style="font-weight: bold; font-size:17px;"><a href="{{ route('product.details',[$product->product_slug, $product->id]) }}">{{ $product->product_name }}</a></label>
                            @if ($product->discount_price == null || $product->discount_price == 0 || $product->discount_price == '')
                                <p class="price mb-0 mt-5">£{{$product->selling_price}}</p>
                            @else
                                <p class="price mb-0 mt-5">£{{$product->discount_price}}</p>
                            @endif
                            <div class="product-rate">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
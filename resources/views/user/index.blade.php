@extends('user.main_dashboard')
@section('main')
@php
    $cat_first = isset($data['cat_first'])?$data['cat_first']:'';
    $pro_first = isset($data['pro_first'])?$data['pro_first']:'';
    $cat_second = isset($data['cat_second'])?$data['cat_second']:'';
    $pro_second = isset($data['pro_second'])?$data['pro_second']:'';
    $cat_third = isset($data['cat_third'])?$data['cat_third']:'';
    $pro_third = isset($data['pro_third'])?$data['pro_third']:'';
    $hot_deals = isset($data['hot_deals'])?$data['hot_deals']:'';
    $special_offer = isset($data['special_offer'])?$data['special_offer']:'';
    $recently_added = isset($data['recently_added'])?$data['recently_added']:'';
    $special_deals = isset($data['special_deals'])?$data['special_deals']:'';
@endphp
@include('user.layouts.slider')
<!--End hero slider-->
@include('user.layouts.category')
<!--End category slider-->
@include('user.layouts.banner')
<!--End banners-->
@include('user.layouts.new_products')
<!--Products Tabs-->
@include('user.layouts.featured_products')
<!--End Best Sales-->
<!-- First Category -->
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $cat_first->category_name }} Category </h3>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($pro_first as $item)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
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
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
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
                                        @if ($item->subcategory_id != null || $item->subcategory_id != 0 || $item->subcategory_id != '' && $item->category_id != null || $item->category_id != 0 || $item->category_id != '')
                                        <a href="javascript:;">{{ $item['category']['category_name'] }}</a>
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
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Admin</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $item['vendor']['name'] }}</a></span>
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
                        <!--end product card-->
                    @endforeach
                    <!--end product card-->
                </div>
                <!--End product-grid-4-->
            </div>
        </div>
        <!--End tab-content-->
    </div>
</section>
<!--End First Category -->
<!-- Second Category -->
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $cat_second->category_name }} Category </h3>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($pro_second as $item)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
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
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
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
                                        @if ($item->subcategory_id != null || $item->subcategory_id != 0 || $item->subcategory_id != '' && $item->category_id != null || $item->category_id != 0 || $item->category_id != '')
                                        <a href="javascript:;">{{ $item['category']['category_name'] }}</a>
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
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Admin</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $item['vendor']['name'] }}</a></span>
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
                        <!--end product card-->
                    @endforeach
                    <!--end product card-->
                </div>
                <!--End product-grid-4-->
            </div>
        </div>
        <!--End tab-content-->
    </div>
</section>
<!--End Second Category -->
<!-- Third Category -->
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $cat_third->category_name }} Category </h3>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($pro_third as $item)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
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
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
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
                                        @if ($item->subcategory_id != null || $item->subcategory_id != 0 || $item->subcategory_id != '' && $item->category_id != null || $item->category_id != 0 || $item->category_id != '')
                                        <a href="javascript:;">{{ $item['category']['category_name'] }}</a>
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
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Admin</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $item['vendor']['name'] }}</a></span>
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
                        <!--end product card-->
                    @endforeach
                    <!--end product card-->
                </div>
                <!--End product-grid-4-->
            </div>
        </div>
        <!--End tab-content-->
    </div>
</section>
<!--End Third Category -->
<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($hot_deals as $item)
                        @php
                            if ($item->discount_price != null || $item->discount_price != 0 || $item->discount_price != '') {
                                $amount = $item->selling_price - $item->discount_price;
                                $discount = $amount / $item->selling_price * 100;
                            }
                        @endphp
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ route('product.details',[$item->product_slug, $item->id]) }}"><img src="{{ asset($item->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ route('product.details',[$item->product_slug, $item->id]) }}">{{ $item->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
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
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Offer </h4>
                <div class="product-list-small animated animated">
                    @foreach ($special_offer as $item)
                        @php
                            if ($item->discount_price != null || $item->discount_price != 0 || $item->discount_price != '') {
                                $amount = $item->selling_price - $item->discount_price;
                                $discount = $amount / $item->selling_price * 100;
                            }
                        @endphp
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ route('product.details',[$item->product_slug, $item->id]) }}"><img src="{{ asset($item->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ route('product.details',[$item->product_slug, $item->id]) }}">{{ $item->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
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
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                <div class="product-list-small animated animated">
                    @foreach ($recently_added as $item)
                        @php
                            if ($item->discount_price != null || $item->discount_price != 0 || $item->discount_price != '') {
                                $amount = $item->selling_price - $item->discount_price;
                                $discount = $amount / $item->selling_price * 100;
                            }
                        @endphp
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ route('product.details',[$item->product_slug, $item->id]) }}"><img src="{{ asset($item->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ route('product.details',[$item->product_slug, $item->id]) }}">{{ $item->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
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
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($special_deals as $item)
                        @php
                            if ($item->discount_price != null || $item->discount_price != 0 || $item->discount_price != '') {
                                $amount = $item->selling_price - $item->discount_price;
                                $discount = $amount / $item->selling_price * 100;
                            }
                        @endphp
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ route('product.details',[$item->product_slug, $item->id]) }}"><img src="{{ asset($item->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{ route('product.details',[$item->product_slug, $item->id]) }}">{{ $item->product_name }}</a>
                                </h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
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
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--End 4 columns-->
<!--Vendor List -->
@include('user.layouts.vendor_list')
<!--End Vendor List -->
@endsection
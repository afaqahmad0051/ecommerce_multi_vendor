@extends('user.main_dashboard')
@php
    $vendor = isset($data['vendor'])?$data['vendor']:'';
    $vProduct = isset($data['vProduct'])?$data['vProduct']:'';
@endphp
@section('title')
{{ $vendor->name }}
@endsection
@section('main')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Store <span></span> {{ $vendor->name }}
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="archive-header-2 text-center pt-80 pb-50">
        <h1 class="display-2 mb-50">{{ $vendor->name }}</h1>
        
    </div>
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ count($vProduct) }}</strong> items for you!</p>
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
                @foreach ($vProduct as $item)
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
                                    <a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" id="{{ $item->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
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
                                        $cat = App\Models\Category::where('id',$item->category_id)->first();
                                    @endphp
                                    @if ($item->subcategory_id != null || $item->subcategory_id != 0 || $item->subcategory_id != '' && $item->category_id != null || $item->category_id != 0 || $item->category_id != '')
                                    <a href="{{ route('product.category',[$cat->category_slug, $cat->id]) }}">{{ $item['category']['category_name'] }}</a>
                                    @endif
                                </div>
                                <h2><a href="{{ route('product.details',[$item->product_slug, $item->id]) }}">{{ $item->product_name }}</a></h2>
                                <div class="product-rate-cover">
                                    @php
                                        $average = App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
                                        $r_count = App\Models\Review::where('product_id',$item->id)->where('status',1)->count();
                                    @endphp
                                    <div class="product-rate d-inline-block">
                                    @if ($average == 0)
                                    @elseif($average == 1 || $average < 2)
                                        <div class="product-rating" style="width: 20%"></div>
                                    @elseif($average == 2 || $average < 3)
                                        <div class="product-rating" style="width: 40%"></div>
                                    @elseif($average == 3 || $average < 4)
                                        <div class="product-rating" style="width: 60%"></div>
                                    @elseif($average == 4 || $average < 5)
                                        <div class="product-rating" style="width: 80%"></div>
                                    @elseif($average == 5)
                                        <div class="product-rating" style="width: 100%"></div>
                                    @endif
                                    </div>
                                    <span class="font-small ml-5 text-muted"> ({{$r_count}} reviews)</span>
                                </div>
                                <div>
                                    @if ($item->vendor_id == null || $item->vendor_id == 0 || $item->vendor_id == '')
                                        <span class="font-small text-muted">By <a href="javascript:;">Admin</a></span>
                                    @else
                                        <span class="font-small text-muted">By <a href="{{ route('supplier.shop',$item->vendor_id) }}">{{ $item['vendor']['name'] }}</a></span>
                                    @endif
                                </div>
                                <div class="product-card-bottom">
                                    @if ($item->discount_price == null || $item->discount_price == 0 || $item->discount_price == '')
                                        <div class="product-price">
                                            <span>??{{ $item->selling_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>??{{ $item->discount_price }}</span>
                                            <span class="old-price">??{{ $item->selling_price }}</span>
                                        </div>
                                    @endif
                                    <div class="add-cart">
                                        <a class="add" href="{{ route('product.details',[$item->product_slug, $item->id]) }}"><i class="fi-rs-shopping-cart mr-5"></i> Details </a>
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
            <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                <div class="vendor-logo mb-30">
                    <img src="{{(!empty($vendor->photo))? url('upload/vendor_images/'.$vendor->photo):url('upload/blank.jpg')}}" alt="" />
                </div>
                <div class="vendor-info">
                    @if($vendor->year_id != null)
                        <div class="product-category">
                            <span class="text-muted">Since {{ isset($vendor->year_id)?$vendor->year->name:'' }}</span>
                        </div>
                    @endif
                    <h4 class="mb-5"><a href="{{ route('supplier.shop',$vendor->id) }}" class="text-heading">{{ $vendor->name }}</a></h4>
                    <div class="product-rate-cover">
                        @php
                            $average = App\Models\Review::where('vendor_id',$vendor->id)->where('status',1)->avg('rating');
                            $r_count = App\Models\Review::where('vendor_id',$vendor->id)->where('status',1)->count();
                        @endphp
                        <div class="product-rate d-inline-block">
                        @if ($average == 0)
                        @elseif($average == 1 || $average < 2)
                            <div class="product-rating" style="width: 20%"></div>
                        @elseif($average == 2 || $average < 3)
                            <div class="product-rating" style="width: 40%"></div>
                        @elseif($average == 3 || $average < 4)
                            <div class="product-rating" style="width: 60%"></div>
                        @elseif($average == 4 || $average < 5)
                            <div class="product-rating" style="width: 80%"></div>
                        @elseif($average == 5)
                            <div class="product-rating" style="width: 100%"></div>
                        @endif
                        </div>
                        <span class="font-small ml-5 text-muted"> ({{$r_count}} reviews)</span>
                    </div>
                    <div class="vendor-des mb-30">
                        <p class="font-sm text-heading">{{ $vendor->vendor_short_info }}</p>
                    </div>
                    <div class="follow-social mb-20">
                        <h6 class="mb-15">Follow Us</h6>
                        <ul class="social-network">
                            <li class="hover-up">
                                <a href="javascript:;">
                                    <img src="{{asset('user/assets/imgs/theme/icons/social-tw.svg')}}" alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="javascript:;">
                                    <img src="{{asset('user/assets/imgs/theme/icons/social-fb.svg')}}" alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="javascript:;">
                                    <img src="{{asset('user/assets/imgs/theme/icons/social-insta.svg')}}" alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="javascript:;">
                                    <img src="{{asset('user/assets/imgs/theme/icons/social-pin.svg')}}" alt="" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="vendor-info">
                        <ul class="font-sm mb-20">
                            <li><img class="mr-5" src="{{asset('user/assets/imgs/theme/icons/icon-location.svg')}}" alt="" /><strong>Address: </strong> <span>{{ $vendor->address }}</span></li>
                            <li><img class="mr-5" src="{{asset('user/assets/imgs/theme/icons/icon-contact.svg')}}" alt="" /><strong>Call Us:</strong><span>{{ $vendor->phone }}</span></li>
                        </ul>
                        <a href="javascript:;" class="btn btn-xs">Contact Seller <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
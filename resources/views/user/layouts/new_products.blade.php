@php
    $new_product = App\Models\Product::where('status',1)->latest()->limit(10)->get();
    $categories = App\Models\Category::orderBy('category_name','ASC')->get();
@endphp
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> New Products </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                </li>
                @foreach ($categories as $cat)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nav-tab-two" data-bs-toggle="tab" href="#category{{ $cat->id }}" type="button" role="tab" aria-controls="tab-two" aria-selected="false">{{ $cat->category_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($new_product as $item)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s" style="height: 420px;">
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
                                    @php
                                        $cat = App\Models\Category::where('id',$item->category_id)->first();
                                    @endphp
                                    <div class="product-category">
                                        @if ($item->subcategory_id != null || $item->subcategory_id != 0 || $item->subcategory_id != '' && $item->category_id != null || $item->category_id != 0 || $item->category_id != '')
                                        <a href="{{ route('product.category',[$cat->category_slug, $cat->id]) }}">{{ $item['category']['category_name'] }}</a>
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
                        <!--end product card-->
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one-->
            
            @foreach ($categories as $cat)
                <div class="tab-pane fade" id="category{{ $cat->id }}" role="tabpanel" aria-labelledby="tab-two">
                    <div class="row product-grid-4">
                        @php
                            $catwiseProduct = App\Models\Product::where('category_id',$cat->id)->latest()->get();
                        @endphp
                        @forelse ($catwiseProduct as $item)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            @php
                                                $img = App\Models\ProductImage::where('product_id',$item->id)->first();
                                            @endphp
                                            <a href="shop-product-right.html">
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
                                        @php
                                            $cat = App\Models\Category::where('id',$item->category_id)->first();
                                        @endphp
                                        <div class="product-category">
                                            @if ($item->subcategory_id != null || $item->subcategory_id != 0 || $item->subcategory_id != '' && $item->category_id != null || $item->category_id != 0 || $item->category_id != '')
                                            <a href="{{ route('product.category',[$cat->category_slug, $cat->id]) }}">{{ $item['category']['category_name'] }}</a>
                                                
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
                        @empty
                            <h5 class="text-danger">No Product Found</h5>
                        @endforelse
                        <!--end product card-->
                    </div>
                    <!--End product-grid-4-->
                </div>
            @endforeach
            <!--En tab two-->
        </div>
        <!--End tab-content-->
    </div>
</section>
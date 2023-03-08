@php
    $featured = App\Models\Product::where('featured',1)->orderBy('id','desc')->limit(10)->get();
@endphp
<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Featured Products </h3>
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100">Bring nature into your home</h2>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                @foreach ($featured as $item)
                                    <div class="product-cart-wrap">
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
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $item->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" id="{{ $item->id }}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" id="{{ $item->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
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
                                            @if ($item->discount_price == null || $item->discount_price == 0 || $item->discount_price == '')
                                                <div class="product-price mt-10">
                                                    <span>£{{ $item->selling_price }}</span>
                                                </div>
                                            @else
                                                <div class="product-price mt-10">
                                                    <span>£{{ $item->discount_price }}</span>
                                                    <span class="old-price">£{{ $item->selling_price }}</span>
                                                </div>
                                            @endif
                                            <div class="sold mt-15 mb-15">
                                                <div class="progress mb-5">
                                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <a href="{{ route('product.details',[$item->product_slug, $item->id]) }}" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Details</a>
                                        </div>
                                    </div>    
                                @endforeach
                                <!--End product Wrap-->
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->
                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>
@extends('user.main_dashboard')
@section('title')
    Blog & News
@endsection
@section('main')
@php
    $categories = isset($data['category'])?$data['category']:'';
    $posts = isset($data['post'])?$data['post']:'';
@endphp
<div class="page-header mt-30 mb-75">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h1 class="mb-15">Blog &amp; News</h1>
                    <div class="breadcrumb">
                        <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> Blog &amp; News
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-content mb-50" style="transform: none;">
    <div class="container" style="transform: none;">
        <div class="row" style="transform: none;">
            <div class="col-lg-9">
                <div class="shop-product-fillter mb-50 pr-30">
                    <div class="totall-product">
                        
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
                                    <span><i class="fi-rs-apps-sort"></i>Sort:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span>Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Newest</a></li>
                                    <li><a href="#">Most comments</a></li>
                                    <li><a href="#">Release Date</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="loop-grid pr-30">
                    <div class="row">
                        @foreach ($posts as $post)
                            <article class="col-xl-4 col-lg-6 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="{{ route('blog.read',[$post->post_slug, $post->id]) }}">
                                        <img class="border-radius-15" src="{{ asset($post->post_image) }}" alt="">
                                    </a>
                                </div>
                                <div class="entry-content-2">
                                    @php
                                        $category = App\Models\BlogCategory::where('id',$post->category_id)->first(); 
                                    @endphp
                                    <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="{{ route('blog.category.grid',[$category->blog_category_slug, $category->id]) }}">{{ $category->blog_category_name }}</a></h6>
                                    <h4 class="post-title mb-15">
                                        <a href="{{ route('blog.read',[$post->post_slug, $post->id]) }}">{{ $post->post_title }}</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">{{ $post->created_at->format('d M Y') }}</span>
                                            <span class="hit-count has-dot mr-10">126k Views</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
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
            </div>
            <div class="col-lg-3 primary-sidebar sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;"><div class="widget-area">
                        <div class="sidebar-widget-2 widget_search mb-50">
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" placeholder="Search…">
                                    <button type="submit"><i class="fi-rs-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget widget-category-2 mb-50">
                            <h5 class="section-title style-1 mb-30">Category</h5>
                            <ul>
                                @foreach ($categories as $cat)
                                    @php
                                        $count = App\Models\Blog::where('category_id',$cat->id)->count();
                                    @endphp
                                    <li>
                                        <a href="{{ route('blog.category.grid',[$cat->blog_category_slug, $cat->id]) }}"> <img src="{{asset('user/assets/imgs/theme/icons/category-1.svg')}}" alt="" />{{ $cat->blog_category_name }}</a><span class="count">{{ $count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Product sidebar Widget -->
                        @php
                            $hot_deals = App\Models\Product::where('status',1)->inRandomOrder()->limit(4)->get();        
                        @endphp
                        <div class="sidebar-widget product-sidebar mb-50 p-30 bg-grey border-radius-10">
                            <h5 class="section-title style-1 mb-30">Trending Now</h5>
                            @foreach ($hot_deals as $item)
                                <div class="single-post clearfix">
                                    <div class="image">
                                        <img src="{{ asset($item->product_thumbnail) }}" alt="#" />
                                    </div>
                                    <div class="content pt-10">
                                        <h6><a href="{{ route('product.details',[$item->product_slug, $item->id]) }}">{{ $item->product_name }}</a></h6>
                                        <p class="price mb-0 mt-5">£{{ isset($item->discount_price)?$item->discount_price:$item->selling_price }}</p>
                                        @php
                                            $average = App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
                                            $r_count = App\Models\Review::where('product_id',$item->id)->where('status',1)->count();
                                        @endphp
                                        <div class="product-rate">
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
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('user.main_dashboard')
@php
    $categories = isset($data['category'])?$data['category']:'';
    $blog = isset($data['blog'])?$data['blog']:'';
@endphp
@section('title')
    {{ $blog->post_title }}
@endsection
@section('main')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> <a href="shop-grid-right.html">{{ $blog->category->blog_category_name }}</a> <span></span>{{ $blog->post_title }}
        </div>
    </div>
</div>
<div class="page-content mb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-11 col-lg-12 m-auto">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="single-page pt-50 pr-30">
                            <div class="single-header style-2">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto">
                                        <h6 class="mb-10"><a href="{{ route('blog.category.grid',[$blog->category->blog_category_slug, $blog->category->id]) }}">{{ $blog->category->blog_category_name }}</a></h6>
                                        <h2 class="mb-10">{{ $blog->post_title }}</h2>
                                        <div class="single-header-meta">
                                            <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                                <a class="author-avatar" href="#">
                                                    <img class="img-circle" src="{{ (!empty($blog->user->photo)) ? url('upload/admin_images/'.$blog->user->photo):url('upload/blank.jpg') }}" alt=""/>
                                                </a>
                                                <span class="post-by">By <a href="">{{ $blog->user->name }}</a></span>
                                                <span class="post-on has-dot">{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</span>
                                                <span class="time-reading has-dot">8 mins read</span>
                                            </div>
                                            <div class="social-icons single-share">
                                                <ul class="text-grey-5 d-inline-block">
                                                    <li class="mr-5">
                                                        <a href="javascript:;"><img src="{{asset('user/assets/imgs/theme/icons/icon-bookmark.svg')}}" alt="" /></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;"><img src="{{asset('user/assets/imgs/theme/icons/icon-heart-2.svg')}}" alt="" /></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <figure class="single-thumbnail">
                                <img src="{{asset($blog->post_image)}}" alt="" />
                            </figure>
                            <div class="single-content">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto">
                                        <p class="single-excerpt">{!! $blog->post_long_desc !!}</p>
                                        <!--Entry bottom-->
                                        <div class="entry-bottom mt-50 mb-30">
                                            <div class="tags w-50 w-sm-100">
                                                <a href="blog-category-big.html" rel="tag"
                                                    class="hover-up btn btn-sm btn-rounded mr-10">deer</a>
                                                <a href="blog-category-big.html" rel="tag"
                                                    class="hover-up btn btn-sm btn-rounded mr-10">nature</a>
                                                <a href="blog-category-big.html" rel="tag"
                                                    class="hover-up btn btn-sm btn-rounded mr-10">conserve</a>
                                            </div>
                                            <div class="social-icons single-share">
                                                <ul class="text-grey-5 d-inline-block">
                                                    <li><strong class="mr-10">Share this:</strong></li>
                                                    <li class="social-facebook">
                                                        <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-facebook.svg')}}" alt="" /></a>
                                                    </li>
                                                    <li class="social-twitter">
                                                        <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-twitter.svg')}}" alt="" /></a>
                                                    </li>
                                                    <li class="social-instagram">
                                                        <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-instagram.svg')}}" alt="" /></a>
                                                    </li>
                                                    <li class="social-linkedin">
                                                        <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-pinterest.svg')}}" alt="" /></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--Author box-->
                                        <div class="author-bio p-30 mt-50 border-radius-15 bg-white">
                                            <div class="author-image mb-30">
                                                <a href="author.html"><img src="assets/imgs/blog/author-1.png"
                                                        alt="" class="avatar" /></a>
                                                <div class="author-infor">
                                                    <h5 class="mb-5">Barbara Cartland</h5>
                                                    <p class="mb-0 text-muted font-xs">
                                                        <span class="mr-10">306 posts</span>
                                                        <span class="has-dot">Since 2012</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="author-des">
                                                <p>Hi there, I am a veteran food blogger sharing my daily all
                                                    kinds of healthy and fresh recipes. I find inspiration in
                                                    nature, on the streets and almost everywhere. Lorem ipsum
                                                    dolor sit amet, consectetur adipiscing elit. Amet id enim,
                                                    libero sit. Est donec lobortis cursus amet, cras elementum
                                                    libero</p>
                                            </div>
                                        </div>
                                        <!--Comment form-->
                                        <div class="comment-form">
                                            <h3 class="mb-15">Leave a Comment</h3>
                                            <div class="product-rate d-inline-block mb-30"></div>
                                            <div class="row">
                                                <div class="col-lg-9 col-md-12">
                                                    <form class="form-contact comment_form mb-50" action="#"
                                                        id="commentForm">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control w-100"
                                                                        name="comment" id="comment" cols="30"
                                                                        rows="9"
                                                                        placeholder="Write Comment"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="name"
                                                                        id="name" type="text"
                                                                        placeholder="Name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="email"
                                                                        id="email" type="email"
                                                                        placeholder="Email" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="website"
                                                                        id="website" type="text"
                                                                        placeholder="Website" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit"
                                                                class="button button-contactForm">Post
                                                                Comment</button>
                                                        </div>
                                                    </form>
                                                    <div class="comments-area">
                                                        <h3 class="mb-30">Comments</h3>
                                                        <div class="comment-list">
                                                            <div
                                                                class="single-comment justify-content-between d-flex mb-30">
                                                                <div
                                                                    class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <img src="assets/imgs/blog/author-2.png"
                                                                            alt="" />
                                                                        <a href="#"
                                                                            class="font-heading text-brand">Sienna</a>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div
                                                                            class="d-flex justify-content-between mb-10">
                                                                            <div
                                                                                class="d-flex align-items-center">
                                                                                <span
                                                                                    class="font-xs text-muted">December
                                                                                    4, 2022 at 3:12 pm </span>
                                                                            </div>
                                                                            <div
                                                                                class="product-rate d-inline-block">
                                                                                <div class="product-rating"
                                                                                    style="width: 80%"></div>
                                                                            </div>
                                                                        </div>
                                                                        <p class="mb-10">Lorem ipsum dolor sit
                                                                            amet, consectetur adipisicing elit.
                                                                            Delectus, suscipit exercitationem
                                                                            accusantium obcaecati quos voluptate
                                                                            nesciunt facilis itaque modi commodi
                                                                            dignissimos sequi repudiandae minus
                                                                            ab deleniti totam officia id
                                                                            incidunt? <a href="#"
                                                                                class="reply">Reply</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                                <div
                                                                    class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <img src="assets/imgs/blog/author-3.png"
                                                                            alt="" />
                                                                        <a href="#"
                                                                            class="font-heading text-brand">Brenna</a>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div
                                                                            class="d-flex justify-content-between mb-10">
                                                                            <div class="d-flex align-items-cer">
                                                                            </div>
                                                                            <div
                                                                                class="product-rate d-inline-block">
                                                                                <div class="product-rating"
                                                                                    style="width: 80%"></div>
                                                                            </div>
                                                                        </div>
                                                                        <p class="mb-10">Lorem ipsum dolor sit
                                                                            amet, consectetur adipisicing elit.
                                                                            Delectus, suscipit exercitationem
                                                                            accusantium obcaecati quos voluptate
                                                                            nesciunt facilis itaque modi commodi
                                                                            dignissimos sequi repudiandae minus
                                                                            ab deleniti totam officia id
                                                                            incidunt? <a href="#"
                                                                                class="reply">Reply</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="single-comment justify-content-between d-flex">
                                                                <div
                                                                    class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <img src="assets/imgs/blog/author-4.png"
                                                                            alt="" />
                                                                        <a href="#"
                                                                            class="font-heading text-brand">Gemma</a>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div
                                                                            class="d-flex justify-content-between mb-10">
                                                                            <div
                                                                                class="d-flex align-items-center">
                                                                                <span
                                                                                    class="font-xs text-muted">December
                                                                                    4, 2022 at 3:12 pm </span>
                                                                            </div>
                                                                            <div
                                                                                class="product-rate d-inline-block">
                                                                                <div class="product-rating"
                                                                                    style="width: 80%"></div>
                                                                            </div>
                                                                        </div>
                                                                        <p class="mb-10">Lorem ipsum dolor sit
                                                                            amet, consectetur adipisicing elit.
                                                                            Delectus, suscipit exercitationem
                                                                            accusantium obcaecati quos voluptate
                                                                            nesciunt facilis itaque modi commodi
                                                                            dignissimos sequi repudiandae minus
                                                                            ab deleniti totam officia id
                                                                            incidunt? <a href="#"
                                                                                class="reply">Reply</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar pt-50">
                        <div class="widget-area">
                            <div class="sidebar-widget-2 widget_search mb-50">
                                <div class="search-form">
                                    <form action="#">
                                        <input type="text" placeholder="Search…" />
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
</div>
@endsection
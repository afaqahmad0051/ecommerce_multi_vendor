@extends('user.main_dashboard')
@php
    $blogs = isset($data['blog'])?$data['blog']:'';
    $cat = isset($data['category'])?$data['category']:'';
@endphp
@section('title')
{{ $cat->blog_category_name }}
@endsection
@section('main')
<div class="page-header mt-30 mb-75">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h1 class="mb-15">{{ $cat->blog_category_name }}</h1>
                    <div class="breadcrumb">
                        <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> {{ $cat->blog_category_name }}
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
<div class="page-content mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop-product-fillter mb-50">
                    <div class="totall-product">
                        <h2>
                            {{ $cat->blog_category_name }}
                        </h2>
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
                <div class="loop-grid">
                    <div class="row">
                        @foreach ($blogs as $post)
                            <article class="col-xl-3 col-lg-4 col-md-6 text-center hover-up mb-30 animated">
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
        </div>
    </div>
</div>
@endsection
@extends('admin.admin_dashboard')
@section('title')
Blog
@endsection
@php
    $category = isset($data['category'])?$data['category']:'';
    $blog = isset($data['blog'])?$data['blog']:'';
@endphp
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="row">
        <div class="col-sm-6">
            <h6 class="mb-0 text-uppercase">Blog</h6>
        </div>
        <div class="col-sm-6">
            @php
                $next = App\Models\Blog::where('id', '>', $blog->id)->min('id');
                $previous = App\Models\Blog::where('id', '<', $blog->id)->max('id');
            @endphp
            <div class="row">
                <div class="col-md-10">
                    <div class="btn-group" role="group" style="float: right;">
                        <a href="{{ (isset($previous))?$previous:'javascript:;' }}" class="btn btn-secondary btn-sm"><i class="bx bx-caret-left-circle"></i></a>
                        <a href="{{ (isset($next))?$next:'javascript:;' }}" class="btn btn-secondary btn-sm"><i class="bx bx-caret-right-circle"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('blog.post.list') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="blog" action="{{ route('blog.post.update',$blog->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $blog->post_image }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Category: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                <select class="single-select" name="category_id">
                                                    <option value="0">Select</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{$item->id}}" {{ $item->id == $blog->category_id?'selected':'' }}>{{ $item->blog_category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Category Image: </label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="file" name="photo" id="image" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Blog Title: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                <input type="text" class="form-control" name="post_title" value="{{ $blog->post_title }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-8">
                                                @if ($blog->post_image != null)
                                                    <img class="rounded avatar-lg" id="showImg" src=" {{ asset($blog->post_image) }}" style="float: right; heigt:100px; width:100px;">
                                                @else
                                                    <img class="rounded avatar-lg" id="showImg" src=" {{ url('upload/blank1.png') }}" style="float: right; heigt:100px; width:100px;">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Short Desc: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9 form-group">
                                                <textarea class="form-control" name="post_short_desc" id="inputProductDescription" rows="3">{!! $blog->post_short_desc !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Long Desc: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9 form-group">
                                            </textarea><textarea id="mytextarea" name="post_long_desc">{!! $blog->post_long_desc !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Status: </label>
                                            <div class="col-sm-8">
                                                <div class="form-check form-switch">
                                                    @if ($blog->status == 1)
                                                        <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckChecked" name="status">
                                                    @else
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div><hr>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" value="Save" class="btn btn-rounded btn-success" style="float: right;">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImg').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        var validator;
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
        }, "This field is required");
        $('#blog').validate({
            rules: {
                category_id: {
                    required : true,
                    valueNotEquals: "0",
                }, 
                post_title: {
                    required : true,
                }, 
                post_short_desc: {
                    required : true,
                }, 
                post_long_desc: {
                    required : true,
                }, 
            },
            messages :{
                category_id: {
                    required : 'Please Select Category',
                },
                post_title: {
                    required : 'Please Enter Name',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });  
</script>
@endsection
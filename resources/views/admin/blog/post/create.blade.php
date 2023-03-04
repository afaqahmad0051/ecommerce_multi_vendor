@extends('admin.admin_dashboard')
@section('title')
Blog
@endsection
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Blog</h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('blog.post.list') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
        </div>
    </div>
    <hr/>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="blog" action="{{ route('blog.post.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Category: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                <select class="single-select" name="category_id">
                                                    <option value="0">Select</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{$item->id}}">{{ $item->blog_category_name }}</option>
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
                                                <input type="text" class="form-control" name="post_title"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-8">
                                                <img class="rounded avatar-lg" id="showImg" src="{{url('upload/blank1.png')}}" style="float: right; heigt:100px; width:100px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Short Desc: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9 form-group">
                                                <textarea class="form-control" name="post_short_desc" id="inputProductDescription" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Long Desc: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9 form-group">
                                            </textarea><textarea id="mytextarea" name="post_long_desc"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Status: </label>
                                            <div class="col-sm-8">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status" checked="">
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
@extends('admin.admin_dashboard')
@section('title')
SEO
@endsection
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">SEO</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">SEO</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('seo.update',$seo->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Meta Title:</strong>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="meta_title" value="{{ $seo->meta_title }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Meta Author:</strong>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="meta_author" value="{{ $seo->meta_author }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Meta Keyword:</strong>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="meta_keyword" value="{{ $seo->meta_keyword }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Description:</strong>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="meta_descripiton">{{ $seo->meta_descripiton }}</textarea>
                                            </div>
                                        </div>
                                    </div><hr>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" value="Update" class="btn btn-rounded btn-info" style="float: right;">
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
@endsection
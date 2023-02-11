@extends('admin.admin_dashboard')
@section('title')
Profile
@endsection
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
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
                            <form action="{{ route('admin.profile.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Full Name: <span class="text-danger">*</span></strong>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" value="{{ $adminData->name }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Username: <span class="text-danger">*</span></strong>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="username" value="{{ $adminData->username }}" disabled/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Phone: <span class="text-danger">*</span></strong>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="phone" value="{{ $adminData->phone }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3">Address: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="address" rows="2">{!! $adminData->address !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Email: <span class="text-danger">*</span></strong>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" value="{{ $adminData->email }}" disabled/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Profile Picture: <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <img class="rounded avatar-lg" id="showImg" src="{{(!empty($adminData->photo))? url('upload/admin_images/'.$adminData->photo):url('upload/blank.jpg')}}" style="float: right; heigt:100px; width:100px;">
                                                <input class="form-control" type="file" name="photo" id="image" readonly style="margin-top: 7rem">
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
@extends('admin.admin_dashboard')
@section('title')
Site Info
@endsection
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Site Setting</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
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
                            <form action="{{ route('site.update',$setting->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Support Phone:</strong>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="support_phone" value="{{ $setting->support_phone }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Call Us:</strong>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cell_phone" value="{{ $setting->cell_phone }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Email:</strong>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" value="{{ $setting->email }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Facebook Link:</strong>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="facebook" value="{{ $setting->facebook }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Twitter Link:</strong>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="twitter" value="{{ $setting->twitter }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Instagram Link:</strong>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="instagram" value="{{ $setting->instagram }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-4">Logo:</strong>
                                            <div class="col-sm-8">
                                                <img class="rounded avatar-lg" id="showImg" src="{{ asset($setting->logo) }}" alt="No logo" style="float: right; heigt:100px; width:100px;">
                                                <input class="form-control" type="file" name="loho" id="image" readonly style="margin-top: 7rem">
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
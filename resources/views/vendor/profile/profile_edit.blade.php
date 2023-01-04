@extends('vendor.vendor_dashboard')
@section('vendor')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('vendor.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vendor Profile</li>
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
                            <form action="{{ route('vendor.profile.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Full Name: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" value="{{ $vendorData->name }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Username: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="username" value="{{ $vendorData->username }}" disabled/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Phone: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="phone" value="{{ $vendorData->phone }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3">Address: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="address" rows="2">{!! $vendorData->address !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3">Short Info: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="vendor_short_info" rows="2">{!! $vendorData->vendor_short_info !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Email: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" value="{{ $vendorData->email }}" disabled/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Joining: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="vendor_join" class="single-select">
                                                    <option disabled selected>Select</option>
                                                    <option value="2023" {{ $vendorData->vendor_join == 2023?'selected':'' }} >2023</option>
                                                    <option value="2024" {{ $vendorData->vendor_join == 2024?'selected':'' }}>2024</option>
                                                    <option value="2025" {{ $vendorData->vendor_join == 2025?'selected':'' }}>2025</option>
                                                    <option value="2026" {{ $vendorData->vendor_join == 2026?'selected':'' }}>2026</option>
                                                    <option value="2027" {{ $vendorData->vendor_join == 2027?'selected':'' }}>2027</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Profile Picture: <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <img class="rounded avatar-lg" id="showImg" src="{{(!empty($vendorData->photo))? url('upload/vendor_images/'.$vendorData->photo):url('upload/blank.jpg')}}" style="float: right; heigt:100px; width:100px;">
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
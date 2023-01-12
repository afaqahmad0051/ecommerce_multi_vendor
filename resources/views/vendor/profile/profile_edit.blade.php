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
                            <form id="profile" action="{{ route('vendor.profile.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Full Name: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9 form-group">
                                                <input type="text" class="form-control" required name="name" value="{{ $vendorData->name }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Username: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9 form-group">
                                                <input type="text" class="form-control" name="username" value="{{ $vendorData->username }}" disabled/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Phone: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9 form-group">
                                                <input type="text" class="form-control" required name="phone" value="{{ $vendorData->phone }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3">Address: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9 form-group">
                                                <textarea class="form-control" required name="address" rows="2">{!! $vendorData->address !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3">Short Info: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9 form-group">
                                                <textarea class="form-control" required name="vendor_short_info" rows="2">{!! $vendorData->vendor_short_info !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Email: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9 form-group">
                                                <input type="email" class="form-control" name="email" value="{{ $vendorData->email }}" disabled/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Established in: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9 form-group">
                                                <select name="year_id" class="single-select" name="year_id" required>
                                                    <option disabled selected>Select</option>
                                                    @foreach ($year as $item)
                                                        <option value="{{ $item->id }}" {{ $vendorData->year_id == $item->id?'selected':'' }} >{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Profile Picture: <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <img class="rounded avatar-lg" id="showImg" src="{{(!empty($vendorData->photo))? url('upload/vendor_images/'.$vendorData->photo):url('upload/blank.jpg')}}" style="float: right; heigt:100px; width:100px;">
                                                <input class="form-control" required type="file" name="photo" id="image" readonly style="margin-top: 7rem">
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
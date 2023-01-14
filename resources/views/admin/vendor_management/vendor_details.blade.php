@extends('admin.admin_dashboard')
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content"> 
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Vendor Details</h6>
        </div>
        <div class="col-md-6">
            @if ($details->status == 'inactive')
                <a href="{{ route('vendor.inactive') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
            @else
                <a href="{{ route('vendor.active') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
            @endif
        </div>
    </div>
    <hr/>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($details->status == 'inactive')
                                <form id="profile" action="{{ route('vendor.approve',$details->id) }}" method="post" enctype="multipart/form-data">
                            @else
                                <form id="profile" action="{{ route('vendor.deactivate',$details->id) }}" method="post" enctype="multipart/form-data">
                            @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Shop Name: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9 form-group">
                                                <input type="text" class="form-control" required name="name" value="{{ $details->name }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Vendor Name: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9 form-group">
                                                <input type="text" class="form-control" name="username" value="{{ $details->username }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Phone: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9 form-group">
                                                <input type="text" class="form-control" required name="phone" value="{{ $details->phone }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3">Address: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9 form-group">
                                                <textarea class="form-control" required name="address" rows="2" disabled>{!! $details->address !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3">Short Info: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9 form-group">
                                                <textarea class="form-control" required name="vendor_short_info" disabled rows="2">{!! $details->vendor_short_info !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3">Status: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9 form-group">
                                                <div class="form-check form-switch">
                                                    @if ($details->status == 'active')
                                                        <input class="form-check-input" disabled checked type="checkbox" id="flexSwitchCheckChecked" name="status">
                                                    @else
                                                        <input class="form-check-input" disabled type="checkbox" id="flexSwitchCheckChecked" name="status">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Email: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9 form-group">
                                                <input type="email" class="form-control" readonly name="email" value="{{ $details->email }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Joinig Date: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9 form-group">
                                                @php
                                                    $day_name = date('D', strtotime(trim(str_replace('/','-',$details->created_at))));
                                                    $date = date('d-m-Y', strtotime(trim(str_replace('/','-',$details->created_at))));
                                                    $time =  date('h:i A', strtotime(trim(str_replace('/','-',$details->created_at))));
                                                @endphp
                                                <input type="text" readonly class="form-control" name="email" value="{{ $date }} {{ $day_name }} {{ $time }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Profile Picture: <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <img class="rounded avatar-lg" id="showImg" src="{{(!empty($details->photo))? url('upload/vendor_images/'.$details->photo):url('upload/blank.jpg')}}" style="float: right; heigt:100px; width:100px;">
                                            </div>
                                        </div>
                                    </div><hr>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        @if ($details->status == 'inactive')
                                            <input type="submit" value="Activate Vendor" class="btn btn-rounded btn-success" style="float: right;">
                                        @else
                                            <input type="submit" value="Deactivate Vendor" class="btn btn-rounded btn-danger" style="float: right;">
                                        @endif
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
@endsection
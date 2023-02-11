@extends('vendor.vendor_dashboard')
@section('title')
Password
@endsection
@section('vendor')
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Password</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('vendor.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
                            @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger alert-dismissible fade show">{{ $error }}</p>
                                @endforeach
                            @endif
                            <form action="{{ route('vendor.update.password') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Current Password: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="oldpassword" id="oldpassword"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">New Password: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="newpassword" id="newpassword"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 form-label">Confirm Password: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="confirm_password" id="confirm_password"/>
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
@endsection
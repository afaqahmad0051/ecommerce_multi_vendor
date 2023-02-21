@extends('user.main_dashboard')
@section('title')
    Profile
@endsection
@section('main')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Profile
            </div>
        </div>
    </div>
    <div class="page-content pt-75 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">

                        @include('user.account.menu.menu')
                        
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                                <h5>Change Password</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if (count($errors))
                                                @foreach ($errors->all() as $error)
                                                    <p class="alert alert-danger alert-dismissible fade show">{{ $error }}</p>
                                                @endforeach
                                            @endif
                                            <form method="post" action="{{route('user.password.update')}}">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Password: <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="oldpassword" id="oldpassword" type="password" placeholder="Old Password"/>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>New Password: <span class="required">*</span></label>
                                                        <input required="" class="form-control" type="password" name="newpassword" id="newpassword" placeholder="New Password"/>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Confirm Password: <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="confirm_password" type="password" id="confirm_password" placeholder="Confirm New Password"/>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
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
            </div>
        </div>
    </div>
</main>
@endsection
@extends('user.main_dashboard')
@section('title')
    My Account
@endsection
@section('main')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> My Account
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
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <h3 class="mb-0">Hello {{auth()->user()->name}}!</h3>
                                                </div>
                                                <div class="form-group col-md-6" >
                                                    <label></label>
                                                    <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo):url('upload/blank.jpg') }}" alt="user" class="rounded-circle p-1" id="showImg" width="110">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br />
                                                manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                            </p>
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
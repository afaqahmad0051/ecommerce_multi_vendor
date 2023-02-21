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
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <h5>Account Details</h5>
                                                </div>
                                                <div class="form-group col-md-6" >
                                                    <label></label>
                                                    <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo):url('upload/blank.jpg') }}" alt="user" class="rounded-circle p-1" id="showImg" width="110">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>UserName: <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="username" value="{{ $userData->username }}" type="text" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Name: <span class="required">*</span></label>
                                                        <input required="" class="form-control" type="text" name="name" value="{{ $userData->name }}"/>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email: <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="email" type="email" value="{{ $userData->email }}"/>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Phone: <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="phone" type="text" value="{{ $userData->phone }}"/>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Address: <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="address" type="text" value="{{$userData->address }}" />
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Photo: <span class="required">*</span></label>
                                                        <input class="form-control" name="photo" type="file" id="image"/>
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
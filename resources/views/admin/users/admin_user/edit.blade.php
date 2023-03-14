@extends('admin.admin_dashboard')
@section('title')
Admin Profile
@endsection
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="row">
        <div class="col-md-6">
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
        </div>
        <div class="col-sm-6">
            @php
                $next = App\Models\User::where('role','admin')->where('id', '>', $user->id)->min('id');
                $previous = App\Models\User::where('role','admin')->where('id', '<', $user->id)->max('id');
            @endphp
            <div class="row">
                <div class="col-md-10">
                    <div class="btn-group" role="group" style="float: right;">
                        <a href="{{ (isset($previous))?$previous:'javascript:;' }}" class="btn btn-secondary btn-sm"><i class="bx bx-caret-left-circle"></i></a>
                        <a href="{{ (isset($next))?$next:'javascript:;' }}" class="btn btn-secondary btn-sm"><i class="bx bx-caret-right-circle"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('sub_category.list') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="admin" action="{{ route('user.admin.update',$user->id) }}" method="post" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Full Name: <span class="text-danger">*</span></strong>  
                                            <div class="col-sm-9 form-group">
                                                <input type="text" class="form-control" name="name" value="{{ $user->name }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Username: <span class="text-danger">*</span></strong>  
                                            <div class="col-sm-9 form-group">
                                                <input type="text" class="form-control" name="username" value="{{ $user->username }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Phone: <span class="text-danger">*</span></strong>  
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3">Address: <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="address" rows="2">{{ $user->address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Email: <span class="text-danger">*</span></strong>
                                            <div class="col-sm-9 form-group">
                                                <input type="email" class="form-control" name="email" value="{{ $user->email }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Password: <span class="text-danger">*</span></strong>
                                            <div class="col-sm-9 form-group">
                                                <input type="password" class="form-control" name="password" value="{{ $user->password }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <strong class="col-sm-3 form-label">Roles:  <span class="text-danger">*</span></strong>
                                            <div class="col-sm-9 form-group">
                                                <select class="single-select" name="role_id">
                                                    <option value="0">Select</option>
                                                    @foreach ($roles as $item)
                                                        <option value="{{$item->id}}"{{ $user->hasRole($item->name) ?'selected':'' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div><hr>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" value="save" class="btn btn-rounded btn-success" style="float: right;">
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
<script type="text/javascript">
    $(document).ready(function (){
        var validator;
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
        }, "This field is required");
        $('#admin').validate({
            rules: {
                role_id: {
                    required : true,
                    valueNotEquals: "0",
                }, 
                name: {
                    required : true,
                }, 
                username: {
                    required : true,
                }, 
                email: {
                    required : true,
                }, 
                password: {
                    required : true,
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });  
</script>
@endsection
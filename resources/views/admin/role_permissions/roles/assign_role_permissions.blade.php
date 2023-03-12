@extends('admin.admin_dashboard')
@section('title')
Assign Roles
@endsection
@php
    $roles = isset($data['roles'])?$data['roles']:'';
    $permissions = isset($data['permissions'])?$data['permissions']:'';
    $permission_groups = isset($data['permission_groups'])?$data['permission_groups']:'';
    // dd($permission_groups->toArray());;
    $users = App\Models\User::where('role','admin')->where('status','active')->latest()->get();
@endphp
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Assign Roles</h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('permission.role.list') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
        </div>
    </div>
    <hr/>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="roles" action="{{ route('permission.role.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-label">Roles: </label>  
                                                    <div class="col-sm-8 form-group">
                                                        <select class="single-select" name="role_id">
                                                            <option value="0">Select</option>
                                                            @foreach ($roles as $item)
                                                                <option value="{{$item->id}}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-label">User: </label>  
                                                    <div class="col-sm-8 form-group">
                                                        <select class="single-select" name="role_id">
                                                            <option value="0">Select</option>
                                                            @foreach ($users as $item)
                                                                <option value="{{$item->id}}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <hr>
                                        @foreach ($permission_groups as $items)
                                            {{-- @dump($key); --}}
                                            {{-- @dump($items); --}}
                                            @foreach ($items as $item)
                                                {{-- @dump($item); --}}
                                                @php
                                                    $group = App\Models\PermissionGroup::where('id',$item)->first();
                                                    // dd($group->toArray());
                                                @endphp
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="chechbox" value="" id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault">{{$group->name}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-9 form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="chechbox" value="" id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault">Default</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div><hr>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" value="Save" class="btn btn-rounded btn-success" style="float: right;">
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
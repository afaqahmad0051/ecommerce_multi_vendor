@extends('admin.admin_dashboard')
@section('title')
Assign Roles
@endsection
@php
    $role = isset($data['role'])?$data['role']:'';
    $perms = isset($data['perms'])?$data['perms']:'';
    $permission_group = isset($data['permission_group'])?$data['permission_group']:'';
    // dd($permission_group->toArray());;
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
            <a href="{{ route('permission.assign.list') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
        </div>
    </div>
    <hr/>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="roles" action="{{ route('permission.assign.update',$role->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-label">Roles: </label>  
                                                    <div class="col-sm-8 form-group">
                                                        <select class="single-select" name="role_id" disabled>
                                                            <option value="{{$role->id}}" selected>{{ $role->name }}</option>
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
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckAll">
                                            <label class="form-check-label" for="flexCheckAll">All Permissions</label>
                                        </div>
                                        <hr>
                                        @foreach ($permission_group as $items)
                                            {{-- @dump($key); --}}
                                            {{-- @dump($items); --}}
                                            @php
                                            $perms = App\Models\User::getpermissionByGroupName($items->group_id);
                                            // dd($perms);
                                            @endphp
                                            @foreach ($items as $item)
                                                {{-- @dump($item); --}}
                                                @php
                                                    $group = App\Models\PermissionGroup::where('id',$item)->first();
                                                    // dd($group->toArray());
                                                @endphp
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"{{ App\Models\User::rolehasPermissions($role, $perms)?'checked':'' }} >
                                                            <label class="form-check-label" for="flexCheckDefault">{{$group->name}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-9 form-group">
                                                        @foreach ($perms as $perm)
                                                            <div class="form-check">
                                                                <input class="form-check-input" name="permission[]" {{ $role->hasPermissionTo($perm->name)?'checked':'' }} type="checkbox" value="{{ $perm->id }}" id="flexCheck{{ $perm->id }}">
                                                                <label class="form-check-label" for="flexCheck{{ $perm->id }}">{{ $perm->name }}</label>
                                                            </div>
                                                        @endforeach
                                                        <br>
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
<script>
    $('#flexCheckAll').click(function() {
        if ($(this).is(':checked')) {
            $('input[type = checkbox]').prop('checked',true);
        }else{
            $('input[type = checkbox]').prop('checked',false);
        }
    })
</script>
@endsection
@extends('admin.admin_dashboard')
@section('title')
Admins
@endsection
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Admins</h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('user.admin.create') }}" class="btn btn-success btn-sm" style="float: right;">Create</a>
        </div>
    </div>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $key => $item)                            
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img class="rounded avatar-lg" src="{{(!empty($item->photo))? url('upload/admin_images/'.$item->photo):url('upload/blank.jpg')}}" style="heigt:70px; width:70px;">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address }}</td>
                                <td>
                                    @foreach ($item->roles as $role)
                                        <span class="badge badge-pill bg-info">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($item->userOnline())
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">{{ isset($item->last_seen)?Carbon\Carbon::parse( $item->last_seen)->diffForHumans():'A long time ago' }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.admin.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('user.admin.delete',$item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sr.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
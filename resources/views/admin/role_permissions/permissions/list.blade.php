@extends('admin.admin_dashboard')
@section('title')
Permissions
@endsection
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Permissions</h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('permission.create') }}" class="btn btn-success btn-sm" style="float: right;">Create</a>
        </div>
    </div>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="10%">Sr.</th>
                            <th width="30%">Permission</th>
                            <th width="30%">Group</th>
                            <th width="5%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $item)                            
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->group_name }}</td>
                                <td>
                                    <a href="{{ route('permission.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('permission.delete',$item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="10%">Sr.</th>
                            <th width="30%">Permission</th>
                            <th width="30%">Group</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
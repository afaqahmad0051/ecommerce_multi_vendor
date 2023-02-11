@extends('admin.admin_dashboard')
@section('title')
    Banner
@endsection
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Banner</h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('banner.create') }}" class="btn btn-success btn-sm" style="float: right;">Create</a>
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
                            <th width="30%">Title</th>
                            <th width="30%">Short Title</th>
                            <th width="30%">Image</th>
                            <th width="10%">Status</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banner as $key => $item)                            
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->banner_title }}</td>
                                <td>{{ $item->banner_url }}</td>
                                <td>
                                    <img src="{{ asset($item->banner_image) }}" style="width: 70px; height: 40px;">
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('banner.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('banner.delete',$item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sr.</th>
                            <th>Name</th>
                            <th>Image</th>
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
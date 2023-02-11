@extends('admin.admin_dashboard')
@section('title')
Sub Category
@endsection
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Sub Category</h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('sub_category.create') }}" class="btn btn-success btn-sm" style="float: right;">Create</a>
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
                            <th>Category Name</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sub_category as $key => $item)                            
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->category->category_name }}</td>
                                <td>{{ $item->subcategory_name }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('sub_category.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('sub_category.delete',$item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sr.</th>
                            <th>Category Name</th>
                            <th>Name</th>
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
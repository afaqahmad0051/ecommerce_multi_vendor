@extends('admin.admin_dashboard')
@section('title')
Blog
@endsection
@php
    $posts = isset($data['post'])?$data['post']:'';
@endphp
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Blog</h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('blog.post.create') }}" class="btn btn-success btn-sm" style="float: right;">Create</a>
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
                            <th width="30%">Category</th>
                            <th width="30%">Image</th>
                            <th width="10%">Title</th>
                            <th width="10%">Status</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $key => $item)                            
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->category->blog_category_name }}</td>
                                <td>
                                    <img src="{{ asset($item->post_image) }}" style="width: 70px; height: 40px;">
                                </td>
                                <td>{{ $item->post_title }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('blog.post.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('blog.post.delete',$item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="10%">Sr.</th>
                            <th width="30%">Category</th>
                            <th width="30%">Image</th>
                            <th width="10%">Title</th>
                            <th width="10%">Status</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
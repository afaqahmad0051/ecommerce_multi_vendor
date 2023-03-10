@extends('admin.admin_dashboard')
@section('title')
    Published Reviews
@endsection
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Published Reviews</h6>
        </div>
        <div class="col-md-6">
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
                            <th>Product</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th style="text-align: center;">Comment</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $key => $item)
                            @php
                            //Created Time
                            $cr_day_name = date('D', strtotime(trim(str_replace('/','-',$item->updated_at))));
                            $cr_date = date('d-m-Y', strtotime(trim(str_replace('/','-',$item->updated_at))));
                            $cr_time =  date('h:i A', strtotime(trim(str_replace('/','-',$item->updated_at))));
                            @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img src="{{ asset($item->product->product_thumbnail) }}" style="width: 40px; height:40px;">
                                </td>
                                <td>{{ $item->product->product_name }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    @if ($item->rating == null)
                                    @elseif($item->rating == 1)
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                    @elseif($item->rating == 2)
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                    @elseif($item->rating == 3)
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                    @elseif($item->rating == 4)
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                    @elseif($item->rating == 5)
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                    @endif
                                </td>
                                <td>{{ $item->comment }}</td>
                                <td>{{ $cr_date }} {{ $cr_time }}</td>
                                <td>
                                <span class="badge bg-success">Published</span>
                                </td>
                                <td>
                                    <a href="{{ route('review.delete',$item->id) }}" id="delete" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sr.</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th style="text-align: center;">Comment</th>
                            <th>Date</th>
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
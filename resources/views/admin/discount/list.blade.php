@extends('admin.admin_dashboard')
@section('title')
    Coupon
@endsection
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Coupon</h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('coupon.create') }}" class="btn btn-success btn-sm" style="float: right;">Create</a>
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
                            <th width="30%">Coupon Code</th>
                            <th width="30%">Coupon Discount</th>
                            <th width="30%">Expiry</th>
                            <th width="10%">Status</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupon as $key => $item)      
                            @php
                            //Created Time
                            $cr_day_name = date('D', strtotime(trim(str_replace('/','-',$item->coupon_validity))));
                            $cr_date = date('d-m-Y', strtotime(trim(str_replace('/','-',$item->coupon_validity))));
                            $cr_time =  date('h:i A', strtotime(trim(str_replace('/','-',$item->coupon_validity))));
                            @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->coupon_name }}</td>
                                <td>{{ $item->coupon_discount }}%</td>
                                <td>{{ $cr_day_name }}, {{ $cr_date }}</td>
                                <td>
                                    @if ($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                        @if ($item->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                        @endif
                                        <span class="badge rounded-pill bg-success">Valid</span>
                                    @else
                                        @if ($item->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                        @endif
                                        <span class="badge rounded-pill bg-danger">Expired</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('coupon.edit',$item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('coupon.delete',$item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="10%">Sr.</th>
                            <th width="30%">Coupon Code</th>
                            <th width="30%">Coupon Code</th>
                            <th width="30%">Expiry</th>
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
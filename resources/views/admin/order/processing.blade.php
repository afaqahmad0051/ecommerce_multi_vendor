@extends('admin.admin_dashboard')
@section('title')
Processing Orders
@endsection
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Processing Orders</h6>
        </div>
        {{-- <div class="col-md-6">
            <a href="{{ route('category.create') }}" class="btn btn-success btn-sm" style="float: right;">Create</a>
        </div> --}}
    </div>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="10%">Sr.</th>
                            <th width="30%">Order Date</th>
                            <th width="30%">Invoice</th>
                            <th width="10%">Amount</th>
                            <th width="10%">Payment</th>
                            <th width="10%">Status</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $item)                            
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->order_date }}</td>
                                <td>{{ $item->invoice_no }}</td>
                                <td>£{{ $item->amount }}</td>
                                <td>{{ $item->payment_method }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-info">Processing</span>
                                </td>
                                <td>
                                    <a href="{{ route('order.details',$item->id) }}" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('order.invoice',$item->id) }}" class="btn btn-danger" title="Invoice"><i class="fa fa-download"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="10%">Sr.</th>
                            <th width="30%">Order Date</th>
                            <th width="30%">Invoice</th>
                            <th width="10%">Amount</th>
                            <th width="10%">Payment</th>
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
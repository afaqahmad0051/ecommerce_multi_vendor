@extends('admin.admin_dashboard')
@section('title')
Yearwise Report
@endsection
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Yearwise Report</h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('report.view') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
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
                                    @if ($item->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                    @elseif($item->status == 'confirm')
                                        <span class="badge bg-info">Confirm</span>
                                    @elseif($item->status == 'processing')
                                        <span class="badge bg-primary">Processing</span>
                                    @elseif($item->status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif($item->status == 'cancel')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                    @if ($item->return_order == 1)
                                        <span class="badge bg-warning">Return Requested</span>
                                    @elseif ($item->return_order == 2)
                                        <span class="badge bg-danger">Returned</span>
                                    @endif
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
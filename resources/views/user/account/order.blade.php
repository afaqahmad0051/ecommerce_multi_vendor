@extends('user.main_dashboard')
@section('title')
    Orders
@endsection
@section('main')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Your Orders
            </div>
        </div>
    </div>
    <div class="page-content pt-75 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row">
                        
                        @include('user.account.menu.menu')

                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table" style="background: #ddd; font-weight:600;">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr</th>
                                                            <th>Date</th>
                                                            <th>Total</th>
                                                            <th>Payment Through</th>
                                                            <th>Invoice</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $key => $item)
                                                            <tr>
                                                                <td>{{ $key+1 }}</td>
                                                                <td>{{ $item->order_date }}</td>
                                                                <td>£ {{ $item->amount }}</td>
                                                                <td>{{ strtoupper($item->payment_method) }} </td>
                                                                <td>{{ $item->invoice_no }}</td>
                                                                <td>
                                                                    @if ($item->status == 'pending')
                                                                        <span class="badge rounded-pill bg-warning">Pending</span>
                                                                    @elseif($item->status == 'confirm')
                                                                        <span class="badge rounded-pill bg-info">Confirm</span>
                                                                    @elseif($item->status == 'processing')
                                                                        <span class="badge rounded-pill bg-primary">Processing</span>
                                                                    @elseif($item->status == 'delivered')
                                                                        <span class="badge rounded-pill bg-success">Delivered</span>
                                                                    @elseif($item->status == 'cancel')
                                                                        <span class="badge rounded-pill bg-danger">Cancelled</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('user.order.view',$item->id) }}" class="btn-sm btn-success"><i class="fa fa-eye"></i> View</a>
                                                                    <a href="#" class="btn-sm btn-danger"><i class="fa fa-download"></i> Invoice</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@extends('user.main_dashboard')
@section('title')
    Return Orders
@endsection
@section('main')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Return Orders
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
                                                            {{-- <th>Payment Through</th> --}}
                                                            <th>Invoice</th>
                                                            <th>Return Reason</th>
                                                            <th>Return Date</th>
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
                                                                {{-- <td>{{ strtoupper($item->payment_method) }} </td> --}}
                                                                <td>{{ $item->invoice_no }}</td>
                                                                <td>{{ $item->return_reason }}</td>
                                                                <td>{{ $item->return_date }}</td>
                                                                <td>
                                                                    @if ($item->return_order == 1)
                                                                        <span class="badge rounded-pill bg-danger">Return Pending</span>
                                                                    @elseif ($item->return_order == 2)
                                                                        <span class="badge rounded-pill bg-success">Returned Accepted</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('user.order.view',$item->id) }}" class="btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                                                    <a href="{{ route('user.order.pdf',$item->id) }}" class="btn-sm btn-danger"><i class="fa fa-download"></i></a>
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
@extends('vendor.vendor_dashboard')
@php
    $order = isset($data['order'])?$data['order']:'';
    $order_item = isset($data['order_item'])?$data['order_item']:'';
@endphp
@section('title')
Order Detail
@endsection
@section('vendor')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Order Details</h6>
        </div>
        {{-- <div class="col-md-6">
            <a href="{{ route('category.create') }}" class="btn btn-success btn-sm" style="float: right;">Create</a>
        </div> --}}
    </div>
    <hr/>
    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Shipping Details</h4>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table" style="font-weight:600;">
                        <tr>
                            <th>Shipping Name: </th>
                            <td>{{ $order->name }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Phone: </th>
                            <td>{{ $order->phone }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Email: </th>
                            <td>{{ $order->email }}</td>
                        </tr>
                        <tr>
                            <th>Country: </th>
                            <td>{{ $order->country->country_name }}</td>
                        </tr>
                        <tr>
                            <th>City: </th>
                            <td>{{ $order->city->city_name }}</td>
                        </tr>
                        <tr>
                            <th>Area: </th>
                            <td>{{ $order->area->area_name }}</td>
                        </tr>
                        <tr>
                            <th>Post Code: </th>
                            <td>{{ $order->post_code }}</td>
                        </tr>
                        <tr>
                            <th>Order Date: </th>
                            <td>{{ $order->order_date }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Order Details</h4>
                    <span class="text-danger">Invoice: <strong>{{ $order->invoice_no }}</strong></span>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table" style="font-weight:600;">
                        <tr>
                            <th>Name: </th>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone: </th>
                            <td>{{ isset($order->user->phone)?$order->user->phone:'' }}</td>
                        </tr>
                        <tr>
                            <th>Payment Type: </th>
                            <td>{{ strtoupper($order->payment_method) }}</td>
                        </tr>
                        @if ($order->transaction_id != 0)
                            <tr>
                                <th>Transaction ID: </th>
                                <td>{{ $order->transaction_id }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Invoice: </th>
                            <td>{{ $order->invoice_no }}</td>
                        </tr>
                        <tr>
                            <th>Total Amount: </th>
                            <td>£{{ $order->amount }}</td>
                        </tr>
                        <tr>
                            <th>Status: </th>
                            <td>
                                @if ($order->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                                @elseif($order->status == 'confirm')
                                    <span class="badge bg-info">Confirm</span>
                                @elseif($order->status == 'processing')
                                    <span class="badge bg-primary">Processing</span>
                                @elseif($order->status == 'delivered')
                                    <span class="badge bg-success">Delivered</span>
                                @elseif($order->status == 'cancel')
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <table class="table" style="font-weight: 600;">
                        <tbody>
                            <tr>
                                <td class="col-md-1">
                                    <label>Image</label>
                                </td>
                                <td class="col-md-2">
                                    <label>Product Name</label>
                                </td>
                                <td class="col-md-2">
                                    <label>Vendor Name</label>
                                </td>
                                <td class="col-md-2">
                                    <label>Product Code</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Color</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Size</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Quantity</label>
                                </td>
                                <td class="col-md-2">
                                    <label>Price</label>
                                </td>
                            </tr>
                            @foreach ($order_item as $item)
                                <tr>
                                    <td class="col-md-1">
                                        <label><img src="{{ asset($item->product->product_thumbnail) }}" style="height: 50px; width:50px;"></label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>{{ $item->product->product_name }}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>{{ isset($item->product->vendor->name)?$item->product->vendor->name:'' }}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>{{ $item->product->product_code }}</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>{{ isset($item->color)?$item->color:'...' }}</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>{{ isset($item->size)?$item->size:'...' }}</label>
                                    </td>
                                    <td class="col-md-1">
                                        <label>{{ $item->qty }}</label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>£{{ $item->price }}<br>Total=£{{ $item->price * $item->qty }}</label>
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
@endsection
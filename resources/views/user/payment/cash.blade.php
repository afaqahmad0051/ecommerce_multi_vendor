@extends('user.main_dashboard')
@php
    $carts = isset($data['carts'])?$data['carts']:'';
    $cart_qty = isset($data['cart_qty'])?$data['cart_qty']:'';
    $cart_total = isset($data['cart_total'])?$data['cart_total']:'';
    $countries = isset($data['countries'])?$data['countries']:'';
@endphp
@section('title')
Cash Payment
@endsection
@section('main')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> 
            <span></span> Cash Payment
        </div>
    </div>
</div>
<div class="container mb-80 mt-50">
    <div class="row">
        <div class="col-lg-8 mb-40">
            <h3 class="heading-2 mb-10">Cash Payment</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="border p-40 cart-totals ml-30 mb-50">
                <div class="d-flex align-items-end justify-content-between mb-30">
                    <h4>Order Details</h4>
                </div>
                <div class="divider-2 mb-30"></div>
                <div class="table-responsive order_table checkout">
                    <table class="table no-border">
                        <tbody>
                            @if (Session::has('coupon'))
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Subtotal</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">£{{ $cart_total }}</h4>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Coupn Name</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h6 class="text-brand text-end">{{ session()->get('coupon')['coupon_name'] }} {{ session()->get('coupon')['coupon_discount'] }}%</h6>
                                    </td>
                                </tr>
    
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Coupon Discount</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">£{{ session()->get('coupon')['discount_amount'] }}</h4>
                                    </td>
                                </tr>
    
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Grand Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">£{{ session()->get('coupon')['total_amount'] }}</h4>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Grand Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">£{{ $cart_total }}</h4>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive order_table checkout">
                    <form action="{{ route('cash.order') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                            <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                            <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                            <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                            <input type="hidden" name="area_id" value="{{ $data['area_id'] }}">
                            <input type="hidden" name="address" value="{{ $data['shipping_address'] }}">
                            <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                            <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                            </div>
                        
                            <!-- Used to display Element errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <br>
                        <button style="float: right;" class="btn btn-success">Submit Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
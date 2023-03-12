@extends('user.main_dashboard')
@section('title')
    Order Tracking
@endsection
@section('main')
<style>
    body{
        font-family: 'Open Sans',serif
        }
        .card{
            position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 0.10rem
        }
        .card-header:first-child{
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }
        .card-header{
            padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #fff;border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }
        .track{
            position: relative;background-color: #ddd;height: 7px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-bottom: 60px;margin-top: 50px
        }
        .track .step{
            -webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -18px;text-align: center;position: relative
        }
        .track .step.active:before{
            background: #3BB77E
        }
        .track .step::before{
            height: 7px;position: absolute;content: "";width: 100%;left: 0;top: 18px
        }
        .track .step.active .icon{
            background: #3BB77E;color: #fff
        }
        .track .icon{
            display: inline-block;width: 40px;height: 40px;line-height: 40px;position: relative;border-radius: 100%;background: #ddd
        }
        .track .step.active .text{
            font-weight: 400;color: #000
        }
        .track .text{
            display: block;margin-top: 7px
        }
        .itemside{
            position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100%
        }
        .itemside .aside{
            position: relative;-ms-flex-negative: 0;flex-shrink: 0
        }
        .img-sm{
            width: 80px;height: 80px;padding: 7px
        }
        ul.row, ul.row-sm{
            list-style: none;padding: 0
        }
        .itemside .info{
            padding-left: 15px;padding-right: 7px
        }
        .itemside .title{
            display: block;margin-bottom: 5px;color: #212529
        }
        p{
            margin-top: 0;margin-bottom: 1rem
        }
        .btn-warning{
            color: #ffffff;background-color: #3BB77E;border-color: #3BB77E;border-radius: 1px
        }
        .btn-warning:hover{
            color: #ffffff;background-color: #3BB77E;border-color: #3BB77E;border-radius: 1px
        }
</style>
@php
    $setting = App\Models\SiteSetting::find(1);
@endphp
<div class="container">
    <article class="card">
        <header class="card-header"> My Orders / Tracking </header>
        <div class="card-body">
            <h6>Order ID: {{ $track->invoice_no }}</h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Order Date:</strong> <br>{{ $track->order_date }} </div>
                    <div class="col"> <strong>Shipping BY:</strong> <br> NEST, | <i class="fa fa-phone"></i> {{$setting->cell_phone}} </div>
                    <div class="col"> <strong>Payment Method:</strong> <br> {{ $track->payment_method }} </div>
                    <div class="col"> <strong>Status:</strong> <br> {{ $track->status }} </div>
                    <div class="col"> <strong>Amount:</strong> <br> £{{ number_format($track->amount, 2, '.', ',') }} </div>
                </div>
            </article>
            <div class="track">
                @if ($track->status == 'pending')
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order pending</span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Picked | On the way </span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                @elseif ($track->status == 'confirm')
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order pending</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Picked | On the way </span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                @elseif ($track->status == 'processing')
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order pending</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Picked | On the way </span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                @elseif ($track->status == 'delivered')
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order pending</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Picked | On the way </span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                @endif
            </div>
            <hr>
            <ul class="row">
                @php
                    $order_products = App\Models\OrderItem::where('order_id',$track->id)->latest()->get();
                @endphp
                @foreach ($order_products as $pro)
                    @php
                        $order_pros = App\Models\Product::where('id',$pro->product_id)->latest()->get();
                        // dd($order_pros->toArray());
                    @endphp
                    @foreach ($order_pros as $item)
                        <li class="col-md-4">
                            <figure class="itemside mb-3">
                                <div class="aside"><img src="{{ asset($item->product_thumbnail) }}" class="img-sm border"></div>
                                <figcaption class="info align-self-center">
                                    <p class="title">{{ $item->product_name }}</p> <span class="text-muted">£{{isset($item->discount_price)?number_format($item->discount_price, 2, '.', ','):number_format($item->selling_price, 2, '.', ',') }}</span>
                                </figcaption>
                            </figure>
                        </li>
                    @endforeach
                @endforeach
            </ul>
            <hr>
            <a href="{{ route('user.account.orders') }}" class="btn btn-warning btn-sm btn-rounded" style="float: right;" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
        </div>
    </article>
</div>
@endsection
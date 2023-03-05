<html class="js sizes websockets customelements history postmessage webworkers picture pointerevents webanimations webgl srcset flexbox cssanimations csscolumns csscolumns-width csscolumns-span csscolumns-fill csscolumns-gap csscolumns-rule csscolumns-rulecolor csscolumns-rulestyle csscolumns-rulewidth csscolumns-breakbefore csscolumns-breakafter csscolumns-breakinside" lang="en"><head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('user/assets/imgs/theme/favicon.svg')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/main.css?v=5.6')}}">
</head>

<body cz-shortcut-listen="true">
    @php
        $order = isset($data['order'])?$data['order']:'';
        $order_item = isset($data['order_item'])?$data['order_item']:'';
    @endphp
    <div class="invoice invoice-content invoice-1">
        <div class="back-top-home hover-up mt-30 ml-30">
            <a class="hover-up" href="{{ url('/') }}"><i class="fi-rs-home mr-5"></i> Homepage</a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner">
                        <div class="invoice-info" id="invoice_wrapper">
                            <div class="invoice-header">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="invoice-name">
                                            <div class="logo">
                                                <a href="{{ url('/') }}"><img src="{{asset('user/assets/imgs/theme/logo-light.svg')}}" alt="logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="invoice-numb">
                                            <h6 class="text-end mb-10 mt-20">Order Date: {{ $order->order_date }}</h6>
                                            <h6 class="text-end invoice-header-1">Invoice No: {{ $order->invoice_no }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-top">
                                <div class="row">
                                    <div class="col-lg-9 col-md-6">
                                        <div class="invoice-number">
                                            <h4 class="invoice-title-1 mb-10">Invoice To</h4>
                                            <p class="invoice-addr-1">
                                                <strong>{{ $order->name }}</strong> <br>
                                                {{ $order->email }} <br>
                                                {{ $order->phone }} <br>
                                                {{ $order->address }}, {{ $order->post_code }} <br>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="invoice-number">
                                            <h4 class="invoice-title-1 mb-10">Bill To</h4>
                                            <p class="invoice-addr-1">
                                                <strong>NestMart Inc</strong> <br>
                                                billing@NestMart.com <br>
                                                205 North Michigan Avenue, <br>Suite 810 Chicago, 60601, USA
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-9 col-md-6">
                                        <h4 class="invoice-title-1 mb-10">Print Date:</h4>
                                        <p class="invoice-from-1">{{ Carbon\Carbon::now()->format('d F Y') }}</p>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <h4 class="invoice-title-1 mb-10">Payment Method</h4>
                                        <p class="invoice-from-1">Via {{ ucwords($order->payment_method) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-center">
                                <div class="table-responsive">
                                    <table class="table table-striped invoice-table">
                                        <thead class="bg-active">
                                            <tr>
                                                <th>Image</th>
                                                <th>Item name</th>
                                                <th class="text-center">Unit Price</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $subtotal = 0;
                                            @endphp
                                            @foreach ($order_item as $item)
                                                @php
                                                    $amt = $item->qty * $item->price;
                                                    $subtotal += $amt;
                                                @endphp
                                                <tr>
                                                    <td class="item-desc-1">
                                                        <img src="{{ asset($item->product->product_thumbnail) }}" height="60px;" width="60px;" alt="">
                                                    </td>
                                                    <td>
                                                        <div class="item-desc-1">
                                                            <span>{{ $item->product->product_name }}</span>
                                                            <small>SKU: {{ $item->product->product_code }}</small>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">£{{ $item->price }}</td>
                                                    <td class="text-center">{{ $item->qty }}</td>
                                                    <td class="text-right">£{{ $item->qty * $item->price }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" class="text-end f-w-600">SubTotal:</td>
                                                <td class="text-right">£{{ number_format($subtotal, 2, '.', ',') }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end f-w-600">Discount:</td>
                                                <td class="text-right">£{{ number_format($subtotal - $order->amount, 2, '.', ',') }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end f-w-600">Grand Total:</td>
                                                <td class="text-right f-w-600">£{{ number_format($order->amount, 2, '.', ',') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-bottom">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <h3 class="invoice-title-1">Important Note</h3>
                                            <ul class="important-notes-list-1">
                                                <li>All amounts shown on this invoice are in pound sterling</li>
                                                <li>Finance charge of 1.5% will be made on unpaid balances after 30 days.</li>
                                                <li>Once can be refund or replace with in 30 days.</li>
                                                <li>Delivery might delay due to some external dependency</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-offsite">
                                        <div class="text-end">
                                            <p class="mb-0 text-13">Thank you for your business</p>
                                            <div class="mobile-social-icon mt-50 print-hide">
                                                <h6>Follow Us</h6>
                                                <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt=""></a>
                                                <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-twitter-white.svg')}}" alt=""></a>
                                                <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-instagram-white.svg')}}" alt=""></a>
                                                <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-pinterest-white.svg')}}" alt=""></a>
                                                <a href="#"><img src="{{asset('user/assets/imgs/theme/icons/icon-youtube-white.svg')}}" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-btn-section clearfix d-print-none">
                            <a href="javascript:window.print()" class="btn btn-lg btn-custom btn-print hover-up"> <img src="{{asset('user/assets/imgs/theme/icons/icon-print.svg')}}" alt=""> Print </a>
                            <a id="invoice_download_btn" class="btn btn-lg btn-custom btn-download hover-up"> <img src="{{asset('user/assets/imgs/theme/icons/icon-download.svg')}}" alt=""> Download </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{asset('user/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('user/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <!-- Invoice JS -->
    <script src="{{asset('user/assets/js/invoice/jspdf.min.js')}}"></script>
    <script src="{{asset('user/assets/js/invoice/invoice.js')}}"></script>

</body></html>
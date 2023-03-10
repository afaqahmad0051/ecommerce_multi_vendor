@extends('admin.admin_dashboard')
@section('title')
    Admin - Dashboard
@endsection
@php
  $orders = App\Models\Order::where('status','pending')->latest()->limit(10)->get();
  $pending_count = App\Models\Order::where('status','pending')->count();
  $pending_amt = App\Models\Order::where('status','pending')->sum('amount');
  
  $date = date('d F Y');
  $today_count = App\Models\Order::where('order_date',$date)->count();
  $today_amount = App\Models\Order::where('order_date',$date)->sum('amount');
  
  $week_order = App\Models\Order::whereBetween('created_at',[Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->count();
  $week_amount = App\Models\Order::whereBetween('created_at',[Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->sum('amount');
  
  $month = date('F');
  $month_order = App\Models\Order::where('order_month',$month)->count();
  $month_amount = App\Models\Order::where('order_month',$month)->sum('amount');
@endphp
@php
@endphp
@section('admin')
<div class="page-content">
  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
      <div class="card radius-10 bg-gradient-deepblue">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <h5 class="mb-0 text-white">£{{ number_format($pending_amt, 2, '.', ',') }}</h5>
            <div class="ms-auto">
              <i class='bx bx-cart fs-3 text-white'></i>
            </div>
          </div>
          <div class="progress my-3 bg-light-transparent" style="height:3px;">
            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex align-items-center text-white">
            <p class="mb-0">Pending Orders</p>
            <p class="mb-0 ms-auto">{{ ($pending_count < 10)?sprintf("%02d", $pending_count):$pending_count }}<span><i class='bx bx-up-arrow-alt'></i></span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 bg-gradient-orange">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <h5 class="mb-0 text-white">£{{ number_format($today_amount, 2, '.', ',') }}</h5>
            <div class="ms-auto">
              <i class='bx bx-cart fs-3 text-white'></i>
            </div>
          </div>
          <div class="progress my-3 bg-light-transparent" style="height:3px;">
            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex align-items-center text-white">
            <p class="mb-0">Today Orders</p>
            <p class="mb-0 ms-auto">{{ ($today_count < 10)?sprintf("%02d", $today_count):$today_count }}<span><i class='bx bx-up-arrow-alt'></i></span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 bg-gradient-ohhappiness">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <h5 class="mb-0 text-white">£{{ number_format($week_amount, 2, '.', ',') }}</h5>
            <div class="ms-auto">
              <i class='bx bx-cart fs-3 text-white'></i>
            </div>
          </div>
          <div class="progress my-3 bg-light-transparent" style="height:3px;">
            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex align-items-center text-white">
            <p class="mb-0">This Week Orders</p>
            <p class="mb-0 ms-auto">{{ ($week_order < 10)?sprintf("%02d", $week_order):$week_order }}<span><i class='bx bx-up-arrow-alt'></i></span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 bg-gradient-ibiza">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <h5 class="mb-0 text-white">£{{ number_format($month_amount, 2, '.', ',') }}</h5>
            <div class="ms-auto">
              <i class='bx bx-cart fs-3 text-white'></i>
            </div>
          </div>
          <div class="progress my-3 bg-light-transparent" style="height:3px;">
            <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
            aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="d-flex align-items-center text-white">
            <p class="mb-0">This Month Orders</p>
            <p class="mb-0 ms-auto">{{ ($month_order < 10)?sprintf("%02d", $month_order):$month_order }}<span><i class='bx bx-up-arrow-alt'></i></span></p>
          </div>
        </div>
      </div>
    </div>
  </div><!--end row-->
  <div class="card radius-10">
    <div class="card-body">
      <div class="d-flex align-items-center">
        <div>
          <h5 class="mb-0">Orders Summary</h5>
        </div>
        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
        </div>
      </div>
      <hr>
      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Sr</th>
              <th>Order id</th>
              <th>Date</th>
              <th>Price</th>
              <th>Payment Through</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $key => $item)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->invoice_no}}</td>
                <td>{{ $item->order_date }}</td>
                <td>£{{ $item->amount }}</td>
                <td>{{ strtoupper($item->payment_method) }}</td>
                <td>
                  @if ($item->status == 'pending')
                    <span class="badge bg-light-warning text-warning w-100">Pending</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
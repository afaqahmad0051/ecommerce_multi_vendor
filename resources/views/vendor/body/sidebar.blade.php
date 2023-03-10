@php
    $user = auth()->user();
    if ($user->role == 'vendor') {
      $status = $user->status;
    }
@endphp
<div class="sidebar-header">
    <div>
        <img src="{{asset('admin/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
    </div>
    <div>
        <h4 class="logo-text">Vendor</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
    </div>
</div>
<!--navigation-->

<ul class="metismenu" id="menu">
    <li>
        <a href="{{route('vendor.dashboard')}}">
            <div class="parent-icon"><i class='bx bx-home-circle'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>        
    </li>
    
    @if ($status == 'active')
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-cube"></i>
            </div>
            <div class="menu-title">Inventory</div>
        </a>
        <ul>
            <li> <a href="{{ route('vendor.product.list') }}"><i class="bx bx-right-arrow-alt"></i>Product</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-shopping-bag"></i>
            </div>
            <div class="menu-title">Order Management</div>
        </a>
        <ul>
            <li> <a href="{{ route('vendor.order.pending') }}"><i class="bx bx-right-arrow-alt"></i>All Orders</a>
            </li>
            <li> <a href="{{ route('vendor.order.return') }}"><i class="bx bx-right-arrow-alt"></i>Return Orders</a>
            </li>
            <li> <a href="{{ route('vendor.order.approve') }}"><i class="bx bx-right-arrow-alt"></i>Return Approve</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-notepad"></i>
            </div>
            <div class="menu-title">Review Management</div>
        </a>
        <ul>
            <li>
                <a href="{{ route('review.vendor.all') }}"><i class="bx bx-right-arrow-alt"></i>All Reviews</a>
            </li>
        </ul>
        {{-- <ul>
            <li class="{{ ($route == 'review.published')?'mm-active':'' }}">
                <a href="{{ route('review.published') }}"><i class="bx bx-right-arrow-alt"></i>Published Reviews</a>
            </li>
        </ul> --}}
    </li>
    @endif
    <li>
        <a href="https://themeforest.net/user/codervent" target="_blank">
            <div class="parent-icon"><i class="bx bx-support"></i>
            </div>
            <div class="menu-title">Support</div>
        </a>
    </li>
</ul>
<!--end navigation-->
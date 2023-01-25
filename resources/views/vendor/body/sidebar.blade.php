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
            <div class="parent-icon"><i class="bx bx-cart"></i>
            </div>
            <div class="menu-title">Inventory</div>
        </a>
        <ul>
            <li> <a href=""><i class="bx bx-right-arrow-alt"></i>Product</a>
            </li>
        </ul>
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
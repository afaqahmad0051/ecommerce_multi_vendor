@php
$prefix = Request::route()->getprefix();
$route = Route::current()->getName();
@endphp
<div class="sidebar-header">
    <div>
        <img src="{{asset('admin/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
    </div>
    <div>
        <h4 class="logo-text">Admin</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
    </div>
</div>
<!--navigation-->
<ul class="metismenu" id="menu">
    <li {{ ($route == 'admin.dashboard')?'active':''}}>
        <a href="{{route('admin.dashboard')}}">
            <div class="parent-icon"><i class='bx bx-home-circle'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>        
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-cart"></i>
            </div>
            <div class="menu-title">Inventory</div>
        </a>
        <ul>
            <li> <a href="{{ route('product.list') }}"><i class="bx bx-right-arrow-alt"></i>Product</a>
            </li>
        </ul>
    </li>
    <li {{ ($prefix == '/vendor')?'mm-active':'' }}>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-briefcase"></i>
            </div>
            <div class="menu-title">Vendor Management</div>
        </a>
        <ul>
            <li class="{{ ($route == 'vendor.inactive')?'mm-active':'' }}">
                <a href="{{ route('vendor.inactive') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendors</a>
            </li>
        </ul>
        <ul>
            <li class="{{ ($route == 'vendor.active')?'mm-active':'' }}">
                <a href="{{ route('vendor.active') }}"><i class="bx bx-right-arrow-alt"></i>Active Vendors</a>
            </li>
        </ul>
    </li>
    <li {{ ($prefix == '/setting')?'mm-active':'' }}>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-cog"></i>
            </div>
            <div class="menu-title">Setting</div>
        </a>
        <ul>
            <li class="{{ ($route == 'year.list')?'mm-active':'' }} || {{ ($route == 'year.create')?'mm-active':'' }} || {{ ($route == 'year.edit')?'mm-active':'' }}">
                <a href="{{ route('year.list') }}"><i class="bx bx-right-arrow-alt"></i>Year</a>
            </li>
        </ul>
        <ul>
            <li class="{{ ($route == 'brand.list')?'mm-active':'' }} || {{ ($route == 'brand.create')?'mm-active':'' }} || {{ ($route == 'brand.edit')?'mm-active':'' }}">
                <a href="{{ route('brand.list') }}"><i class="bx bx-right-arrow-alt"></i>Brand</a>
            </li>
        </ul>
        <ul>
            <li class="{{ ($route == 'category.list')?'mm-active':'' }} || {{ ($route == 'category.create')?'mm-active':'' }} || {{ ($route == 'category.edit')?'mm-active':'' }}">
                <a href="{{ route('category.list') }}"><i class="bx bx-right-arrow-alt"></i>Category</a>
            </li>
        </ul>
        <ul>
            <li class="{{ ($route == 'sub_category.list')?'mm-active':'' }} || {{ ($route == 'sub_category.create')?'mm-active':'' }} || {{ ($route == 'sub_category.edit')?'mm-active':'' }}">
                <a href="{{ route('sub_category.list') }}"><i class="bx bx-right-arrow-alt"></i>Sub Category</a>
            </li>
        </ul>
    </li> 
</ul>
<!--end navigation-->
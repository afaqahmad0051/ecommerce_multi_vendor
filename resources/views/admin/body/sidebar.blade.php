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
    @if (Auth::user()->can('dashboard.menu'))
        <li {{ ($route == 'admin.dashboard')?'active':''}}>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>        
        </li>
    @endif
    @if (Auth::user()->can('product_group.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Product Group</div>
            </a>
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
    @endif
    @if (Auth::user()->can('inventory.menu'))
        <li {{ ($prefix == '/product')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-cube"></i>
                </div>
                <div class="menu-title">Inventory</div>
            </a>
            <ul>
                <li> <a href="{{ route('product.list') }}"><i class="bx bx-right-arrow-alt"></i>Product</a></li>
                <li> <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Stock</a></li>
            </ul>
        </li>
    @endif
    @if (Auth::user()->can('discount_setup.menu'))
        <li {{ ($prefix == '/coupon')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-purchase-tag-alt"></i>
                </div>
                <div class="menu-title">Discount Setup</div>
            </a>
            <ul>
                <li class="{{ ($route == 'coupon.list')?'mm-active':'' }} || {{ ($route == 'coupon.create')?'mm-active':'' }} || {{ ($route == 'coupon.edit')?'mm-active':'' }}">
                    <a href="{{ route('coupon.list') }}"><i class="bx bx-right-arrow-alt"></i>Coupon System</a>
                </li>
            </ul>
        </li>
    @endif
    @if (Auth::user()->can('order_management.menu'))
        <li {{ ($prefix == '/order')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-shopping-bag"></i>
                </div>
                <div class="menu-title">Order Management</div>
            </a>
            <ul>
                <li class="{{ ($route == 'order.pending')?'mm-active':'' }}"> <a href="{{ route('order.pending') }}"><i class="bx bx-right-arrow-alt"></i>Pending</a></li>
                <li class="{{ ($route == 'order.confirm')?'mm-active':'' }}"> <a href="{{ route('order.confirm') }}"><i class="bx bx-right-arrow-alt"></i>Confirm</a></li>
                <li class="{{ ($route == 'order.processing')?'mm-active':'' }}"> <a href="{{ route('order.processing') }}"><i class="bx bx-right-arrow-alt"></i>Processing</a></li>
                <li class="{{ ($route == 'order.delivered')?'mm-active':'' }}"> <a href="{{ route('order.delivered') }}"><i class="bx bx-right-arrow-alt"></i>Delivered</a></li>
            </ul>
        </li>
    @endif
    @if (Auth::user()->can('order_return.menu'))
        <li {{ ($prefix == '/return')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-recycle"></i>
                </div>
                <div class="menu-title">Order Return</div>
            </a>
            <ul>
                <li class="{{ ($route == 'return.request')?'mm-active':'' }}"> <a href="{{ route('return.request') }}"><i class="bx bx-right-arrow-alt"></i>Return Request</a></li>
                <li class="{{ ($route == 'return.complete')?'mm-active':'' }}"> <a href="{{ route('return.complete') }}"><i class="bx bx-right-arrow-alt"></i>Return Complete</a></li>
            </ul>
        </li>
    @endif
    @if (Auth::user()->can('shippment.menu'))
        <li {{ ($prefix == '/shipping')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-map"></i>
                </div>
                <div class="menu-title">Shippment</div>
            </a>
            <ul>
                <li class="{{ ($route == 'country.list')?'mm-active':'' }} || {{ ($route == 'country.create')?'mm-active':'' }} || {{ ($route == 'country.edit')?'mm-active':'' }}">
                    <a href="{{ route('country.list') }}"><i class="bx bx-right-arrow-alt"></i>Country</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'city.list')?'mm-active':'' }} || {{ ($route == 'city.create')?'mm-active':'' }} || {{ ($route == 'city.edit')?'mm-active':'' }}">
                    <a href="{{ route('city.list') }}"><i class="bx bx-right-arrow-alt"></i>City</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'area.list')?'mm-active':'' }} || {{ ($route == 'area.create')?'mm-active':'' }} || {{ ($route == 'area.edit')?'mm-active':'' }}">
                    <a href="{{ route('area.list') }}"><i class="bx bx-right-arrow-alt"></i>Area</a>
                </li>
            </ul>
        </li>
    @endif
    @if (Auth::user()->can('vendor_management.menu'))
        <li {{ ($prefix == '/vendor')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-layer"></i>
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
    @endif
    @if (Auth::user()->can('user_management.menu'))
        <li {{ ($prefix == '/user')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Management</div>
            </a>
            <ul>
                <li class="{{ ($route == 'user.admin.list')?'mm-active':'' }} || {{ ($route == 'user.admin.create')?'mm-active':'' }}">
                    <a href="{{ route('user.admin.list') }}"><i class="bx bx-right-arrow-alt"></i>Admins</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'user.customer.list')?'mm-active':'' }}">
                    <a href="{{ route('user.customer.list') }}"><i class="bx bx-right-arrow-alt"></i>Customers</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'user.vendor.list')?'mm-active':'' }}">
                    <a href="{{ route('user.vendor.list') }}"><i class="bx bx-right-arrow-alt"></i>Vendors</a>
                </li>
            </ul>
        </li>
    @endif
    @if (Auth::user()->can('role_permission.menu'))
        <li {{ ($prefix == '/permission')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Roles & Permissions</div>
            </a>
            <ul>
                <li class="{{ ($route == 'permission.list')?'mm-active':'' }}">
                    <a href="{{ route('permission.list') }}"><i class="bx bx-right-arrow-alt"></i>Permissions</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'permission.role.list')?'mm-active':'' }}">
                    <a href="{{ route('permission.role.list') }}"><i class="bx bx-right-arrow-alt"></i>Roles</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'permission.assign.role')?'mm-active':'' }}">
                    <a href="{{ route('permission.assign.role') }}"><i class="bx bx-right-arrow-alt"></i>Assign Roles</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'permission.assign.list')?'mm-active':'' }}">
                    <a href="{{ route('permission.assign.list') }}"><i class="bx bx-right-arrow-alt"></i>Assign Roles List</a>
                </li>
            </ul>
        </li>
    @endif
    @if (Auth::user()->can('blog.menu'))
        <li {{ ($prefix == '/blog')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-notepad"></i>
                </div>
                <div class="menu-title">Blog Management</div>
            </a>
            <ul>
                <li class="{{ ($route == 'blog.category.list')?'mm-active':'' }}">
                    <a href="{{ route('blog.category.list') }}"><i class="bx bx-right-arrow-alt"></i>Blog Category</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'blog.post.list')?'mm-active':'' }}">
                    <a href="{{ route('blog.post.list') }}"><i class="bx bx-right-arrow-alt"></i>Blog Posts</a>
                </li>
            </ul>
        </li>
    @endif
    @if (Auth::user()->can('review.menu'))
        <li {{ ($prefix == '/review')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-dna"></i>
                </div>
                <div class="menu-title">Review Management</div>
            </a>
            <ul>
                <li class="{{ ($route == 'review.pending')?'mm-active':'' }}">
                    <a href="{{ route('review.pending') }}"><i class="bx bx-right-arrow-alt"></i>Pending Reviews</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'review.published')?'mm-active':'' }}">
                    <a href="{{ route('review.published') }}"><i class="bx bx-right-arrow-alt"></i>Published Reviews</a>
                </li>
            </ul>
        </li>
    @endif
    @if (Auth::user()->can('setting.menu'))
        <li {{ ($prefix == '/setting')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-cog"></i>
                </div>
                <div class="menu-title">Setting</div>
            </a>
            <ul>
                <li class="{{ ($route == 'site.edit')?'mm-active':'' }}">
                    <a href="{{ route('site.edit') }}"><i class="bx bx-right-arrow-alt"></i>Site Info</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'seo.edit')?'mm-active':'' }}">
                    <a href="{{ route('seo.edit') }}"><i class="bx bx-right-arrow-alt"></i>SEO</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'permission-group.list')?'mm-active':'' }} || {{ ($route == 'permission-group.create')?'mm-active':'' }} || {{ ($route == 'permission-group.edit')?'mm-active':'' }}">
                    <a href="{{ route('permission-group.list') }}"><i class="bx bx-right-arrow-alt"></i>Permission Group</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'slider.list')?'mm-active':'' }} || {{ ($route == 'slider.create')?'mm-active':'' }} || {{ ($route == 'slider.edit')?'mm-active':'' }}">
                    <a href="{{ route('slider.list') }}"><i class="bx bx-right-arrow-alt"></i>Slider</a>
                </li>
            </ul>
            <ul>
                <li class="{{ ($route == 'banner.list')?'mm-active':'' }} || {{ ($route == 'banner.create')?'mm-active':'' }} || {{ ($route == 'banner.edit')?'mm-active':'' }}">
                    <a href="{{ route('banner.list') }}"><i class="bx bx-right-arrow-alt"></i>Banner</a>
                </li>
            </ul>
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
        </li>
    @endif
    @if (Auth::user()->can('reports.menu'))
        <li class="menu-label">Reporting</li>
        <li {{ ($prefix == '/vendor')?'mm-active':'' }}>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-clipboard"></i>
                </div>
                <div class="menu-title">Reports</div>
            </a>
            <ul>
                <li class="{{ ($route == 'vendor.inactive')?'mm-active':'' }}">
                    <a href="{{ route('report.view') }}"><i class="bx bx-right-arrow-alt"></i>Report Filters</a>
                </li>
            </ul>
        </li>
    @endif
</ul>
<!--end navigation-->
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\AreaController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PermissionGroupController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnOrderController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorManagementController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\YearController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('user.index');
// });

Route::get('/', [IndexController::class, 'Home']);

Route::middleware(['auth','role:user','verified'])->group(function(){
    Route::get('/dashboard', [UserController::class, 'Dashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'ProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'Logout'])->name('user.logout');
    Route::post('/user/change/password', [UserController::class, 'ChangePassword'])->name('user.password.update');

    Route::prefix('wishlist')->name('wishlist.')->controller(WishlistController::class)->group(function () {
        Route::get('list','index')->name('list');
        Route::get('products','wishlist');
        Route::get('remove/{id}','destroy');
    });

    Route::prefix('user')->name('user.')->controller(AllUserController::class)->group(function () {
        Route::get('account','UserAccount')->name('account.details');
        Route::get('password','UserPassword')->name('account.password');
        Route::get('order','UserOrders')->name('account.orders');
        Route::get('return/order','UserReturnOrders')->name('account.return.orders');
        Route::get('order/view/{id}','orderview')->name('order.view');
        Route::get('order/pdf/{id}','orderpdf')->name('order.pdf');
        Route::post('order/return/{id}','orderreturn')->name('order.return');
        Route::get('track/order','orderTracking')->name('account.track.order');
        Route::post('order/tracking','invoiceTracking')->name('order.tracking');
    });

    Route::prefix('compare')->name('compare.')->controller(CompareController::class)->group(function () {
        Route::get('list','index')->name('list');
        Route::get('products','compare');
        Route::get('remove/{id}','destroy');
    });

    Route::prefix('checkout')->name('checkout.')->controller(CheckoutController::class)->group(function () {
        Route::post('store','store')->name('store');
        // Route::get('products','compare');
        // Route::get('remove/{id}','destroy');
    });

    Route::prefix('stripe')->name('stripe.')->controller(StripeController::class)->group(function () {
        Route::post('order','stripeorder')->name('order');
    });

    Route::prefix('cash')->name('cash.')->controller(StripeController::class)->group(function () {
        Route::post('order','cashorder')->name('order');
    });

    Route::prefix('review')->name('review.')->controller(ReviewController::class)->group(function () {
        Route::post('store','store')->name('store');
    });
});

// Route::get('/dashboard', function () {
//     return view('index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Admin Dashboard
Route::get('/admin/login', [AdminController::class,'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::middleware(['auth','role:admin'])->group(function(){
    Route::prefix('admin')->controller(AdminController::class)->group(function () {
        Route::get('dashboard','AdminDashboard')->name('admin.dashboard');
        Route::get('logout', 'AdminDestroy')->name('admin.logout');
        
        //Admin Profile
        Route::get('profile', 'AdminProfile')->name('admin.profile');
        Route::post('profile/store', 'AdminProfileStore')->name('admin.profile.store');
        
        //Admin Password
        Route::get('change/password','ChangePassword')->name('admin.change.password');
        Route::post('update/password','UpdatePassword')->name('admin.update.password');
    });

    // Setting Prefix
    Route::prefix('setting')->group(function () {
        //Admin Site Info Routes
        Route::prefix('site')->name('site.')->controller(SiteSettingController::class)->group(function () {
            Route::get('form','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
        });
        
        //Admin SEO Routes
        Route::prefix('seo')->name('seo.')->controller(SiteSettingController::class)->group(function () {
            Route::get('form','seoedit')->name('edit');
            Route::post('update/{id}','seoupdate')->name('update');
        });

        //Admin Year Routes
        Route::prefix('year')->name('year.')->controller(YearController::class)->group(function () {
            Route::get('list','index')->name('list');
            Route::get('form','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('form/{id}','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
        });

        //Admin Year Routes
        Route::prefix('permission-group')->name('permission-group.')->controller(PermissionGroupController::class)->group(function () {
            Route::get('list','index')->name('list');
            Route::get('form','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('form/{id}','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
        });

        //Admin Brand Routes
        Route::prefix('brand')->name('brand.')->controller(BrandController::class)->group(function () {
            Route::get('list','index')->name('list');
            Route::get('form','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('form/{id}','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
            Route::get('delete/{id}','destroy')->name('delete');
        });

        //Admin Slider Routes
        Route::prefix('slider')->name('slider.')->controller(SliderController::class)->group(function () {
            Route::get('list','index')->name('list');
            Route::get('form','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('form/{id}','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
            Route::get('delete/{id}','destroy')->name('delete');
        });

        //Admin Banner Routes
        Route::prefix('banner')->name('banner.')->controller(BannerController::class)->group(function () {
            Route::get('list','index')->name('list');
            Route::get('form','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('form/{id}','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
            Route::get('delete/{id}','destroy')->name('delete');
        });
    });

    // Admin Side Vendor Routes
    Route::prefix('vendor')->name('vendor.')->controller(VendorManagementController::class)->group(function () {
        Route::get('inactive/list','InActive')->name('inactive');
        Route::get('active/list','Active')->name('active');
        Route::get('details/{id}','Details')->name('details');
        Route::post('approve/{id}','Approve')->name('approve');
        Route::post('deactivate/{id}','Deactivate')->name('deactivate');
    });
    
    
    // Shippment Prefix
    Route::prefix('shipping')->group(function () {
        //Admin Country Routes
        Route::prefix('country')->name('country.')->controller(CountryController::class)->group(function () {
            Route::get('list','index')->name('list');
            Route::get('form','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('form/{id}','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
            Route::get('delete/{id}','destroy')->name('delete');
        });

        //Admin City Routes
        Route::prefix('city')->name('city.')->controller(CityController::class)->group(function () {
            Route::get('list','index')->name('list');
            Route::get('form','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('form/{id}','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
            Route::get('delete/{id}','destroy')->name('delete');
        });

        //Admin Area Routes
        Route::prefix('area')->name('area.')->controller(AreaController::class)->group(function () {
            Route::get('list','index')->name('list');
            Route::get('form','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('form/{id}','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
            Route::get('delete/{id}','destroy')->name('delete');
        });
    });

    Route::prefix('product')->group(function () {
        //Admin Category Routes
        Route::prefix('category')->name('category.')->controller(CategoryController::class)->group(function () {
            Route::get('list','index')->name('list');
            Route::get('form','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('form/{id}','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
            Route::get('delete/{id}','destroy')->name('delete');
        });
        
        //Admin SubCategory Routes
        Route::prefix('sub-category')->name('sub_category.')->controller(SubCategoryController::class)->group(function () {
            Route::get('list','index')->name('list');
            Route::get('form','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('form/{id}','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
            Route::get('delete/{id}','destroy')->name('delete');
        });
    });
    //Admin Product Routes
    Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
        Route::get('list','index')->name('list');
        Route::get('form','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('form/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::post('update/image/{id}','updateImage')->name('update.thumbnail');
        Route::post('update/multi/image','updateMultiImage')->name('update.multiImage');
        Route::get('delete/image/{id}','imagedestroy')->name('delete.multiImage');
        Route::get('inactive/{id}','inactive')->name('inactive');
        Route::get('active/{id}','active')->name('active');
        Route::get('delete/{id}','destroy')->name('delete');
        //Admin Stock Routes
        Route::get('stock','stock')->name('stock');
    });
    
    //Admin Coupon Routes
    Route::prefix('coupon')->name('coupon.')->controller(CouponController::class)->group(function () {
        Route::get('list','index')->name('list');
        Route::get('form','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('form/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','destroy')->name('delete');
    });
    
    //Admin Order Routes
    Route::prefix('order')->name('order.')->controller(OrderController::class)->group(function () {
        Route::get('pending','pending')->name('pending');
        Route::get('confirm','confirm')->name('confirm');
        Route::get('processing','processing')->name('processing');
        Route::get('delivered','delivered')->name('delivered');
        Route::get('details/{id}','details')->name('details');
        Route::get('pending-to-confirm/{id}','PendingConfirm')->name('status.confirm');
        Route::get('confirm-to-processing/{id}','ConfirmProcessing')->name('status.process');
        Route::get('processing-to-delivered/{id}','ProcessingDeliver')->name('status.deliver');
        Route::get('invoice/{id}','invoice')->name('invoice');
    });
    
    //Admin Return Order Routes
    Route::prefix('return')->name('return.')->controller(ReturnOrderController::class)->group(function () {
        Route::get('order/request','orderReturn')->name('request');
        Route::get('order/approve/{order_id}','returnApprove')->name('approve');
        Route::get('order/complete','orderReturncomplete')->name('complete');
    });
    
    //Admin Report Order Routes
    Route::prefix('report')->name('report.')->controller(ReportController::class)->group(function () {
        Route::get('view','reportView')->name('view');
        Route::post('search-by-date','searchbyDate')->name('date');
        Route::post('search-by-month','searchbyMonth')->name('month');
        Route::post('search-by-year','searchbyYear')->name('year');
        Route::post('search-by-user','searchbyUser')->name('user');
    });
    
    //Admin Users Routes
    Route::prefix('user')->name('user.')->controller(ActiveUserController::class)->group(function () {
        Route::get('customers/list','customerList')->name('customer.list');
        Route::get('vendors/list','vendorList')->name('vendor.list');
        Route::get('admins/list','AdminList')->name('admin.list');
        Route::get('admins/create','AdminCreate')->name('admin.create');
        Route::post('admins/store','AdminStore')->name('admin.store');
        Route::get('admins/edit/{id}','AdminEdit')->name('admin.edit');
        Route::post('admins/update/{id}','AdminUpdate')->name('admin.update');
        Route::get('admins/delete/{id}','AdminDelete')->name('admin.delete');
    });
    
    //Admin User permissions Routes
    Route::prefix('permission')->name('permission.')->controller(RoleController::class)->group(function () {
        Route::get('list','index')->name('list');
        Route::get('form','create')->name('create');
        Route::post('store','store')->name('store');
        Route::get('edit/{id}','edit')->name('edit');
        Route::post('update/{id}','update')->name('update');
        Route::get('delete/{id}','destroy')->name('delete');
        //Admin user role Routes
        Route::get('role/list','roleindex')->name('role.list');
        Route::get('role/form','rolecreate')->name('role.create');
        Route::post('role/store','rolestore')->name('role.store');
        Route::get('role/edit/{id}','roleedit')->name('role.edit');
        Route::post('role/update/{id}','roleupdate')->name('role.update');
        Route::get('role/delete/{id}','roledestroy')->name('role.delete');
        // Assign permissions to user role
        Route::get('assign','assignRolePermission')->name('assign.role');
        Route::post('store/role/permission','storeRolePermission')->name('assign.store');
        Route::get('assign/list','ListRolePermission')->name('assign.list');
        Route::get('assign/edit/{id}','EditRolePermission')->name('assign.edit');
        Route::post('update/role/permission/{id}','updateRolePermission')->name('assign.update');
        Route::get('assign/role/delete/{id}','DeleteRolePermission')->name('assign.delete');

    });
    
    //Admin Blog Routes
    Route::prefix('blog')->name('blog.')->controller(BlogController::class)->group(function () {
        //Blog Category
        Route::get('category/list','categoryList')->name('category.list');
        Route::get('category/form','categoryCreate')->name('category.create');
        Route::post('category/store','categoryStore')->name('category.store');
        Route::get('category/form/{id}','categoryEdit')->name('category.edit');
        Route::post('category/update/{id}','categoryUpdate')->name('category.update');
        Route::get('category/delete/{id}','categoryDelete')->name('category.delete');
        
        //Blog Post
        Route::get('list','index')->name('post.list');
        Route::get('form','create')->name('post.create');
        Route::post('store','store')->name('post.store');
        Route::get('form/{id}','edit')->name('post.edit');
        Route::post('update/{id}','update')->name('post.update');
        Route::get('delete/{id}','destroy')->name('post.delete');
    });
    
    //Admin Review Routes
    Route::prefix('review')->name('review.')->controller(ReviewController::class)->group(function () {
        Route::get('pending','reviewPending')->name('pending');
        Route::get('publish/{id}','reviewPublish')->name('publish');
        Route::get('published','reviewPublished')->name('published');
        Route::get('delete/{id}','reviewDelete')->name('delete');
    });

});


//Vendor Dashboard
Route::get('/vendor/login', [VendorController::class,'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/register/apply', [VendorController::class,'VendorRegisterApply'])->name('vendor.register.apply');
Route::post('/vendor/register', [VendorController::class,'VendorRegister'])->name('vendor.register');
Route::middleware(['auth','role:vendor'])->group(function(){
    Route::controller(VendorController::class)->group(function () {
        Route::get('/vendor/dashboard','VendorDashboard')->name('vendor.dashboard');
        Route::get('/vendor/logout', 'VendorDestroy')->name('vendor.logout');
        
        // //Vendor Profile
        Route::get('/vendor/profile', 'VendorProfile')->name('vendor.profile');
        Route::post('/vendor/profile/store', 'VendorProfileStore')->name('vendor.profile.store');
        
        // //Vendor Password
        Route::get('/vendor/change/password','ChangePassword')->name('vendor.change.password');
        Route::post('/vendor/update/password','UpdatePassword')->name('vendor.update.password');
    });

    //Vendor Product Routes
    Route::prefix('vendor')->name('vendor.')->group(function () {
        Route::prefix('product')->name('product.')->controller(VendorProductController::class)->group(function () {
            Route::get('list','index')->name('list');
            Route::get('form','create')->name('create');
            Route::post('store','store')->name('store');
            Route::get('form/{id}','edit')->name('edit');
            Route::post('update/{id}','update')->name('update');
            Route::post('update/image/{id}','updateImage')->name('update.thumbnail');
            Route::post('update/multi/image','updateMultiImage')->name('update.multiImage');
            Route::get('delete/image/{id}','imagedestroy')->name('delete.multiImage');
            Route::get('inactive/{id}','inactive')->name('inactive');
            Route::get('active/{id}','active')->name('active');
            Route::get('delete/{id}','destroy')->name('delete');
        });
    });
    
    //Vendor Order Routes
    Route::prefix('vendor')->name('vendor.')->group(function () {
        Route::prefix('order')->name('order.')->controller(VendorOrderController::class)->group(function () {
            Route::get('pending','pending')->name('pending');
            Route::get('return','return')->name('return');
            Route::get('approve','approve')->name('approve');
            Route::get('details/{id}','details')->name('details');
        });
    });
    
    //Vendor Review Routes
    Route::prefix('review')->name('review.')->controller(ReviewController::class)->group(function () {
        Route::get('vendor/all','AllreviewVendor')->name('vendor.all');
    });
});

//Frontend routes without Auth Login
//Product Details
Route::prefix('product')->name('product.')->controller(IndexController::class)->group(function () {
    Route::get('details/{slug}/{id}','index')->name('details');
    Route::get('category/{slug}/{id}','category')->name('category');
    Route::get('subcategory/{slug}/{id}','subcategory')->name('subcategory');
    Route::get('quick/view/{id}','quickview');
    Route::get('bargain/{id}','userbargain');
    Route::get('detail/bargain/{id}','Detailuserbargain');
    Route::post('search','Productsearch')->name('search');
    Route::post('ajax-search','searchProduct');
});

//Product Details
Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
    Route::post('data/{id}','cartdata');
    Route::post('details/{id}','cartdetail');
    Route::get('mini','minicart');
    Route::get('mini/remove/{rowId}','removeminicart');
});

//Add to wishlist
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class,'store']);

//Add to compare
Route::post('/add-to-compare/{product_id}', [CompareController::class,'store']);


Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
    Route::get('list','show')->name('page');
    Route::get('main','GetCartData');
    Route::get('main/remove/{rowId}','cartRemove');
    Route::get('decrement/{rowId}','cartDecrement');
    Route::get('increment/{rowId}','cartIncrement');
});


Route::prefix('coupon')->name('coupon.')->controller(CartController::class)->group(function () {
    Route::post('apply','coupon');
    Route::get('calculation','CouponCalculation');
    Route::get('remove','destroy');
});

//Add to checkout
Route::get('/checkout', [CartController::class,'checkout'])->name('checkout');

//Vendor Details
Route::prefix('vendor')->name('supplier.')->controller(IndexController::class)->group(function () {
    Route::get('shop/details/{id}','VendorDetails')->name('shop');
    Route::get('list','List')->name('all');
});

//Blog Routes
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog','Blog')->name('blog.home');
    Route::get('/blog/grid','BlogGrid')->name('blog.grid');
    Route::get('/blog/category/{slug}/{id}','BlogCategoryGrid')->name('blog.category.grid');
    Route::get('/blog/{slug}/{id}','blogRead')->name('blog.read');
});
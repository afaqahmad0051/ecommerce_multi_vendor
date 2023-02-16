<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AreaController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorManagementController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\YearController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CompareController;
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

    Route::prefix('compare')->name('compare.')->controller(CompareController::class)->group(function () {
        Route::get('list','index')->name('list');
        Route::get('products','compare');
        Route::get('remove/{id}','destroy');
    });

    Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
        Route::get('list','show')->name('page');
        Route::get('main','GetCartData');
        Route::get('main/remove/{rowId}','cartRemove');
        Route::get('decrement/{rowId}','cartDecrement');
        Route::get('increment/{rowId}','cartIncrement');
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
        //Admin Year Routes
        Route::prefix('year')->name('year.')->controller(YearController::class)->group(function () {
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
        // Route::get('form','create')->name('create');
        // Route::post('store','store')->name('store');
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

//Vendor Details
Route::prefix('vendor')->name('supplier.')->controller(IndexController::class)->group(function () {
    Route::get('shop/details/{id}','VendorDetails')->name('shop');
    Route::get('list','List')->name('all');
});
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('user.index');
});

Route::middleware(['auth','role:user','verified'])->group(function(){
    Route::get('/dashboard', [UserController::class, 'Dashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'ProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'Logout'])->name('user.logout');
    Route::post('/user/change/password', [UserController::class, 'ChangePassword'])->name('user.password.update');
    
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
Route::get('/admin/login', [AdminController::class,'AdminLogin'])->name('admin.login');
Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard','AdminDashboard')->name('admin.dashboard');
        Route::get('/admin/logout', 'AdminDestroy')->name('admin.logout');
        
        //Admin Profile
        Route::get('/admin/profile', 'AdminProfile')->name('admin.profile');
        Route::post('/admin/profile/store', 'AdminProfileStore')->name('admin.profile.store');
        
        //Admin Password
        Route::get('/admin/change/password','ChangePassword')->name('admin.change.password');
        Route::post('/admin/update/password','UpdatePassword')->name('admin.update.password');
    });

});


//Vendor Dashboard
Route::get('/vendor/login', [VendorController::class,'VendorLogin'])->name('vendor.login');
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
});
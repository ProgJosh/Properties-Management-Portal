<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\Admin\LandlordsController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\BookedController;
use App\Http\Controllers\Frontend\HomeController; 
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Admin\EarningsController;
use App\Http\Controllers\Frontend\ContactController;

require_once __DIR__.'/jetstream.php';

Route::get('/', [HomeController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/properties', [HomeController::class, 'properties'])->name('properties');
Route::get('/property/{id}', [HomeController::class, 'property'])->name('property');

Route::get('properties/{type}', [HomeController::class, 'propertyByType'])->name('propertyByType');
Route::get('booking/{id}', [BookingController::class, 'index'])->name('booking')->middleware('auth');

Route::post('/checkout', [BookingController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('/thankyou', [BookingController::class, 'thankyou'])->name('thankyou');

Route::post('user/profile/update', [UserDashboardController::class, 'updateProfile'])->name('user.profile.update')->middleware('auth');
Route::post('user/password/update', [UserDashboardController::class, 'updatePassword'])->name('user.password.update')->middleware('auth');
Route::get('user/logout', [UserDashboardController::class, 'logout'])->name('user.logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});


//Admin Routes


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register'])->name('register');
    
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('profile', [LoginController::class, 'profile'])->name('profile')->middleware(['auth:admin']);
    Route::get('profile/personal-info', [LoginController::class, 'profilePersonalInfo'])->name('profile.personal-info')->middleware(['auth:admin']);
    Route::post('profile/personal-info-update', [LoginController::class, 'profilePersonalInfoUpdate'])->name('profile.personal-info-update')->middleware(['auth:admin']);

    Route::get('profile/payment-info', [LoginController::class, 'profilePaymentInfo'])->name('profile.payment-info')->middleware(['auth:admin']);
    Route::post('profile/payment-info-update', [LoginController::class, 'profilePaymentInfoUpdate'])->name('profile.payment-info-update')->middleware(['auth:admin']);

    Route::get('profile/change-password', [LoginController::class, 'profileChangePassword'])->name('profile.change-password')->middleware(['auth:admin']);
    Route::post('profile/change-password-update', [LoginController::class, 'profileChangePasswordUpdate'])->name('profile.change-password-update')->middleware(['auth:admin']);




    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard')->middleware(['auth:admin']);

//Properties Routes

   Route::get('/properties', [PropertiesController::class, 'index'])->name('properties')->middleware(['auth:admin']);
   Route::get('/property/create', [PropertiesController::class, 'create'])->name('property.create')->middleware(['auth:admin']);
   Route::post('/property/store', [PropertiesController::class, 'store'])->name('property.store')->middleware(['auth:admin']);
    Route::get('/property/edit/{id}', [PropertiesController::class, 'edit'])->name('property.edit')->middleware(['auth:admin']);
    Route::post('/property/update/{id}', [PropertiesController::class, 'update'])->name('property.update')->middleware(['auth:admin']);
    Route::get('/property/delete/{id}', [PropertiesController::class, 'delete'])->name('property.delete')->middleware(['auth:admin']);
    Route::get('/property/{id}', [PropertiesController::class, 'show'])->name('property.show')->middleware(['auth:admin']);
    Route::post('/property/status', [PropertiesController::class, 'ajaxStatusUpdate'])->name('property.status');



    //Users

    Route::get('/landlords', [LandlordsController::class, 'landlords'])->name('landlords')->middleware(['auth:admin']);
    Route::get('/landlord/{id}', [LandlordsController::class, 'SingleLandlordProperties'])->name('single.landlord')->middleware(['auth:admin']);

    Route::get('/tenants', [TenantController::class, 'tenants'])->name('tenants')->middleware(['auth:admin']);
    Route::get('tenant/delete/{id}', [TenantController::class, 'tanentDelete'])->name('tenant.delete')->middleware(['auth:admin']);
   
    Route::get('admin-list', [LandlordsController::class, 'adminList'])->name('list')->middleware(['auth:admin']);
    Route::get('admin-create', [LandlordsController::class, 'adminCreate'])->name('create')->middleware(['auth:admin']);

    Route::post('admin-create', [LandlordsController::class, 'adminStore'])->name('store')->middleware(['auth:admin']);

    Route::get('admin-delete/{id}', [LandlordsController::class, 'adminDelete'])->name('delete')->middleware(['auth:admin']);


    //Booking Routes

    Route::get('/booked', [BookedController::class, 'booked'])->name('booked')->middleware(['auth:admin']);
    route::get('booked/{id}', [BookedController::class, 'show'])->name('booked.show')->middleware(['auth:admin']);

    Route::get('earnings', [EarningsController::class, 'index'])->name('earnings')->middleware(['auth:admin']);
    Route::post('withdraw', [EarningsController::class, 'withdraw'])->name('withdraw')->middleware(['auth:admin']);

    Route::get('withdraw-requests', [EarningsController::class, 'withdrawRequests'])->name('withdraw-requests')->middleware(['auth:admin']);
    
    Route::get('withdraw-approve/{id}', [EarningsController::class, 'withdrawApprove'])->name('withdraw-approve')->middleware(['auth:admin']);
    Route::get('withdraw-reject/{id}', [EarningsController::class, 'withdrawReject'])->name('withdraw-reject')->middleware(['auth:admin']);
});

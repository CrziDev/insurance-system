<?php

use App\Http\Controllers\Admin\AdminClaimsController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminReportsController;
use App\Http\Controllers\Admin\AdminStaffController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminExpiringController;
use App\Http\Controllers\Admin\AdminPoliciesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\CustomerClaimsController;
use App\Http\Controllers\Customer\CustomerDashboardontroller;
use App\Http\Controllers\Customer\CustomerInsuranceController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth'])->group(function () 
{
    Route::group((['prefix'=>'admin','middleware'=>'role:admin']),function ()
        {
            Route::resource('dashboard',AdminDashboardController::class);
            Route::resource('request',AdminTransactionController::class);
            Route::resource('expiring',AdminExpiringController::class);

            Route::resource('customers',AdminCustomerController::class);
            Route::resource('staff',AdminStaffController::class);
            Route::resource('claims',AdminClaimsController::class);
            Route::resource('reports',AdminReportsController::class);
            Route::resource('policies',AdminPoliciesController::class);

        }
    );

    Route::group((['prefix'=>'customer','middleware'=>'role:customer']),function ()
        {
            Route::resource('dashboard',CustomerDashboardontroller::class);
            Route::resource('claims',CustomerClaimsController::class);
            Route::resource('insurance',CustomerInsuranceController::class);
        }
    );

    Route::group((['prefix'=>'report']),function ()
        {
            Route::get('/sales',[ReportsController::class,'printSales']);
        }
    );

});

Route::get('/',[LoginController::class,'create'])->name('login')->middleware('checkAuth');
Route::get('/login',[LoginController::class,'create'])->name('login')->middleware('checkAuth');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LoginController::class,'destroy']);

Route::get('/register',[RegisterController::class,'create'])->middleware('checkAuth');;
Route::post('/register',[RegisterController::class,'store']);


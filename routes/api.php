<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ADMIN PANEL
Route::group(['prefix' => 'admin'], function () {
    Route::post('login', [AdminController::class, 'login']);

    Route::group(['middleware' => ['jwt.verify:admin']], function () {
        Route::get('logout', [AdminController::class, 'logout']);
        Route::get('me', [AdminController::class, 'userProfile']);
        Route::post('update', [AdminController::class, 'update']);
        Route::resource('user', UserController::class);
        Route::resource('wakam-service', \App\Http\Controllers\WakamServiceController::class);
        Route::resource('ima-service', \App\Http\Controllers\ImaServiceController::class);

        Route::resource('quotation', \App\Http\Controllers\Admin\QuotationController::class);
        Route::resource('contract', \App\Http\Controllers\Admin\ContractController::class);
        Route::resource('resiliation', \App\Http\Controllers\Admin\ResiliationController::class);

    });
});

// WEB
Route::group(['prefix' => 'web'], function () {
    Route::group(['prefix' => 'wakam'], function () {
        Route::resource('insurance', \App\Http\Controllers\WakamInsuranceController::class);
    });
    Route::resource('billing-address', \App\Http\Controllers\BillingAddressController::class);
    Route::resource('contract', \App\Http\Controllers\ContractController::class);
    Route::resource('insurance', \App\Http\Controllers\InsuranceController::class);
    Route::resource('intervention-address', \App\Http\Controllers\InterventionAddressController::class);
});

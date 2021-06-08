<?php

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
        Route::get('admin', [AdminController::class, 'index']);
        Route::post('admin', [AdminController::class, 'store']);
        Route::get('admin/{id}', [AdminController::class, 'show']);
        Route::put('admin/{id}', [AdminController::class, 'update']);
        Route::get('me', [AdminController::class, 'userProfile']);
        Route::delete('admin/{id}', [AdminController::class, 'destroy']);
        Route::resource('user', UserController::class);
        Route::resource('wakam-service', \App\Http\Controllers\WakamServiceController::class);
        Route::resource('ima-service', \App\Http\Controllers\ImaServiceController::class);

        Route::resource('ima-quotation', \App\Http\Controllers\Admin\ImaQuotationController::class);
        Route::resource('ima-user', \App\Http\Controllers\Admin\ImaUserController::class);
        Route::resource('quotation', \App\Http\Controllers\Admin\QuotationController::class);
        Route::resource('contract', \App\Http\Controllers\Admin\ContractController::class);
        Route::resource('resiliation', \App\Http\Controllers\Admin\ResiliationController::class);
        Route::resource('intervention', \App\Http\Controllers\Admin\InterventionController::class);
        Route::resource('resident', \App\Http\Controllers\Admin\ResidentController::class);
        Route::resource('prospect', \App\Http\Controllers\Admin\ProspectController::class);
    });
});

Route::group(['prefix' => 'download/v1'], function () {
    // Exports
    Route::get('token', [\App\Http\Controllers\Admin\DownloadController::class, 'token']);
    Route::get('download', [\App\Http\Controllers\Admin\DownloadController::class, 'download']);
});

// WEB
Route::group(['prefix' => 'web'], function () {

    Route::post('ima-quotation', [\App\Http\Controllers\ImaQuotationController::class, 'store']);
    Route::post('ima-user', [\App\Http\Controllers\ImaUserController::class, 'store']);
    Route::post('intervention', [\App\Http\Controllers\InterventionController::class, 'store']);

    Route::resource('prospect', \App\Http\Controllers\ProspectController::class);
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::resource('quotation', \App\Http\Controllers\QuotationController::class);
    Route::resource('contract', \App\Http\Controllers\ContractController::class);
    Route::resource('resident', \App\Http\Controllers\ResidentController::class);
    Route::resource('resiliation', \App\Http\Controllers\ResiliationController::class);
});

// IMA
Route::group(['prefix' => 'ima/v1'], function () {
    Route::post('token', [\App\Http\Controllers\IMAController::class, 'token']);
});

// proxy
Route::group(['prefix' => 'proxy/v1'], function () {
    Route::get('ima', [\App\Http\Controllers\IMAController::class, 'proxy']);
    Route::post('ima', [\App\Http\Controllers\IMAController::class, 'proxy']);

    Route::get('wakam', [\App\Http\Controllers\WakamController::class, 'proxy']);
    Route::post('wakam', [\App\Http\Controllers\WakamController::class, 'proxy']);
});

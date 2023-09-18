<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AdminSalesSummary;



Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('sellers', SellerController::class);
    Route::apiResource('sales', SaleController::class);
    Route::get('sales/seller/{seller}', [SaleController::class, 'showBySeller']);

    Route::get('/summary-email', [EmailController::class, 'sendSummaryEmail']);
    Route::post('/send-admin-sales', [EmailController::class, 'sendAdminSalesSummary']);
    Route::post('/resend-summary-email/{seller}', [EmailController::class, 'resendSellerSummaryEmail']);


    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

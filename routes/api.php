<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AuthController;



Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('sellers', SellerController::class);
    Route::apiResource('sales', SaleController::class);
    Route::get('sales/seller/{seller}', [SaleController::class, 'showBySeller']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

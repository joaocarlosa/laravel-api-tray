<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;



Route::get('/', function(){
    return response()->json([
        'success' =>  true
    ]);
});

Route::apiResource('sellers', SellerController::class);
Route::apiResource('sales', SaleController::class);
Route::get('sales/seller/{seller}', [SaleController::class, 'showBySeller']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

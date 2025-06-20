<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Currency routes
    Route::apiResource('currencies', App\Http\Controllers\Api\CurrencyController::class);

    // Product routes
    Route::get('/products/{product}/prices', [App\Http\Controllers\Api\ProductController::class, 'getPrices']);
    Route::post('/products/{product}/prices', [App\Http\Controllers\Api\ProductController::class, 'addPrice']);
    Route::apiResource('products', App\Http\Controllers\Api\ProductController::class);
    // Product Price routes
    Route::apiResource('product-prices', App\Http\Controllers\Api\ProductPriceController::class);

});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware(['auth:api'])->group(function () {
    /**
     * Customer Routes
     */
    Route::resource('/customers', CustomerController::class);
    Route::put('/customers/{id}/restore', [CustomerController::class, 'restore']);

    /**
     * Product Routes
     */
    Route::resource('/products', ProductController::class);
    Route::put('/products/{id}/restore', [ProductController::class, 'restore']);

    /**
     * Orders Routes
     */
    Route::post('/orders', [OrderController::class, 'store']);
    Route::delete('/orders', [OrderController::class, 'delete']);
});

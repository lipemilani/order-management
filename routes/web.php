<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

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

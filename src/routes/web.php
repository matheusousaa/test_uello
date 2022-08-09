<?php

use App\Http\Controllers\ShippingPricesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShippingPricesController::class, 'index'])->name('index');
Route::post('/', [ShippingPricesController::class, 'save'])->name('save');
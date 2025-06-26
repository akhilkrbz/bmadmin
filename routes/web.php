<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\BedController;
use App\Http\Controllers\HarvestController;
use App\Http\Controllers\LedgerTypeController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/home', [Admin::class, 'home'])->name('home');


//Beds
Route::resource('beds', BedController::class);

// Harvest
Route::resource('harvest', HarvestController::class);

// Ledgers
Route::resource('ledgers', LedgerController::class);

// Products
Route::resource('products', ProductController::class);

// Purchases
Route::resource('purchases', PurchaseController::class);

// Customers
Route::resource('customer', CustomerController::class);

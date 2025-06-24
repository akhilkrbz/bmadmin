<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\BedController;
use App\Http\Controllers\HarvestController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
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

// Expense Types
Route::resource('expense-types', ExpenseTypeController::class);

// Expenses
Route::resource('expenses', ExpenseController::class);

// Products
Route::resource('products', ProductController::class);

// Customers
Route::resource('customer', CustomerController::class);

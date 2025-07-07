<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\BedController;
use App\Http\Controllers\HarvestController;
use App\Http\Controllers\LedgerTypeController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PaymentVoucherController;
use App\Http\Controllers\ReportController;
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

// Payment Vouchers
Route::resource('payment_vouchers', PaymentVoucherController::class);
Route::get('payment-vouchers/total-amount', [PaymentVoucherController::class, 'getTotalAmount']);

// Customers
Route::resource('customer', CustomerController::class);

// Sales
Route::resource('sales', App\Http\Controllers\SaleController::class);
Route::get('sale-items', [App\Http\Controllers\SaleItemController::class, 'index'])->name('sale_items.index');

// Receipts
Route::resource('receipts', App\Http\Controllers\ReceiptController::class);
Route::get('receipt/total-amount', [App\Http\Controllers\ReceiptController::class, 'getTotalAmount']);

//Reports
Route::get('reports/expenses', [ReportController::class, 'expenses'])->name('reports.expenses');
Route::get('reports/get_expenses', [ReportController::class, 'getExpenses'])->name('reports.expenses');
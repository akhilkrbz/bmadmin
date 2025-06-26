<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentVoucherController;

// ...existing code...
Route::get('payment-vouchers/total-amount', [PaymentVoucherController::class, 'getTotalAmount']);
// ...existing code...
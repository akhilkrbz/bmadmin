<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Ledger;
use App\Models\Harvest;
use App\Models\PaymentVoucher;
use App\Models\Sale;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function home(Request $request)
    {
        $total_beds = Bed::sum('no_of_beds');
        // $total_harvest = Harvest::sum('total_harvest_quantity');
        $monthly_harvest = Harvest::whereMonth('harvest_date', now()->month)->sum('total_harvest_quantity');
        $monthly_expenses = PaymentVoucher::whereMonth('voucher_date', now()->month)->sum('amount');
        $monthly_sales = Sale::whereMonth('sale_date', now()->month)->sum('total_amount');
        return view('admin.home', compact('total_beds', 'monthly_harvest', 'monthly_expenses', 'monthly_sales'));
    }
}

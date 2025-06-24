<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Expense;
use App\Models\Harvest;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function home(Request $request)
    {
        $total_beds = Bed::sum('no_of_beds');
        // $total_harvest = Harvest::sum('total_harvest_quantity');
        $monthly_harvest = Harvest::whereMonth('harvest_date', now()->month)->sum('total_harvest_quantity');
        $monthly_expenses = Expense::whereMonth('date', now()->month)->sum('amount');
        return view('admin.home', compact('total_beds', 'monthly_harvest', 'monthly_expenses'));
    }
}

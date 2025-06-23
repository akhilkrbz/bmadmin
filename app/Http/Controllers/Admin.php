<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Harvest;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function home(Request $request)
    {
        $total_beds = Bed::sum('no_of_beds');
        $total_harvest = Harvest::sum('total_harvest_quantity');
        return view('admin.home', compact('total_beds', 'total_harvest'));
    }
}

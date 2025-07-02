<?php

namespace App\Http\Controllers;

use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleItemController extends Controller
{
    public function index()
    {
        $items = SaleItem::with('product')->orderByDesc('id')->paginate(20);
        return view('sales.items', compact('items'));
    }
}

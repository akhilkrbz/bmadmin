<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Ledger;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['ledger', 'creator', 'items'])->orderByDesc('id')->paginate(20);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $ledgers = Ledger::where('type', 'customer')->orWhere('type', 'shop')->get();
        $products = Product::all();
        return view('sales.create', compact('ledgers', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // 'invoice_no' => 'nullable|string|max:20',
            'sale_date' => 'nullable|date',
            'ledger_id' => 'nullable|exists:ledgers,id',
            'payment_mode' => 'required|in:cash,bank,credit',
            'total_amount' => 'nullable|numeric',
            'description' => 'nullable|string',
            'created_by' => 'nullable|exists:users,id',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.mrp' => 'required|numeric',
            'items.*.amount' => 'required|numeric',
        ]);

        $data['sale_date'] = Carbon::parse($data['sale_date'])->format('Y-m-d');
        $data['created_by'] = 1;//auth()->check() ? auth()->user()->id : null;
        $data['created_at'] = now();

        if (empty($data['invoice_no'])) {
            $lastVoucher = Sale::orderByDesc('id')->first();
            $lastNumber = $lastVoucher && is_numeric($lastVoucher->invoice_no) ? (int)$lastVoucher->invoice_no : 0;
            $voucherNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
            $data['invoice_no'] = $voucherNumber;
        }

        $sale = Sale::create($data);
        foreach ($data['items'] as $item) {
            $item['sale_id'] = $sale->id;
            SaleItem::create($item);
        }
        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }

    public function show($id)
    {
        $sale = Sale::with(['ledger', 'creator', 'items.product'])->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    public function edit($id)
    {
        $sale = Sale::with('items')->findOrFail($id);
        $ledgers = Ledger::all();
        $products = Product::all();
        return view('sales.edit', compact('sale', 'ledgers', 'products'));
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $data = $request->validate([
            'invoice_no' => 'nullable|string|max:20',
            'sale_date' => 'nullable|date',
            'ledger_id' => 'nullable|exists:ledgers,id',
            'payment_mode' => 'required|in:cash,bank,credit',
            'total_amount' => 'nullable|numeric',
            'description' => 'nullable|string',
            'created_by' => 'nullable|exists:users,id',
            'items' => 'required|array',
            'items.*.id' => 'nullable|exists:sale_items,id',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.mrp' => 'required|numeric',
            'items.*.amount' => 'required|numeric',
        ]);
        $sale->update($data);
        // Update sale items
        $sale->items()->delete();
        foreach ($data['items'] as $item) {
            $item['sale_id'] = $sale->id;
            SaleItem::create($item);
        }
        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->items()->delete();
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}

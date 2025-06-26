<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Ledger;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'creator', 'items.item'])->orderByDesc('id')->paginate(20);
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Ledger::where('type', 'supplier')->get();
        $items = Ledger::where('type', 'direct')->get();
        return view('purchases.create', compact('suppliers', 'items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_date' => 'nullable|date',
            'bill_no' => 'nullable|string|max:200',
            'supplier_id' => 'nullable|exists:ledgers,id',
            'payment_mode' => 'required|in:cash,bank,credit',
            'total_amount' => 'nullable|numeric',
            'description' => 'nullable|string',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:ledgers,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.rate' => 'required|numeric',
            'items.*.amount' => 'required|numeric',
        ]);
        $validated['purchase_date'] = Carbon::parse($validated['purchase_date'])->format('Y-m-d');
        $validated['created_by'] = 1;//auth()->check() ? auth()->user()->id : null;
        $validated['created_at'] = now();
        $items = $validated['items'];
        unset($validated['items']);
        $purchase = Purchase::create($validated);
        foreach ($items as $item) {
            $item['purchase_id'] = $purchase->id;
            PurchaseItem::create($item);
        }
        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully.');
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'creator', 'items.item']);
        return view('purchases.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $suppliers = Ledger::all();
        $items = Ledger::all();
        $purchase->load('items');
        return view('purchases.edit', compact('purchase', 'suppliers', 'items'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'purchase_date' => 'nullable|date',
            'bill_no' => 'nullable|string|max:200',
            'supplier_id' => 'nullable|exists:ledgers,id',
            'payment_mode' => 'required|in:cash,bank,credit',
            'total_amount' => 'nullable|numeric',
            'description' => 'nullable|string',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:ledgers,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.rate' => 'required|numeric',
            'items.*.amount' => 'required|numeric',
        ]);
        $validated['purchase_date'] = Carbon::parse($validated['purchase_date'])->format('Y-m-d');
        $purchase->update($validated);
        // Remove old items and add new
        $purchase->items()->delete();
        foreach ($validated['items'] as $item) {
            $item['purchase_id'] = $purchase->id;
            PurchaseItem::create($item);
        }
        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->items()->delete();
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }
}

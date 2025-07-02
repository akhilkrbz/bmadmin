<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\Ledger;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function index()
    {
        $receipts = Receipt::with(['ledger', 'creator'])->orderByDesc('id')->paginate(20);
        return view('receipts.index', compact('receipts'));
    }

    public function create()
    {
        $ledgers = Ledger::where('type', 'customer')
            ->orWhere('type', 'shop')
            ->orderBy('title')
            ->get();
        return view('receipts.create', compact('ledgers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // 'receipt_number' => 'nullable|string|max:20',
            'receipt_date' => 'nullable|date',
            'ledger_id' => 'nullable|exists:ledgers,id',
            'amount' => 'nullable|numeric',
            'payment_mode' => 'required|in:cash,bank',
            'description' => 'nullable|string',
            'created_by' => 'nullable|exists:users,id',
        ]);

        $data['receipt_date'] = Carbon::parse($data['receipt_date'])->format('Y-m-d');
        $data['created_by'] = 1;//auth()->check() ? auth()->user()->id : null;
        $data['created_at'] = now();
        // Generate 5-digit serial voucher number if not provided
        if (empty($data['receipt_number'])) {
            $lastVoucher = Receipt::orderByDesc('id')->first();
            $lastNumber = $lastVoucher && is_numeric($lastVoucher->receipt_number) ? (int)$lastVoucher->receipt_number : 0;
            $voucherNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
            $data['receipt_number'] = $voucherNumber;
        }

        Receipt::create($data);
        return redirect()->route('receipts.index')->with('success', 'Receipt created successfully.');
    }

    public function show($id)
    {
        $receipt = Receipt::with(['ledger', 'creator'])->findOrFail($id);
        return view('receipts.show', compact('receipt'));
    }

    public function edit($id)
    {
        $receipt = Receipt::findOrFail($id);
        $ledgers = Ledger::where('type', 'customer')
            ->orWhere('type', 'shop')
            ->orderBy('title')
            ->get();
        return view('receipts.edit', compact('receipt', 'ledgers'));
    }

    public function update(Request $request, $id)
    {
        $receipt = Receipt::findOrFail($id);
        $data = $request->validate([
            // 'receipt_number' => 'nullable|string|max:20',
            'receipt_date' => 'nullable|date',
            'ledger_id' => 'nullable|exists:ledgers,id',
            'amount' => 'nullable|numeric',
            'payment_mode' => 'required|in:cash,bank',
            'description' => 'nullable|string',
            'created_by' => 'nullable|exists:users,id',
        ]);
        $data['receipt_date'] = Carbon::parse($data['receipt_date'])->format('Y-m-d');
        $receipt->update($data);
        return redirect()->route('receipts.index')->with('success', 'Receipt updated successfully.');
    }

    public function destroy($id)
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->delete();
        return redirect()->route('receipts.index')->with('success', 'Receipt deleted successfully.');
    }

    public function getTotalAmount(Request $request)
    {
        $ledger_id = $request->query('ledger_id');
        if (!$ledger_id) {
            return response()->json(['total_amount' => 0]);
        }
        $total = Receipt::where('ledger_id', $ledger_id)
            ->sum('amount');

        //Purchase amount
        $sale_amount = Sale::select('total_amount')->where('ledger_id', $ledger_id)
            ->where('payment_mode', 'credit')
            ->sum('total_amount') ?? 0;
        return response()->json(['total_amount' => $sale_amount - $total]);
    }
}

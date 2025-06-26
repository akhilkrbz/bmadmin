<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\PaymentVoucher;
use App\Models\Purchase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentVoucherController extends Controller
{
    public function index()
    {
        $vouchers = PaymentVoucher::with('creator')->orderByDesc('id')->paginate(20);
        return view('payment_vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        $users = User::all();
        $ledgers = Ledger::where('type', 'direct')
            ->orWhere('type', 'indirect')
            ->orderBy('title')
            ->get();
        $purchases = Purchase::with('supplier')->where('payment_mode', 'credit')
            ->orderBy('purchase_date', 'desc')
            ->get();
        return view('payment_vouchers.create', compact('users', 'ledgers', 'purchases'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'voucher_number' => 'nullable|string|max:20',
            'voucher_date' => 'nullable|date',
            'voucher_type' => 'required|in:ledger,purchase',
            'voucher_type_id' => 'nullable|integer',
            'amount' => 'nullable|numeric',
            'payment_mode' => 'required|in:cash,bank',
            'description' => 'nullable|string',
        ]);
        $validated['voucher_date'] = Carbon::parse($validated['voucher_date'])->format('Y-m-d');
        $validated['created_by'] = 1;//auth()->check() ? auth()->user()->id : null;
        $validated['created_at'] = now();
        // Generate 5-digit serial voucher number if not provided
        if (empty($validated['voucher_number'])) {
            $lastVoucher = PaymentVoucher::orderByDesc('id')->first();
            $lastNumber = $lastVoucher && is_numeric($lastVoucher->voucher_number) ? (int)$lastVoucher->voucher_number : 0;
            $voucherNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
            $validated['voucher_number'] = $voucherNumber;
        }
        PaymentVoucher::create($validated);
        return redirect()->route('payment_vouchers.index')->with('success', 'Payment voucher created successfully.');
    }

    public function show(PaymentVoucher $payment_voucher)
    {
        $payment_voucher->load('creator');
        return view('payment_vouchers.show', compact('payment_voucher'));
    }

    public function edit(PaymentVoucher $payment_voucher)
    {
        $users = User::all();
        return view('payment_vouchers.edit', compact('payment_voucher', 'users'));
    }

    public function update(Request $request, PaymentVoucher $payment_voucher)
    {
        $validated = $request->validate([
            'voucher_number' => 'nullable|string|max:20',
            'voucher_date' => 'nullable|date',
            'voucher_type' => 'required|in:ledger,purchase',
            'voucher_type_id' => 'nullable|integer',
            'amount' => 'nullable|numeric',
            'payment_mode' => 'required|in:cash,bank',
            'description' => 'nullable|string',
        ]);
        $validated['voucher_date'] = Carbon::parse($validated['voucher_date'])->format('Y-m-d');
        // Generate 5-digit serial voucher number if not provided or empty
        if (empty($validated['voucher_number'])) {
            $lastVoucher = PaymentVoucher::orderByDesc('id')->first();
            $lastNumber = $lastVoucher && is_numeric($lastVoucher->voucher_number) ? (int)$lastVoucher->voucher_number : 0;
            $voucherNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
            $validated['voucher_number'] = $voucherNumber;
        }
        $payment_voucher->update($validated);
        return redirect()->route('payment_vouchers.index')->with('success', 'Payment voucher updated successfully.');
    }

    public function destroy(PaymentVoucher $payment_voucher)
    {
        $payment_voucher->delete();
        return redirect()->route('payment_vouchers.index')->with('success', 'Payment voucher deleted successfully.');
    }

    public function getTotalAmount(Request $request)
    {
        $voucherType = $request->query('voucher_type');
        $voucherTypeId = $request->query('voucher_type_id');
        if (!$voucherType || !$voucherTypeId) {
            return response()->json(['total_amount' => 0]);
        }
        $total = PaymentVoucher::where('voucher_type', $voucherType)
            ->where('voucher_type_id', $voucherTypeId)
            ->sum('amount');

        //Purchase amount
        $purchase_amount = Purchase::select('total_amount')->where('id', $voucherTypeId)
            ->where('payment_mode', 'credit')
            ->first()->total_amount ?? 0;
        return response()->json(['total_amount' => $purchase_amount - $total]);
    }
}

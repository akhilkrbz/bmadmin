<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\PaymentVoucher;
use Illuminate\Http\Request;
use App\traits\Common;

class ReportController extends Controller
{
    use Common;

    public function expenses()
    {
        // Logic to generate the expenses report
        $ledgers = Ledger::where('type', 'direct')
            ->orWhere('type', 'indirect')
            ->orWhere('type', 'supplier')
            ->orderBy('title')
            ->get();
        return view('reports.expenses', compact('ledgers'));
    }

    public function getExpenses(Request $request)
    {
        $start_date = $request->input('from');
        $end_date = $request->input('to');
        $ledger = $request->input('ledger_id');
        $expenses = PaymentVoucher::with('creator')
        ->where(function ($query) use ($start_date, $end_date, $ledger) {
            if ($start_date) {
                $query->whereDate('voucher_date', '>=', $this->formatDate('Y-m-d', $start_date));
            }
            if ($end_date) {
                $query->whereDate('voucher_date', '<=', $this->formatDate('Y-m-d',$end_date));
            }
            if ($ledger) {
                $query->where('ledger_id', $ledger);
            }
        })
        ->orderByDesc('id')->paginate(20);
        $html = view('reports.expenses_list', compact('expenses'))->render();
        return response()->json(['html' => $html]);
    }
}

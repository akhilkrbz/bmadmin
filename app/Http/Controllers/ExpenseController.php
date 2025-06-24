<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('expenseType')->paginate(10);
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $expenseTypes = ExpenseType::all();
        return view('expenses.create', compact('expenseTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_id' => 'required|exists:expense_types,id',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        $validated['date'] = Carbon::parse($validated['date'])->format('Y-m-d');
        $validated['created_by'] = 1;//auth()->id();
        $validated['created_at'] = now();
        Expense::create($validated);
        return redirect()->route('expenses.create')->with('success', 'Expense created successfully.');
    }

    public function show(Expense $expense)
    {
        $expense->load('expenseType');
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $expenseTypes = ExpenseType::all();
        return view('expenses.edit', compact('expense', 'expenseTypes'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'type_id' => 'required|exists:expense_types,id',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        $validated['date'] = Carbon::parse($validated['date'])->format('Y-m-d');
        $expense->update($validated);
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}

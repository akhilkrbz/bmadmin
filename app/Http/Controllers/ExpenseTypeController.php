<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpenseTypeController extends Controller
{
    public function index()
    {
        $expenseTypes = ExpenseType::paginate(10);
        return view('expense_types.index', compact('expenseTypes'));
    }

    public function create()
    {
        return view('expense_types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:direct,indirect',
            'title' => 'required|string|max:200',
            'status' => 'required|integer',
        ]);
        ExpenseType::create($validated);
        return redirect()->route('expense-types.create')->with('success', 'Expense type created successfully.');
    }

    public function show(ExpenseType $expenseType)
    {
        return view('expense_types.show', compact('expenseType'));
    }

    public function edit(ExpenseType $expenseType)
    {
        return view('expense_types.edit', compact('expenseType'));
    }

    public function update(Request $request, ExpenseType $expenseType)
    {
        $validated = $request->validate([
            'type' => 'required|in:direct,indirect',
            'title' => 'required|string|max:200',
            'status' => 'required|integer',
        ]);
        $expenseType->update($validated);
        return redirect()->route('expense-types.index')->with('success', 'Expense type updated successfully.');
    }

    public function destroy(ExpenseType $expenseType)
    {
        $expenseType->delete();
        return redirect()->route('expense-types.index')->with('success', 'Expense type deleted successfully.');
    }
}

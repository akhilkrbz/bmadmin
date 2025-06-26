<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function index()
    {
        $ledgers = Ledger::paginate(10);
        return view('ledgers.index', compact('ledgers'));
    }

    public function create()
    {
        return view('ledgers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:direct,indirect',
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'status' => 'required|integer',
        ]);
        Ledger::create($validated);
        return redirect()->route('ledgers.create')->with('success', 'Ledger created successfully.');
    }

    public function show(Ledger $ledger)
    {
        return view('ledgers.show', compact('ledger'));
    }

    public function edit(Ledger $ledger)
    {
        return view('ledgers.edit', compact('ledger'));
    }

    public function update(Request $request, Ledger $ledger)
    {
        $validated = $request->validate([
            'type' => 'required|in:direct,indirect',
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'status' => 'required|integer',
        ]);
        $ledger->update($validated);
        return redirect()->route('ledgers.index')->with('success', 'Ledger updated successfully.');
    }

    public function destroy(Ledger $ledger)
    {
        $ledger->delete();
        return redirect()->route('ledgers.index')->with('success', 'Ledger deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:shop,customer',
            'name' => 'required|string|max:200',
            'place' => 'nullable|string|max:200',
            'phone' => 'nullable|string|max:20',
        ]);
        Customer::create($validated);
        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'type' => 'required|in:shop,customer',
            'name' => 'required|string|max:200',
            'place' => 'nullable|string|max:200',
            'phone' => 'nullable|string|max:20',
        ]);
        $customer->update($validated);
        return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BedController extends Controller
{
    public function index()
    {
        $beds = Bed::select("*")->orderBy('date_of_bed', 'desc')->orderBy('id', 'desc')->paginate(10);

        $total_beds = Bed::sum('no_of_beds');

        return view('beds.index', compact('beds', 'total_beds'));
    }

    public function create()
    {
        return view('beds.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_of_bed' => 'required|date',
            'no_of_beds' => 'required|integer',
            'description' => 'nullable|string',
        ]);
        $validated['date_of_bed'] = Carbon::parse($validated['date_of_bed'])->format('Y-m-d');
        $validated['no_of_beds'] = (int)$validated['no_of_beds'];
        $validated['created_by'] = 1;//auth()->id();
        $validated['created_at'] = Carbon::now();
        Bed::create($validated);
        // return redirect()->route('beds.index')->with('success', 'Bed created successfully.');
        return redirect()->route('beds.create')->with('success', 'Bed created successfully.');
    }

    public function show(Bed $bed)
    {
        return view('beds.show', compact('bed'));
    }

    public function edit(Bed $bed)
    {
        return view('beds.edit', compact('bed'));
    }

    public function update(Request $request, Bed $bed)
    {
        $validated = $request->validate([
            'date_of_bed' => 'required|date',
            'no_of_beds' => 'required|integer',
            'description' => 'nullable|string',
        ]);
        $validated['date_of_bed'] = Carbon::parse($validated['date_of_bed'])->format('Y-m-d');
        $validated['no_of_beds'] = (int)$validated['no_of_beds'];
        $bed->update($validated);
        return redirect()->route('beds.index')->with('success', 'Bed record updated successfully.');
    }

    public function destroy(Bed $bed)
    {
        $bed->delete();
        return redirect()->route('beds.index')->with('success', 'Bed record deleted successfully.');
    }
}

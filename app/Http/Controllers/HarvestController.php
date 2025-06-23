<?php

namespace App\Http\Controllers;

use App\Models\Harvest;
use App\Models\HarvestBed;
use App\Models\Bed;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HarvestController extends Controller
{
    public function index()
    {
        $harvests = Harvest::with(['creator', 'beds.bed'])->paginate(10);
        
        return view('harvest.index', compact('harvests'));
    }

    public function create()
    {
        $beds = Bed::all();
        return view('harvest.create', compact('beds'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'harvest_date' => 'required|date',
            'total_harvest_quantity' => 'required|string',
            'description' => 'nullable|string',
            'bed_ids' => 'required|array',
        ]);
        $validated['harvest_date'] = Carbon::parse($validated['harvest_date'])->format('Y-m-d');
        $validated['created_by'] = 1;//auth()->id();
        $validated['created_at'] = now();
        $harvest = Harvest::create($validated);
        foreach ($request->bed_ids as $bed_id) {
            HarvestBed::create([
                'harvest_id' => $harvest->id,
                'bed_id' => $bed_id,
            ]);
        }
        return redirect()->route('harvest.index')->with('success', 'Harvest record created successfully.');
    }

    public function show(Harvest $harvest)
    {
        $harvest->load(['creator', 'beds.bed']);
        return view('harvest.show', compact('harvest'));
    }

    public function edit(Harvest $harvest)
    {
        $beds = Bed::all();
        $harvest->load('beds');
        return view('harvest.edit', compact('harvest', 'beds'));
    }

    public function update(Request $request, Harvest $harvest)
    {
        $validated = $request->validate([
            'harvest_date' => 'required|date',
            'total_harvest_quantity' => 'required|string',
            'description' => 'nullable|string',
            'bed_ids' => 'required|array',
        ]);
        $validated['harvest_date'] = Carbon::parse($validated['harvest_date'])->format('Y-m-d');
        $harvest->update($validated);
        // Sync beds
        HarvestBed::where('harvest_id', $harvest->id)->delete();
        foreach ($request->bed_ids as $bed_id) {
            HarvestBed::create([
                'harvest_id' => $harvest->id,
                'bed_id' => $bed_id,
            ]);
        }
        return redirect()->route('harvest.index')->with('success', 'Harvest record updated successfully.');
    }

    public function destroy(Harvest $harvest)
    {
        HarvestBed::where('harvest_id', $harvest->id)->delete();
        $harvest->delete();
        return redirect()->route('harvest.index')->with('success', 'Harvest record deleted successfully.');
    }
}

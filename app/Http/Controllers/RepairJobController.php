<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepairJob;
use App\Models\Vehicle;
use App\Models\Inventory;

class RepairJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // eager load vehicle and inventory to avoid N+1 query problem
    $repairJobs = RepairJob::with(['vehicle', 'inventory'])->latest()->paginate(15);

    return view('repair-jobs.index', compact('repairJobs'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $vehicles = Vehicle::all();
    $inventories = Inventory::all();

    return view('repair-jobs.create', compact('vehicles', 'inventories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'inventory_id' => 'nullable|exists:inventories,id',
            'repair_type_manual' => 'nullable|string|max:255',
            'rate' => 'nullable|numeric',
            'amount' => 'nullable|integer',
            'total' => 'nullable|numeric',
            'status' => 'required|in:ongoing,printed',

        ]);
    
        // Calculate total if not provided
        $total = $request->total;
        if (!$total && $request->rate && $request->amount) {
            $total = $request->rate * $request->amount;
        }
    
        RepairJob::create([
            'vehicle_id' => $request->vehicle_id,
            'inventory_id' => $request->inventory_id,
            'repair_type_manual' => $request->repair_type_manual,
            'rate' => $request->rate,
            'amount' => $request->amount,
            'total' => $total,
            'status' => $request->status,
        ]);
    
        return redirect()->route('repair-jobs.index')->with('success', 'Repair job added successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $repairJob = RepairJob::with(['vehicle', 'inventory'])->findOrFail($id);

    return view('repair-jobs.show', compact('repairJob'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $repairJob = RepairJob::findOrFail($id);
    $vehicles = Vehicle::all();
    $inventories = Inventory::all();

    return view('repair-jobs.edit', compact('repairJob', 'vehicles', 'inventories'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'inventory_id' => 'nullable|exists:inventories,id',
        'repair_type_manual' => 'nullable|string|max:255',
        'rate' => 'nullable|numeric',
        'amount' => 'nullable|integer',
        'total' => 'nullable|numeric',
        'status' => 'required|in:ongoing,printed',
    ]);

    $repairJob = RepairJob::findOrFail($id);

    // Calculate total if not provided
    $total = $request->total;
    if (!$total && $request->rate && $request->amount) {
        $total = $request->rate * $request->amount;
    }

    $repairJob->update([
        'vehicle_id' => $request->vehicle_id,
        'inventory_id' => $request->inventory_id,
        'repair_type_manual' => $request->repair_type_manual,
        'rate' => $request->rate,
        'amount' => $request->amount,
        'total' => $total,
        'status' => $request->status,
    ]);

    return redirect()->route('repair-jobs.index')->with('success', 'Repair job updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

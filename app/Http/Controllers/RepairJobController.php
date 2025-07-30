<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepairJob;
use App\Models\RepairJobItem;
use App\Models\Vehicle;
use App\Models\Inventory;

class RepairJobController extends Controller
{
    public function index()
    {
        $repairJobs = RepairJob::with(['vehicle', 'items.inventory'])->latest()->paginate(15);
        return view('repair-jobs.index', compact('repairJobs'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $inventories = Inventory::all();
        return view('repair-jobs.create', compact('vehicles', 'inventories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'status' => 'required|in:ongoing,printed',

        'inventory_items.*.inventory_id' => 'required|exists:inventories,id',
        'inventory_items.*.rate' => 'nullable|numeric',
        'inventory_items.*.amount' => 'nullable|integer',
        'inventory_items.*.total' => 'nullable|numeric',

        'manual_items.*.manual_type' => 'required|string|max:255',
        'manual_items.*.rate' => 'nullable|numeric',
        'manual_items.*.amount' => 'nullable|integer',
        'manual_items.*.total' => 'nullable|numeric',
    ]);

    $repairJob = RepairJob::create([
        'vehicle_id' => $request->vehicle_id,
        'status' => $request->status,
    ]);

    // Save inventory-based items
    foreach ($request->input('inventory_items', []) as $item) {
        RepairJobItem::create([
            'repair_job_id' => $repairJob->id,
            'inventory_id' => $item['inventory_id'],
            'rate' => $item['rate'] ?? 0,
            'amount' => $item['amount'] ?? 0,
            'total' => $item['total'] ?? ($item['rate'] ?? 0) * ($item['amount'] ?? 0),
        ]);
    }

    // Save manual items
    foreach ($request->input('manual_items', []) as $item) {
        RepairJobItem::create([
            'repair_job_id' => $repairJob->id,
            'manual_type' => $item['manual_type'],
            'rate' => $item['rate'] ?? 0,
            'amount' => $item['amount'] ?? 0,
            'total' => $item['total'] ?? ($item['rate'] ?? 0) * ($item['amount'] ?? 0),
        ]);
    }

    return redirect()->route('repair-jobs.index')->with('success', 'Repair job created successfully.');
}


    public function show($id)
    {
        $repairJob = RepairJob::with(['vehicle', 'items.inventory'])->findOrFail($id);
        return view('repair-jobs.show', compact('repairJob'));
    }

    public function edit($id)
    {
        $repairJob = RepairJob::with('items')->findOrFail($id);
        $vehicles = Vehicle::all();
        $inventories = Inventory::all();

        return view('repair-jobs.edit', compact('repairJob', 'vehicles', 'inventories'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'status' => 'required|in:ongoing,printed',

        'inventory_items.*.inventory_id' => 'required|exists:inventories,id',
        'inventory_items.*.rate' => 'nullable|numeric',
        'inventory_items.*.amount' => 'nullable|integer',
        'inventory_items.*.total' => 'nullable|numeric',

        'manual_items.*.manual_type' => 'required|string|max:255',
        'manual_items.*.rate' => 'nullable|numeric',
        'manual_items.*.amount' => 'nullable|integer',
        'manual_items.*.total' => 'nullable|numeric',
    ]);

    $repairJob = RepairJob::findOrFail($id);
    $repairJob->update([
        'vehicle_id' => $request->vehicle_id,
        'status' => $request->status,
    ]);

    $repairJob->items()->delete(); // Clear old items

    // Save new inventory items
    foreach ($request->input('inventory_items', []) as $item) {
        RepairJobItem::create([
            'repair_job_id' => $repairJob->id,
            'inventory_id' => $item['inventory_id'],
            'rate' => $item['rate'] ?? 0,
            'amount' => $item['amount'] ?? 0,
            'total' => $item['total'] ?? ($item['rate'] ?? 0) * ($item['amount'] ?? 0),
        ]);
    }

    // Save new manual items
    foreach ($request->input('manual_items', []) as $item) {
        RepairJobItem::create([
            'repair_job_id' => $repairJob->id,
            'manual_type' => $item['manual_type'],
            'rate' => $item['rate'] ?? 0,
            'amount' => $item['amount'] ?? 0,
            'total' => $item['total'] ?? ($item['rate'] ?? 0) * ($item['amount'] ?? 0),
        ]);
    }

    return redirect()->route('repair-jobs.index')->with('success', 'Repair job updated successfully.');
}

public function print($id)
{
    $repairJob = RepairJob::with(['vehicle', 'items.inventory'])->findOrFail($id);
    return view('repair-jobs.print', compact('repairJob'));
}


    public function destroy($id)
    {
        $repairJob = RepairJob::findOrFail($id);
        $repairJob->items()->delete();
        $repairJob->delete();

        return redirect()->route('repair-jobs.index')->with('success', 'Repair job deleted.');
    }
}

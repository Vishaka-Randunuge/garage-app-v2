<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
{
    $query = Vehicle::query();

    if ($request->filled('search')) {
        $searchTerm = $request->input('search');
        $query->where('registration_no', 'like', "%{$searchTerm}%")
              ->orWhere('owner_name', 'like', "%{$searchTerm}%");
    }

    $vehicles = $query->latest()->get();

    return view('vehicles.index', compact('vehicles'));
}

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'registration_no' => 'required|unique:vehicles',
            'owner_name' => 'required',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully.');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'registration_no' => 'required|unique:vehicles,registration_no,' . $vehicle->id,
            'owner_name' => 'required',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function show($id)
{
    $vehicle = Vehicle::findOrFail($id);
    return view('vehicles.show', compact('vehicle'));
}
    public function destroy($id)
    {
        Vehicle::findOrFail($id)->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted.');
    }
}


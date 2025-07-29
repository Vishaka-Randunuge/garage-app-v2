<x-app-layout>
    <div class="container mx-auto max-w-3xl p-4">
        <h1 class="text-2xl font-bold mb-6">Edit Repair Job</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('repair-jobs.update', $repairJob->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="vehicle_id" class="block font-semibold mb-1">Vehicle</label>
                <select name="vehicle_id" id="vehicle_id" class="w-full border rounded p-2">
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ $repairJob->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->registration_no }} - {{ $vehicle->owner_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="inventory_id" class="block font-semibold mb-1">Repair Type (from Inventory)</label>
                <select name="inventory_id" id="inventory_id" class="w-full border rounded p-2">
                    <option value="">-- Manual Entry --</option>
                    @foreach($inventories as $inventory)
                        <option value="{{ $inventory->id }}" {{ $repairJob->inventory_id == $inventory->id ? 'selected' : '' }}>
                            {{ $inventory->part_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="repair_type_manual" class="block font-semibold mb-1">Manual Repair Type</label>
                <input type="text" name="repair_type_manual" id="repair_type_manual" class="w-full border rounded p-2" value="{{ old('repair_type_manual', $repairJob->repair_type_manual) }}">
            </div>

            <div>
                <label for="rate" class="block font-semibold mb-1">Rate</label>
                <input type="number" step="0.01" name="rate" id="rate" class="w-full border rounded p-2" value="{{ old('rate', $repairJob->rate) }}">
            </div>

            <div>
                <label for="amount" class="block font-semibold mb-1">Amount</label>
                <input type="number" name="amount" id="amount" class="w-full border rounded p-2" value="{{ old('amount', $repairJob->amount) }}">
            </div>

            <div>
                <label for="total" class="block font-semibold mb-1">Total</label>
                <input type="number" step="0.01" name="total" id="total" class="w-full border rounded p-2" value="{{ old('total', $repairJob->total) }}">
            </div>

            <div>
                <label for="status" class="block font-semibold mb-1">Status</label>
                <select name="status" id="status" class="w-full border rounded p-2">
                    <option value="ongoing" {{ $repairJob->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="printed" {{ $repairJob->status == 'printed' ? 'selected' : '' }}>Printed</option>
                </select>
            </div>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Update Repair Job</button>
            <a href="{{ route('repair-jobs.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
        </form>
    </div>
</x-app-layout>

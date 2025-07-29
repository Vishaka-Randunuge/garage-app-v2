{{-- resources/views/repair-jobs/create.blade.php --}}
<x-app-layout>
    <div class="container mx-auto max-w-3xl p-4">
        <h1 class="text-2xl font-bold mb-6">Add New Repair Job</h1>

        <form action="{{ route('repair-jobs.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label for="vehicle_id" class="block text-gray-700 font-bold mb-2">Vehicle</label>
                <select name="vehicle_id" id="vehicle_id" class="w-full border-gray-300 rounded">
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->registration_no }} - {{ $vehicle->owner_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="inventory_id" class="block text-gray-700 font-bold mb-2">Repair Inventory (Optional)</label>
                <select name="inventory_id" id="inventory_id" class="w-full border-gray-300 rounded">
                    <option value="">-- Manual Entry --</option>
                    @foreach($inventories as $inventory)
                        <option value="{{ $inventory->id }}">{{ $inventory->part_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="repair_type_manual" class="block text-gray-700 font-bold mb-2">Repair Type (Manual)</label>
                <input type="text" name="repair_type_manual" id="repair_type_manual" class="w-full border-gray-300 rounded" placeholder="If not selected from inventory">
            </div>

            <div class="mb-4">
                <label for="rate" class="block text-gray-700 font-bold mb-2">Rate</label>
                <input type="number" step="0.01" name="rate" id="rate" class="w-full border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-gray-700 font-bold mb-2">Amount</label>
                <input type="number" name="amount" id="amount" class="w-full border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <select name="status" id="status" required class="w-full border rounded p-2">
                    <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="printed" {{ old('status') == 'printed' ? 'selected' : '' }}>Printed</option>
                </select>
                
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">Save Repair Job</button>
            </div>
        </form>
    </div>
</x-app-layout>

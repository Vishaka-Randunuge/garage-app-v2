<x-app-layout>
    <div class="container mx-auto max-w-3xl p-4">
        <h1 class="text-2xl font-bold mb-6">Edit Repair Job</h1>

        <form action="{{ route('repair-jobs.update', $repairJob->id) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            {{-- Vehicle --}}
            <div class="mb-4">
                <label for="vehicle_id" class="block text-gray-700 font-bold mb-2">Vehicle</label>
                <select name="vehicle_id" class="w-full border-gray-300 rounded">
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ $repairJob->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->registration_no }} - {{ $vehicle->owner_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Inventory Items --}}
            <h3 class="font-semibold text-lg mb-2">Inventory-Based Repairs</h3>
            <div id="inventory-items">
                @foreach ($repairJob->items->whereNotNull('inventory_id') as $index => $item)
                    <div class="inventory-item border p-4 mb-2 rounded bg-gray-50">
                        <select name="inventory_items[{{ $index }}][inventory_id]" class="w-full mb-2">
                            @foreach ($inventories as $inventory)
                                <option value="{{ $inventory->id }}" {{ $inventory->id == $item->inventory_id ? 'selected' : '' }}>
                                    {{ $inventory->part_name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="inventory_items[{{ $index }}][rate]" value="{{ $item->rate }}" placeholder="Rate" class="w-full mb-2">
                        <input type="number" name="inventory_items[{{ $index }}][amount]" value="{{ $item->amount }}" placeholder="Amount" class="w-full mb-2">
                        <input type="number" name="inventory_items[{{ $index }}][total]" value="{{ $item->total }}" placeholder="Total" class="w-full mb-2">
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addInventoryItem()" class="bg-blue-600 text-white px-4 py-2 rounded mb-4">+ Add Inventory Item</button>

            {{-- Manual Items --}}
            <h3 class="font-semibold text-lg mb-2">Manual Repairs</h3>
            <div id="manual-items">
                @foreach ($repairJob->items->whereNotNull('manual_type') as $index => $item)
                    <div class="manual-item border p-4 mb-2 rounded bg-gray-50">
                        <input type="text" name="manual_items[{{ $index }}][manual_type]" value="{{ $item->manual_type }}" placeholder="Manual Repair Type" class="w-full mb-2">
                        <input type="number" name="manual_items[{{ $index }}][rate]" value="{{ $item->rate }}" placeholder="Rate" class="w-full mb-2">
                        <input type="number" name="manual_items[{{ $index }}][amount]" value="{{ $item->amount }}" placeholder="Amount" class="w-full mb-2">
                        <input type="number" name="manual_items[{{ $index }}][total]" value="{{ $item->total }}" placeholder="Total" class="w-full mb-2">
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addManualItem()" class="bg-green-600 text-white px-4 py-2 rounded mb-4">+ Add Manual Item</button>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded">
                    <option value="ongoing" {{ $repairJob->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="printed" {{ $repairJob->status == 'printed' ? 'selected' : '' }}>Printed</option>
                </select>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end">
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">Update Repair Job</button>
            </div>
        </form>
    </div>

    {{-- JS --}}
    <script>
        let inventoryIndex = {{ $repairJob->items->whereNotNull('inventory_id')->count() }};
        let manualIndex = {{ $repairJob->items->whereNotNull('manual_type')->count() }};

        function addInventoryItem() {
            const html = `
                <div class="inventory-item border p-4 mb-2 rounded bg-gray-50">
                    <select name="inventory_items[${inventoryIndex}][inventory_id]" class="w-full mb-2">
                        @foreach ($inventories as $inventory)
                            <option value="{{ $inventory->id }}">{{ $inventory->part_name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="inventory_items[${inventoryIndex}][rate]" placeholder="Rate" class="w-full mb-2">
                    <input type="number" name="inventory_items[${inventoryIndex}][amount]" placeholder="Amount" class="w-full mb-2">
                    <input type="number" name="inventory_items[${inventoryIndex}][total]" placeholder="Total" class="w-full mb-2">
                </div>
            `;
            document.getElementById('inventory-items').insertAdjacentHTML('beforeend', html);
            inventoryIndex++;
        }

        function addManualItem() {
            const html = `
                <div class="manual-item border p-4 mb-2 rounded bg-gray-50">
                    <input type="text" name="manual_items[${manualIndex}][manual_type]" placeholder="Manual Repair Type" class="w-full mb-2">
                    <input type="number" name="manual_items[${manualIndex}][rate]" placeholder="Rate" class="w-full mb-2">
                    <input type="number" name="manual_items[${manualIndex}][amount]" placeholder="Amount" class="w-full mb-2">
                    <input type="number" name="manual_items[${manualIndex}][total]" placeholder="Total" class="w-full mb-2">
                </div>
            `;
            document.getElementById('manual-items').insertAdjacentHTML('beforeend', html);
            manualIndex++;
        }
    </script>
</x-app-layout>

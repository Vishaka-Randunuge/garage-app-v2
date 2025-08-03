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
            <h3 class="font-semibold text-lg mb-2 text-red-600">Inventory-Based Repairs</h3>
            <div id="inventory-items">
                @foreach ($repairJob->items->whereNotNull('inventory_id') as $index => $item)
                    <div class="inventory-item flex space-x-2 items-center border p-4 mb-2 rounded bg-gray-50">
                        <select name="inventory_items[{{ $index }}][inventory_id]" class="flex-1 border border-gray-300 rounded px-2 py-1">
                            @foreach ($inventories as $inventory)
                                <option value="{{ $inventory->id }}" {{ $inventory->id == $item->inventory_id ? 'selected' : '' }}>
                                    {{ $inventory->part_name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="inventory_items[{{ $index }}][rate]" value="{{ $item->rate }}" placeholder="Rate" class="w-20 border border-gray-300 rounded px-2 py-1">
                        <input type="number" name="inventory_items[{{ $index }}][amount]" value="{{ $item->amount }}" placeholder="Amount" class="w-20 border border-gray-300 rounded px-2 py-1">
                        <input type="number" name="inventory_items[{{ $index }}][total]" value="{{ $item->total }}" placeholder="Total" class="w-24 border border-gray-300 rounded px-2 py-1" readonly>
                        <button type="button" onclick="removeInventoryItem(this)" class="text-red-600 font-bold text-xl leading-none ml-2">×</button>
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addInventoryItem()" class="bg-red-600 text-white px-4 py-2 rounded mb-4 hover:bg-red-700">+ Add Inventory Item</button>

            {{-- Manual Items --}}
            <h3 class="font-semibold text-lg mb-2 text-red-600">Manual Repairs</h3>
            <div id="manual-items">
                @foreach ($repairJob->items->whereNotNull('manual_type') as $index => $item)
                    <div class="manual-item flex space-x-2 items-center border p-4 mb-2 rounded bg-gray-50">
                        <input type="text" name="manual_items[{{ $index }}][manual_type]" value="{{ $item->manual_type }}" placeholder="Manual Repair Type" class="flex-1 border border-gray-300 rounded px-2 py-1">
                        <input type="number" name="manual_items[{{ $index }}][rate]" value="{{ $item->rate }}" placeholder="Rate" class="w-20 border border-gray-300 rounded px-2 py-1">
                        <input type="number" name="manual_items[{{ $index }}][amount]" value="{{ $item->amount }}" placeholder="Amount" class="w-20 border border-gray-300 rounded px-2 py-1">
                        <input type="number" name="manual_items[{{ $index }}][total]" value="{{ $item->total }}" placeholder="Total" class="w-24 border border-gray-300 rounded px-2 py-1" readonly>
                        <button type="button" onclick="removeManualItem(this)" class="text-red-600 font-bold text-xl leading-none ml-2">×</button>
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addManualItem()" class="bg-red-600 text-white px-4 py-2 rounded mb-4 hover:bg-red-700">+ Add Manual Item</button>

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

    <script>
        let inventoryIndex = {{ $repairJob->items->whereNotNull('inventory_id')->count() }};
        let manualIndex = {{ $repairJob->items->whereNotNull('manual_type')->count() }};

        function addInventoryItem() {
            const html = `
                <div class="inventory-item flex space-x-2 items-center border p-4 mb-2 rounded bg-gray-50">
                    <select name="inventory_items[${inventoryIndex}][inventory_id]" class="flex-1 border border-gray-300 rounded px-2 py-1">
                        @foreach ($inventories as $inventory)
                            <option value="{{ $inventory->id }}">{{ $inventory->part_name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="inventory_items[${inventoryIndex}][rate]" placeholder="Rate" class="w-20 border border-gray-300 rounded px-2 py-1">
                    <input type="number" name="inventory_items[${inventoryIndex}][amount]" placeholder="Amount" class="w-20 border border-gray-300 rounded px-2 py-1">
                    <input type="number" name="inventory_items[${inventoryIndex}][total]" placeholder="Total" class="w-24 border border-gray-300 rounded px-2 py-1" readonly>
                    <button type="button" onclick="removeInventoryItem(this)" class="text-red-600 font-bold text-xl leading-none ml-2">×</button>
                </div>
            `;
            document.getElementById('inventory-items').insertAdjacentHTML('beforeend', html);
            inventoryIndex++;
        }

        function addManualItem() {
            const html = `
                <div class="manual-item flex space-x-2 items-center border p-4 mb-2 rounded bg-gray-50">
                    <input type="text" name="manual_items[${manualIndex}][manual_type]" placeholder="Manual Repair Type" class="flex-1 border border-gray-300 rounded px-2 py-1">
                    <input type="number" name="manual_items[${manualIndex}][rate]" placeholder="Rate" class="w-20 border border-gray-300 rounded px-2 py-1">
                    <input type="number" name="manual_items[${manualIndex}][amount]" placeholder="Amount" class="w-20 border border-gray-300 rounded px-2 py-1">
                    <input type="number" name="manual_items[${manualIndex}][total]" placeholder="Total" class="w-24 border border-gray-300 rounded px-2 py-1" readonly>
                    <button type="button" onclick="removeManualItem(this)" class="text-red-600 font-bold text-xl leading-none ml-2">×</button>
                </div>
            `;
            document.getElementById('manual-items').insertAdjacentHTML('beforeend', html);
            manualIndex++;
        }

        function removeInventoryItem(button) {
            button.parentElement.remove();
        }

        function removeManualItem(button) {
            button.parentElement.remove();
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initial binding
            bindTotalCalculation();
    
            // When adding new items, bind their inputs too
            const originalAddInventoryItem = addInventoryItem;
            const originalAddManualItem = addManualItem;
    
            addInventoryItem = function () {
                originalAddInventoryItem();
                bindTotalCalculation();
            };
    
            addManualItem = function () {
                originalAddManualItem();
                bindTotalCalculation();
            };
    
            function bindTotalCalculation() {
                document.querySelectorAll('.inventory-item, .manual-item').forEach(container => {
                    const rate = container.querySelector('input[name*="[rate]"]');
                    const amount = container.querySelector('input[name*="[amount]"]');
                    const total = container.querySelector('input[name*="[total]"]');
    
                    if (rate && amount && total) {
                        [rate, amount].forEach(input => {
                            input.addEventListener('input', () => {
                                const rateVal = parseFloat(rate.value) || 0;
                                const amountVal = parseFloat(amount.value) || 0;
                                total.value = (rateVal * amountVal).toFixed(2);
                            });
                        });
                    }
                });
            }
        });
    </script>
    
</x-app-layout>

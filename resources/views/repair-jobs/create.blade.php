{{-- resources/views/repair-jobs/create.blade.php --}}
<x-app-layout>
    <div class="container mx-auto max-w-3xl p-4">
        <h1 class="text-2xl font-bold mb-6">Add New Repair Job</h1>

        <form action="{{ route('repair-jobs.store') }}" method="POST" class="bg-white p-6 rounded shadow" x-data="repairJobForm()">
            @csrf

            <div x-data="{ newVehicle: false, vehicles: {{ $vehicles->toJson() }}, selectedVehicleId: '', ownerName: '' }" class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Vehicle</label>
            
                <div class="mb-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" x-model="newVehicle" class="form-checkbox">
                        <span class="ml-2 text-sm text-gray-700">Add new vehicle</span>
                    </label>
                </div>
            
                <template x-if="!newVehicle">
                    <select name="vehicle_id" x-model="selectedVehicleId" @change="ownerName = (vehicles.find(v => v.id == selectedVehicleId)?.owner_name || '')" class="w-full border-gray-300 rounded">
                        <option value="">-- Select Vehicle --</option>
                        <template x-for="vehicle in vehicles" :key="vehicle.id">
                            <option :value="vehicle.id" x-text="vehicle.registration_no + ' - ' + vehicle.owner_name"></option>
                        </template>
                    </select>
                </template>
            
                <template x-if="newVehicle">
                    <div class="space-y-2 mt-2">
                        <input type="text" name="registration_no" placeholder="Vehicle Reg. No" class="w-full border-gray-300 rounded">
                        <input type="text" name="owner_name" placeholder="Owner Name" class="w-full border-gray-300 rounded" x-model="ownerName">
                    </div>
                </template>
            
                <template x-if="!newVehicle && ownerName">
                    <p class="mt-2 text-sm text-gray-600">Owner: <strong x-text="ownerName"></strong></p>
                </template>
            </div>
            

            {{-- Inventory Repair Types --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Repair Types from Inventory</label>
                <template x-for="(item, index) in inventoryItems" :key="index">
                    <div class="flex items-center space-x-2 mb-2">
                        <select :name="'inventory_items[' + index + '][inventory_id]'" class="flex-1 border-gray-300 rounded" x-model="item.inventory_id">
                            <option value="">-- Select Part --</option>
                            @foreach($inventories as $inventory)
                                <option value="{{ $inventory->id }}">{{ $inventory->part_name }}</option>
                            @endforeach
                        </select>

                        <input type="number" step="0.01" :name="'inventory_items[' + index + '][rate]'" placeholder="Rate" class="w-20 border-gray-300 rounded" x-model="item.rate">
                        <input type="number" :name="'inventory_items[' + index + '][amount]'" placeholder="Amount" class="w-20 border-gray-300 rounded" x-model="item.amount">
                        <input type="number" step="0.01" :name="'inventory_items[' + index + '][total]'" placeholder="Total" class="w-24 border-gray-300 rounded" x-model="item.total" readonly>

                        <button type="button" @click="removeInventoryItem(index)" class="text-red-600 font-bold text-xl leading-none">×</button>
                    </div>
                </template>

                <button type="button" @click="addInventoryItem()" class="text-red-600 font-semibold">+ Add Inventory Repair Type</button>
            </div>

            {{-- Manual Repair Types --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Manual Repair Types</label>
                <template x-for="(item, index) in manualItems" :key="index">
                    <div class="flex items-center space-x-2 mb-2">
                        <input type="text" :name="'manual_items[' + index + '][manual_type]'" placeholder="Repair Type" class="flex-1 border-gray-300 rounded" x-model="item.manual_type" />
                        <input type="number" step="0.01" :name="'manual_items[' + index + '][rate]'" placeholder="Rate" class="w-20 border-gray-300 rounded" x-model="item.rate">
                        <input type="number" :name="'manual_items[' + index + '][amount]'" placeholder="Amount" class="w-20 border-gray-300 rounded" x-model="item.amount">
                        <input type="number" step="0.01" :name="'manual_items[' + index + '][total]'" placeholder="Total" class="w-24 border-gray-300 rounded" x-model="item.total" readonly>

                        <button type="button" @click="removeManualItem(index)" class="text-red-600 font-bold text-xl leading-none">×</button>
                    </div>
                </template>

                <button type="button" @click="addManualItem()" class="text-red-600 font-semibold">+ Add Manual Repair Type</button>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                <select name="status" id="status" required class="w-full border-gray-300 rounded">
                    <option value="ongoing" selected>Ongoing</option>
                    <option value="printed">Printed</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">Save Repair Job</button>
            </div>
        </form>
    </div>

    <script>
        function repairJobForm() {
            return {
                inventoryItems: [
                    { inventory_id: '', rate: '', amount: '', total: '' },
                ],
                manualItems: [
                    { manual_type: '', rate: '', amount: '', total: '' },
                ],

                addInventoryItem() {
                    this.inventoryItems.push({ inventory_id: '', rate: '', amount: '', total: '' });
                },
                removeInventoryItem(index) {
                    this.inventoryItems.splice(index, 1);
                },

                addManualItem() {
                    this.manualItems.push({ manual_type: '', rate: '', amount: '', total: '' });
                },
                removeManualItem(index) {
                    this.manualItems.splice(index, 1);
                },
            }
        }
    </script>
</x-app-layout>

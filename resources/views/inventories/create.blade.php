<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Inventory
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('inventories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="part_name" class="block text-sm font-medium text-gray-700">Part Name</label>
                        <input type="text" name="part_name" id="part_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="stock_level" class="block text-sm font-medium text-gray-700">Stock Level</label>
                        <input type="number" name="stock_level" id="stock_level" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="unit_price" class="block text-sm font-medium text-gray-700">Unit Price</label>
                        <input type="text" name="unit_price" id="unit_price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                    

                    <div>
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-gray-700">Save</button>
                        <a href="{{ route('inventories.index') }}" class="ml-2 px-4 py-3 rounded text-gray-600 hover:bg-gray-300">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

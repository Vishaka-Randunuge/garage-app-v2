<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inventory Details
        </h2>
    </x-slot>

    <div class="mt-4 py-12 max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded p-6">
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Part Name:</h3>
            <p class="text-gray-900">{{ $inventory->part_name }}</p>
        </div>
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Stock Level:</h3>
            <p class="text-gray-900">{{ $inventory->stock_level }}</p>
        </div>
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Unit Price:</h3>
            <p class="text-gray-900">${{ number_format($inventory->unit_price, 2) }}</p>
        </div>
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Status:</h3>
            <p class="text-gray-900 capitalize">
                {{ str_replace('_', ' ', $inventory->status) }}
            </p>
        </div>
        <a href="{{ route('inventories.index') }}" class="text-blue-600 hover:underline">Back to list</a>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('success'))
        <div class="flex justify-center">
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4 inline-block text-center">
                {{ session('success') }}
            </div>
        </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('inventories.create') }}"
               class="mb-4 inline-block px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
               Add Inventory
            </a>

            <div class="mb-4 flex justify-between items-center">
                <form method="GET" action="{{ route('inventories.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Part Name"
                           class="border border-gray-300 rounded px-3 py-2 w-64 focus:outline-none focus:ring focus:border-red-400">
                    <button type="submit"
                            class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-red-700">
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('inventories.index') }}"
                           class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-300">
                <table class="min-w-full w-full divide-y divide-gray-300 table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 border-r border-gray-300">Part Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 border-r border-gray-300">Stock Level</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 border-r border-gray-300">Unit Price</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 border-r border-gray-300">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 border-r border-gray-300">Created At</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($inventories as $inventory)
                            <tr>
                                <td class="px-6 py-4 text-gray-800 border-r border-gray-300">{{ $inventory->part_name }}</td>
                                <td class="px-6 py-4 text-gray-800 border-r border-gray-300">{{ $inventory->stock_level }}</td>
                                <td class="px-6 py-4 text-gray-800 border-r border-gray-300">{{ $inventory->unit_price }}</td>
                                <td class="px-6 py-4 text-gray-800 border-r border-gray-300">{{ ucfirst($inventory->status) }}</td>
                                <td class="px-6 py-4 text-gray-800 border-r border-gray-300">{{ $inventory->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('inventories.show', $inventory->id) }}" class="px-2 py-2 rounded text-green-600 hover:bg-green-300">View</a>
                                    <a href="{{ route('inventories.edit', $inventory->id) }}" class="px-2 py-2 rounded text-yellow-600 hover:bg-yellow-300">Edit</a>
                                    <form action="{{ route('inventories.destroy', $inventory->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-2 rounded text-red-600 hover:bg-red-300"
                                            onclick="return confirm('Delete this inventory item?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No inventory items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

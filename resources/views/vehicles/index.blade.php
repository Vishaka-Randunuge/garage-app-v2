<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicles') }}
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
            <a href="{{ route('vehicles.create') }}"
               class="bg-primary-blue text-white px-4 py-2 rounded hover:bg-hover-blue mb-4 inline-block hover:font-bold hover:scale-110 transition-transform duration-200">
               Add Vehicle
            </a>

            <div class="mb-4 flex justify-between items-center">
                <form method="GET" action="{{ route('vehicles.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Reg No or Owner"
                           class="border border-gray-300 rounded px-3 py-2 w-64 focus:outline-none focus:ring focus:border-red-400">
                    <button type="submit"
                            class="bg-primary-brown text-white px-4 py-2 rounded hover:bg-hover-brown">
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('vehicles.index') }}"
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
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider border-r border-gray-300">
                                Registration No
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider border-r border-gray-300">
                                Owner Name
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider border-r border-gray-300">
                                Owner Contact
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider border-r border-gray-300">
                                Brand
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-900 uppercase tracking-wider w-48">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($vehicles as $vehicle)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 border-r border-gray-300">{{ $vehicle->registration_no }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 border-r border-gray-300">{{ $vehicle->owner_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 border-r border-gray-300">{{ $vehicle->owner_contact }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 border-r border-gray-300">{{ $vehicle->brand }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('vehicles.show', $vehicle->id) }}" class="px-2 py-2 rounded text-green-600 hover:scale-110 transition-transform duration-200 inline-block">View</a>
                                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="px-2 py-2 rounded text-blue-600 hover:scale-110 transition-transform duration-200 inline-block">Edit</a>
                                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-2 rounded text-red-600 hover:transition-transform hover:scale-105"
                                            onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No vehicles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

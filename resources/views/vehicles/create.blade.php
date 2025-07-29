<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Vehicle
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('vehicles.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="registration_no" class="block text-sm font-medium text-gray-700">Registration no</label>
                        <input type="text" name="registration_no" id="registration_no" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                        <input type="text" name="brand" id="brand" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="owner_name" class="block text-sm font-medium text-gray-700">Owner Name</label>
                        <input type="text" name="owner_name" id="owner_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="owner_contact" class="block text-sm font-medium text-gray-700">Owner Contact</label>
                        <input type="text" name="owner_contact" id="owner_contact" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-gray-700">Save</button>
                        <a href="{{ route('vehicles.index') }}" class="ml-2 px-4 py-3 rounded text-gray-600 hover:bg-gray-300">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

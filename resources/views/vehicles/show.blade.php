<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vehicle Details
        </h2>
    </x-slot>

    <div class="mt-4 py-12 max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded p-6">
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Registration Number:</h3>
            <p class="text-gray-900">{{ $vehicle->registration_no }}</p>
        </div>
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Owner Name:</h3>
            <p class="text-gray-900">{{ $vehicle->owner_name }}</p>
        </div>
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Owner Contact:</h3>
            <p class="text-gray-900">{{ $vehicle->owner_contact }}</p>
        </div>
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Brand:</h3>
            <p class="text-gray-900">{{ $vehicle->brand }}</p>
        </div>
        <a href="{{ route('vehicles.index') }}" class="text-blue-600 hover:underline">Back to list</a>
    </div>
</x-app-layout>

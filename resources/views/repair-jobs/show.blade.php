<x-app-layout>
    <div class="container mx-auto max-w-3xl p-4">
        <h1 class="text-2xl font-bold mb-6">Repair Job Details</h1>

        <div class="bg-white rounded shadow p-6 space-y-4">
            <div>
                <span class="font-semibold">Vehicle Registration No:</span> {{ $repairJob->vehicle->registration_no }}
            </div>

            <div>
                <span class="font-semibold">Owner Name:</span> {{ $repairJob->vehicle->owner_name }}
            </div>

            <div>
                <span class="font-semibold">Repair Type:</span>
                {{ $repairJob->inventory ? $repairJob->inventory->part_name : $repairJob->repair_type_manual }}
            </div>

            <div>
                <span class="font-semibold">Rate:</span> {{ $repairJob->rate ?? '-' }}
            </div>

            <div>
                <span class="font-semibold">Amount:</span> {{ $repairJob->amount ?? '-' }}
            </div>

            <div>
                <span class="font-semibold">Total:</span> {{ $repairJob->total ?? '-' }}
            </div>

            <div>
                <span class="font-semibold">Status:</span> <span class="capitalize">{{ $repairJob->status }}</span>
            </div>

            <div class="pt-4 flex space-x-4">
                <a href="{{ route('repair-jobs.edit', $repairJob->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
                <a href="{{ route('repair-jobs.index') }}" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Back to List</a>
            </div>
        </div>
    </div>
</x-app-layout>

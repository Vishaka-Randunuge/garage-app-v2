{{-- resources/views/repair-jobs/index.blade.php --}}
<x-app-layout>
    <div class="container mx-auto max-w-5xl p-4">
        <h1 class="text-2xl font-bold mb-6">Repair Jobs</h1>

        <a href="{{ route('repair-jobs.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 mb-4 inline-block">Add New Repair Job</a>

        @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border rounded overflow-hidden">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="py-2 px-4 border">Vehicle Reg No</th>
                    <th class="py-2 px-4 border">Owner Name</th>
                    <th class="py-2 px-4 border">Repair Type</th>
                    <th class="py-2 px-4 border">Rate</th>
                    <th class="py-2 px-4 border">Amount</th>
                    <th class="py-2 px-4 border">Total</th>
                    <th class="py-2 px-4 border">Status</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($repairJobs as $job)
                    <tr class="text-center border-b">
                        <td class="py-2 px-4 border">{{ $job->vehicle->registration_no }}</td>
                        <td class="py-2 px-4 border">{{ $job->vehicle->owner_name }}</td>
                        <td class="py-2 px-4 border">
                            {{ $job->inventory ? $job->inventory->part_name : $job->repair_type_manual }}
                        </td>
                        <td class="py-2 px-4 border">{{ $job->rate ?? '-' }}</td>
                        <td class="py-2 px-4 border">{{ $job->amount ?? '-' }}</td>
                        <td class="py-2 px-4 border">{{ $job->total ?? '-' }}</td>
                        <td class="py-2 px-4 border capitalize">{{ $job->status }}</td>
                        <td class="py-2 px-4 border space-x-2">
                            <a href="{{ route('repair-jobs.edit', $job->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('repair-jobs.destroy', $job->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this repair job?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $repairJobs->links() }}
        </div>
    </div>
</x-app-layout>

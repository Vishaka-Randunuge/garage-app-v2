{{-- resources/views/repair-jobs/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Repair Jobs') }}
        </h2>
    </x-slot>
    <div class="py-12">
    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
        

        <a href="{{ route('repair-jobs.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 mb-4 inline-block">Add New Repair Job</a>

        <div class="mb-4 flex justify-between items-center">
            <form method="GET" action="{{ route('repair-jobs.index') }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Reg No or Owner"
                       class="border border-gray-300 rounded px-3 py-2 w-64 focus:outline-none focus:ring focus:border-red-400">
                <button type="submit"
                        class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-red-700">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('repair-jobs.index') }}"
                       class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                        Reset
                    </a>
                @endif
            </form>
        </div>
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

                        <td class="py-2 px-4 border text-left">
                            <ul class="list-disc pl-4">
                                @foreach($job->items as $item)
                                    <li>{{ $item->inventory ? $item->inventory->part_name : $item->manual_type }}</li>
                                @endforeach
                            </ul>
                        </td>

                        <td class="py-2 px-4 border">
                            @foreach($job->items as $item)
                                <div>{{ $item->rate ?? '-' }}</div>
                            @endforeach
                        </td>

                        <td class="py-2 px-4 border">
                            @foreach($job->items as $item)
                                <div>{{ $item->amount ?? '-' }}</div>
                            @endforeach
                        </td>

                        <td class="py-2 px-4 border font-semibold">
                            {{ $job->items->sum('total') ?? '-' }}
                        </td>

                        <td class="py-2 px-4 border capitalize">
                            {{ $job->status }}
                        </td>

                        <td class="py-2 px-4 border space-y-2">
                            <a href="{{ route('repair-jobs.print', $job->id) }}" 
                               target="_blank" 
                               class="text-green-600 hover:transition-transform hover:scale-105 block">
                                Print
                            </a>

                            <a href="{{ route('repair-jobs.edit', $job->id) }}" 
                               class="text-blue-600 hover:transition-transform hover:scale-105 block">
                                Edit
                            </a>

                            <form action="{{ route('repair-jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Delete this repair job?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:transition-transform hover:scale-105">Delete</button>
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
    </div>
</x-app-layout>

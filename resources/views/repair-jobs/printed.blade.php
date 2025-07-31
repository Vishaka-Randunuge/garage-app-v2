<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Printed Invoices</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-4 shadow-md rounded">

            {{-- Search form --}}
            <div class="mb-4 flex justify-between items-center">
                <form method="GET" action="{{ route('repair-jobs.printed') }}" class="flex gap-2">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search by Reg No or Owner"
                        class="border border-gray-300 rounded px-3 py-2 w-64 focus:outline-none focus:ring focus:border-red-400"
                    >
                    <button 
                        type="submit"
                        class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-red-700"
                    >
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('repair-jobs.printed') }}"
                           class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            @if ($printedJobs->isEmpty())
                <p>No printed invoices found.</p>
            @else
                <table class="w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Invoice ID</th>
                            <th class="border px-4 py-2">Vehicle</th>
                            <th class="border px-4 py-2">Owner</th>
                            <th class="border px-4 py-2">Date</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($printedJobs as $job)
                            <tr>
                                <td class="border px-4 py-2">{{ $job->id }}</td>
                                <td class="border px-4 py-2">{{ $job->vehicle->registration_no ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $job->vehicle->owner_name ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $job->created_at->format('Y-m-d') }}</td>
                                <td class="border px-4 py-2 text-green-600 font-semibold">{{ ucfirst($job->status) }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('repair-jobs.show', $job->id) }}" class="text-blue-500 hover:underline">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>

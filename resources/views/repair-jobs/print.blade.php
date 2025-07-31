<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Repair Job #') . $repairJob->id }} - Print View
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-4xl mx-auto bg-white p-6 border border-gray-300 rounded">
            <h2 class="text-xl font-bold mb-4">Repair Job Details</h2>

            <p><strong>Vehicle:</strong> {{ $repairJob->vehicle->registration_no ?? '-' }}</p>
            <p><strong>Owner:</strong> {{ $repairJob->vehicle->owner_name ?? '-' }}</p>

            <p><strong>Status:</strong> {{ ucfirst($repairJob->status) }}</p>

            <table class="w-full mt-6 border border-collapse border-gray-400">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">Repair Type</th>
                        <th class="border px-4 py-2">Rate (Rs.)</th>
                        <th class="border px-4 py-2">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach ($repairJob->items as $index => $item)
                        @php $grandTotal += $item->total; @endphp
                        <tr>
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">
                                {{ $item->inventory->name ?? $item->manual_type ?? '-' }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $item->rate > 0 ? 'Rs. ' . number_format($item->rate, 2) : '' }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $item->amount > 0 ? $item->amount : '' }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-100 font-bold">
                        <td colspan="3" class="border px-4 py-2 text-right">Total (Rs.)</td>
                        <td>
                            @if($item->rate && $item->rate != 0)
                                Rs. {{ number_format($item->rate, 2) }}
                            @endif
                        </td>
                        
                    </tr>
                </tbody>
            </table>

            <div class="mt-6 flex justify-between">
                <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 print:hidden">
                    🖨️ Print
                </button>
                <a href="{{ route('repair-jobs.show', $repairJob->id) }}" class="text-sm text-blue-500 underline print:hidden">Back to View</a>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .print\:hidden { display: none !important; }
            body { background: white !important; }
        }
    </style>

<script>
    document.getElementById('printBtn').addEventListener('click', function() {
        window.print(); // open print dialog
    
        // After print dialog opens, send AJAX to mark as printed
        fetch("{{ route('repair-jobs.markPrinted', $repairJob->id) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({}),
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            // Optionally, you could show a small confirmation or update the UI
        })
        .catch(error => {
            console.error('Error updating status:', error);
        });
    });
    </script>
</x-app-layout>

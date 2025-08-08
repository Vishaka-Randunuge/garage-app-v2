<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Repair Job #') . $repairJob->id }} - Print View
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-4xl mx-auto bg-white p-6 border border-gray-300 rounded">

            <!-- Content hidden on screen, visible only on print -->
        <div class="hidden-print text-center mb-6">
            <h1 class="text-3xl font-extrabold uppercase">P.M.<span class="text-red-600">MOTORS</span></h1>
            <p class="mt-1 font-semibold">All kinds of Vehicle <span class="text-red-600">Spare Parts & Repairs</span></p>
            <p>And Lubricant</p>
            <p>100/1, Malapalla, Pannipitya</p>
            <p>Tel: 0715567420 | 0703334334</p>
        </div>


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
                                {{ $item->inventory->part_name ?? $item->manual_type ?? '-' }}
                            </td>
                            <td class="border px-4 py-2 text-right">
                                {{ $item->rate > 0 ? 'Rs. ' . number_format($item->rate, 2) : '' }}
                            </td>
                            <td class="border px-4 py-2 text-right">
                                {{ $item->amount > 0 ? number_format($item->amount, 2) : '' }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-100 font-bold">
                        <td colspan="3" class="border px-4 py-2 text-right">Total (Rs.)</td>
                        <td class="border px-4 py-2 text-right">
                            @if($grandTotal != 0)
                                Rs. {{ number_format($grandTotal, 2) }}
                            @else
                                {{-- Show nothing if total is 0 --}}
                            @endif
                        </td>
                    </tr>
                    
                </tbody>
                
            </table>

            <div class="hidden-print mt-8" style="max-width: 160px;">
                <hr style="border: none; border-bottom: 1px dotted black; margin: 0 0 0.25rem 0;" />
                <p class="italic" style="margin: 0;">(authorized signature)</p>
              </div>
              
            
            <div class="mt-6 flex justify-between">
                <!-- Print Button -->
                <button onclick="window.print()" class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-800 print:hidden transition-transform hover:scale-105">
                    Print
                </button>
            
                <!-- Back to View Link -->
                <a href="{{ route('repair-jobs.show', $repairJob->id) }}" class="text-sm text-red-500 flex items-center gap-1 print:hidden hover:text-black">
                    ← Back
                </a>
            </div>
            
        </div>
    </div>

    <style>
        @media print {
            .print\:hidden { display: none !important; }
            body { background: white !important; }
        }

        @media screen {
        .hidden-print {
            display: none !important;
        }
        }
        @media print {
        .hidden-print {
            display: block !important;
        }
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
            })
            .catch(error => {
                console.error('Error updating status:', error);
            });
        });
    </script>
</x-app-layout>

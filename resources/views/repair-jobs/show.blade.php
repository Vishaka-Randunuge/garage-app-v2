<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Repair Job Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-md sm:rounded-lg">

                <a href="{{ route('repair-jobs.index') }}" class="text-blue-500 hover:underline mb-4 inline-block">← Back to List</a>

                <h3 class="text-lg font-bold mb-4">Repair Job ID: {{ $repairJob->id }}</h3>

                <div class="mb-6">
                    <p><strong>Vehicle:</strong> {{ $repairJob->vehicle->registration_no }}</p>
                    <p><strong>Owner:</strong> {{ $repairJob->vehicle->owner_name }}</p>
                </div>

                <h4 class="text-md font-semibold mb-3">Repair Items</h4>
                <table class="w-full border text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Quantity</th>
                            <th class="border px-4 py-2 text-left">Description</th>
                            <th class="border px-4 py-2 text-left">Rate (Rs.)</th>
                            <th class="border px-4 py-2 text-left">Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @forelse ($repairJob->items as $item)
                            @php
                                $qty = $item->quantity ?? 1;
                                $rate = $item->rate ?? 0;
                                $amount = $item->amount ?? ($qty * $rate);
                                $description = $item->manual_type ?? $item->inventory->name ?? '-';
                                $grandTotal += $amount;
                            @endphp
                            <tr>
                                <td class="border px-4 py-2">{{ $qty }}</td>
                                <td class="border px-4 py-2">{{ $description }}</td>
                                <td class="border px-4 py-2">Rs. {{ number_format($rate, 2) }}</td>
                                <td class="border px-4 py-2">Rs. {{ number_format($amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center border px-4 py-4">No repair items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-100 font-semibold">
                            <td colspan="3" class="border px-4 py-2 text-right">Total</td>
                            <td class="border px-4 py-2">Rs. {{ number_format($grandTotal, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>


                <!-- Print Button -->
                <a href="{{ route('repair-jobs.print', $repairJob->id) }}" 
                    class="mt-4 inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                     🖨️ Print
                 </a>
                 
            </div>
        </div>
    </div>
</x-app-layout>

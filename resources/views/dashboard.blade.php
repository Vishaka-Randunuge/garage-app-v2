<x-app-layout>
    <x-slot name="header">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-12 gap-4">
                
                <!-- Left: Empty space for future (3 columns) -->
                <div class="col-span-12 lg:col-span-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                        <p class="text-gray-600 mb-4">You can add new repairs, vehicles, and inventories here.</p>
                
                        <div class="flex flex-col gap-2">
                            <a href="http://127.0.0.1:8000/repair-jobs/create" 
                               class="bg-blue-500 hover:bg-blue-600 text-white text-center py-5 px-4 rounded">
                               Add Repair Job
                            </a>
                            <a href="http://127.0.0.1:8000/vehicles/create" 
                               class="bg-green-500 hover:bg-green-600 text-white text-center py-5 px-4 rounded">
                               Add Vehicle
                            </a>
                            <a href="http://127.0.0.1:8000/inventories/create" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white text-center py-5 px-4 rounded">
                               Add Inventory
                            </a>
                            
                        </div>
                        

                    </div>
                </div>
                

                <!-- Right: Quick Stats (9 columns) -->
                <div class="col-span-12 lg:col-span-9">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-4">Stats to look out</h3>
                            <div id="statsDisplay" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Cards inserted dynamically -->
                            </div>
    
                            <div class="flex flex-wrap mt-6">
                                <button onclick="showStats('today')" class="px-4 py-2 bg-red-300 text-white hover:bg-red-500">Today</button>
                                <button onclick="showStats('week')" class="px-4 py-2 bg-red-400 text-white hover:bg-red-600">This Week</button>
                                <button onclick="showStats('month')" class="px-4 py-2 bg-red-500 text-white hover:bg-red-700">This Month</button>
                                <button onclick="showStats('year')" class="px-4 py-2 bg-red-600 text-white hover:bg-red-800">This Year</button>
                            </div>
                        </div>
                    </div>
                </div>
    
    
            </div>
        </div>
    </div>
    
    
    <div class="py-12 pt-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Quick Access</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    
                        <a href="{{ url('/repair-jobs') }}"
                            class="block p-4 bg-zinc-950 hover:bg-zinc-800 text-white font-semibold rounded shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
                            <i class="fa-solid fa-screwdriver-wrench text-2xl mb-2 block"></i>
                            Repair Jobs
                        </a>

                        <a href="{{ url('/printed') }}"
                            class="block p-4 bg-zinc-950 hover:bg-zinc-800 text-white font-semibold rounded shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
                            <i class="fa-solid fa-print text-2xl mb-2 block"></i>
                            Printed Invoices
                        </a>

                        <a href="{{ url('/vehicles') }}"
                            class="block p-4 bg-zinc-950 hover:bg-zinc-800 text-white font-semibold rounded shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
                            <i class="fa-solid fa-car text-2xl mb-2 block"></i>
                            Vehicles
                        </a>

                        <a href="{{ url('/inventories') }}"
                            class="block p-4 bg-zinc-950 hover:bg-zinc-800 text-white font-semibold rounded shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
                            <i class="fa-solid fa-box-archive text-2xl mb-2 block"></i>
                            Inventories
                        </a>


    
                    </div>

                    
    
                    <div class="mt-6 text-sm text-gray-600">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col-span-12 lg:col-span-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 h-full">
            <h3 class="text-lg font-semibold mb-4">Ongoing Repair Jobs</h3>
    
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Date Added</th>
                        <th class="px-4 py-2">Owner</th>
                        <th class="px-4 py-2 text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ongoingJobs as $job)
                        <tr class="border-b">
                            <td class="px-4 py-2">
                                {{ $job->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $job->vehicle->owner->name ?? 'Unknown' }}
                            </td>
                            <td class="px-4 py-2 text-right">
                                <a href="{{ url('/repair-jobs/' . $job->id . '/edit') }}" 
                                   class="text-blue-500 hover:underline">
                                   Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500">
                                No ongoing repair jobs.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div> --}}
    
    
    
    
    <script>
        const stats = {
            today: {
                jobs: {{ $dailyJobs }},
                revenue: {{ $dailyRevenue }},
                vehicles: {{ $dailyVehicles }}
            },
            week: {
                jobs: {{ $weeklyJobs }},
                revenue: {{ $weeklyRevenue }},
                vehicles: {{ $weeklyVehicles }}
            },
            month: {
                jobs: {{ $monthlyJobs }},
                revenue: {{ $monthlyRevenue }},
                vehicles: {{ $monthlyVehicles }}
            },
            year: {
                jobs: {{ $yearlyJobs }},
                revenue: {{ $yearlyRevenue }},
                vehicles: {{ $yearlyVehicles }}
            }
        };
    
        function showStats(period) {
            const container = document.getElementById('statsDisplay');
            const data = stats[period];
    
            container.innerHTML = `
            <div class="aspect-[4/3] p-4 rounded-2xl border border-[#DA9488] bg-[#dc2626] flex flex-col justify-between">
                <h2 class="text-lg font-semibold text-gray-200 text-left">Repair Jobs</h2>
                <p class="text-3xl font-bold text-black text-center">${data.jobs}</p>
            </div>

            <div class="aspect-[4/3] p-4 rounded-2xl border border-[#DA9488] bg-[#dc2626] flex flex-col justify-between">
                <h2 class="text-lg font-semibold text-gray-200 text-left">Revenue</h2>
                <p class="text-3xl font-bold text-black text-center">LKR ${Number(data.revenue).toFixed(2)}</p>
            </div>

            <div class="aspect-[4/3] p-4 rounded-2xl border border-[#DA9488] bg-[#dc2626] flex flex-col justify-between">
                <h2 class="text-lg font-semibold text-gray-200 text-left">New Vehicles</h2>
                <p class="text-3xl font-bold text-black text-center">${data.vehicles}</p>
            </div>




            `;
        }
    
        // Default to today
        showStats('today');

        
    </script>
    

    
</x-app-layout>


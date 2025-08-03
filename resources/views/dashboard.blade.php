<x-app-layout>
    <x-slot name="header">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Quick Access</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    
                        <a href="{{ url('/repair-jobs') }}"
                            class="block p-4 bg-zinc-200 hover:bg-gray-100 text-black font-semibold rounded shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
                            <i class="fa-solid fa-screwdriver-wrench text-2xl mb-2 block"></i>
                            Repair Jobs
                        </a>

                        <a href="{{ url('/printed') }}"
                            class="block p-4 bg-zinc-200 hover:bg-gray-100 text-black font-semibold rounded shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
                            <i class="fa-solid fa-print text-2xl mb-2 block"></i>
                            Printed Invoices
                        </a>

                        <a href="{{ url('/vehicles') }}"
                            class="block p-4 bg-zinc-200 hover:bg-gray-100 text-black font-semibold rounded shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
                            <i class="fa-solid fa-car text-2xl mb-2 block"></i>
                            Vehicles
                        </a>

                        <a href="{{ url('/inventories') }}"
                            class="block p-4 bg-zinc-200 hover:bg-gray-100 text-black font-semibold rounded shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">📌 Quick Stats Toggle</h3>
    
                    <div class="flex flex-wrap gap-4 mb-6">
                        <button onclick="showStats('today')" class="px-4 py-2 bg-red-300 text-white rounded hover:bg-red-500">Today</button>
                        <button onclick="showStats('week')" class="px-4 py-2 bg-red-400 text-white rounded hover:bg-red-600">This Week</button>
                        <button onclick="showStats('month')" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">This Month</button>
                        <button onclick="showStats('year')" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-800">This Year</button>
                    </div>
    
                    <div id="statsDisplay" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Cards will be inserted dynamically -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
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
            <div class="p-4 rounded border border-red-300 shadow-sm text-center" style="box-shadow: 0 0 8px rgba(239, 68, 68, 0.4);">
                <h2 class="text-lg font-semibold text-gray-900"> Repair Jobs</h2>
                <p class="text-2xl font-bold text-gray-800">${data.jobs}</p>
            </div>
            <div class="p-4 rounded border border-red-300 shadow-sm text-center" style="box-shadow: 0 0 8px rgba(239, 68, 68, 0.4);">
                <h2 class="text-lg font-semibold text-gray-900">Revenue</h2>
                <p class="text-2xl font-bold text-gray-800">LKR ${Number(data.revenue).toFixed(2)}</p>
            </div>
            <div class="p-4 rounded border border-red-300 shadow-sm text-center" style="box-shadow: 0 0 8px rgba(239, 68, 68, 0.4);">
                <h2 class="text-lg font-semibold text-gray-900">New Vehicles</h2>
                <p class="text-2xl font-bold text-gray-800">${data.vehicles}</p>
            </div>

            `;
        }
    
        // Default to today
        showStats('today');
    </script>
    

    
</x-app-layout>


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
                               class="bg-primary-purple hover:bg-hover-purple text-white text-center py-5 px-4 rounded transition-transform duration-200 hover:scale-105">
                               Add Repair Job
                            </a>
                            <a href="http://127.0.0.1:8000/vehicles/create" 
                               class="bg-primary-blue hover:bg-hover-blue text-white text-center py-5 px-4 rounded transition-transform duration-200 hover:scale-105">
                               Add Vehicle
                            </a>
                            <a href="http://127.0.0.1:8000/inventories/create" 
                               class="bg-primary-teal hover:bg-hover-teal text-white text-center py-5 px-4 rounded transition-transform duration-200 hover:scale-105">
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
    
                            <div class="flex flex-wrap mt-6 divide-x divide-dashed divide-hover-blue">
                                <button onclick="showStats('today')" class="px-4 py-2 text-hover-blue hover:scale-105 transition-transform">Today</button>
                                <button onclick="showStats('week')" class="px-4 py-2 text-hover-blue hover:scale-105 transition-transform">This Week</button>
                                <button onclick="showStats('month')" class="px-4 py-2 text-hover-blue hover:scale-105 transition-transform">This Month</button>
                                <button onclick="showStats('year')" class="px-4 py-2 text-hover-blue hover:scale-105 transition-transform">This Year</button>
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
              <h3 class="text-lg font-bold mb-4">Quick Access to Lists</h3>
      
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left col: buttons stacked in one column -->
                <div class="flex flex-col gap-4">
                  <a href="{{ url('/repair-jobs') }}"
                     class="block p-4 bg-primary-brown hover:bg-hover-brown text-white font-semibold rounded-full shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
                    Repair Jobs
                  </a>
      
                  <a href="{{ url('/printed') }}"
                     class="block p-4 bg-primary-brown hover:bg-hover-brown text-white font-semibold rounded-full shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
                    Printed Invoices
                  </a>
      
                  <a href="{{ url('/vehicles') }}"
                     class="block p-4 bg-primary-brown hover:bg-hover-brown text-white font-semibold rounded-full shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
                    Vehicles
                  </a>
      
                  <a href="{{ url('/inventories') }}"
                     class="block p-4 bg-primary-brown hover:bg-hover-brown text-white font-semibold rounded-full shadow hover:shadow-lg transform hover:scale-105 transition-all duration-200 text-center">
                    Inventories
                  </a>
                </div>
      
                <!-- Right col: empty for now, you can add content here -->
                <div>
                    <canvas id="statsChart"></canvas>
                </div>
              </div>
      
              {{-- <div class="mt-6 text-sm text-gray-600">
                {{ __("You're logged in!") }}
              </div> --}}
            </div>
          </div>
        </div>
      </div>
      

      <div class="py-12 pt-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Ongoing Repair Jobs -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-bold mb-4">Ongoing Repair Jobs</h3>
                
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border">Vehicle No</th>
                                    <th class="px-4 py-2 border">Owner</th>
                                    <th class="px-4 py-2 border">Created At</th>
                                    <th class="px-4 py-2 border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ongoingJobs as $job)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border">{{ $job->vehicle->registration_no ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ $job->vehicle->owner_name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ $job->created_at->format('Y-m-d') }}</td>
                                        <td class="px-4 py-2 border text-center">
                                            <a href="{{ url('/repair-jobs/' . $job->id . '/edit') }}"
                                               class="text-red-500 hover:font-bold transform transition duration-200">
                                               Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 border text-center text-gray-500">
                                            No ongoing jobs found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
    
                <!-- Low Inventory -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-bold mb-4">Low Inventory</h3>
                    <ul class="divide-y divide-gray-200">
                        @foreach ($lowInventory as $item)
                            <li class="py-3">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold">{{ $item->part_name }}</span>
                                    <span class="text-sm text-red-500">Stock: {{ $item->stock_level }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
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
            <div class="aspect-[4/3] p-4 rounded-2xl bg-hover-blue shadow-[0_0_10px_theme('colors.primary-blue')] flex flex-col">
                <h2 class="text-lg font-semibold text-white">Repair Jobs</h2>
                <div class="flex-1 flex items-center justify-center">
                    <p class="text-3xl font-bold text-black">${data.jobs}</p>
                </div>
            </div>

            <div class="aspect-[4/3] p-4 rounded-2xl bg-hover-blue shadow-[0_0_10px_theme('colors.primary-blue')] flex flex-col">
                <h2 class="text-lg font-semibold text-gray-200">Revenue</h2>
                <div class="flex-1 flex items-center justify-center">
                    <p class="text-3xl font-bold text-black">LKR ${Number(data.revenue).toFixed(2)}</p>
                </div>
            </div>

            <div class="aspect-[4/3] p-4 rounded-2xl bg-hover-blue shadow-[0_0_10px_theme('colors.primary-blue')] flex flex-col">
                <h2 class="text-lg font-semibold text-gray-200">New Vehicles</h2>
                <div class="flex-1 flex items-center justify-center">
                    <p class="text-3xl font-bold text-black">${data.vehicles}</p>
                </div>
            </div>





            `;
        }
    
        // Default to today
        showStats('today');



        const ctx = document.getElementById('statsChart').getContext('2d');

        const statsChartData = {
            labels: ['Today', 'This Week', 'This Month', 'This Year'],
            datasets: [
                {
                    label: 'Repair Jobs',
                    data: [stats.today.jobs,stats.week.jobs,stats.month.jobs,stats.year.jobs],
                    borderColor: '#afd4cc', // green
                    fill: false
                },
                {
                    label: 'Vehicles',
                    data: [stats.today.vehicles,stats.week.vehicles,stats.month.vehicles,stats.year.vehicles],
                    borderColor: '#74a5bc', // blue
                    fill: false
                },
                {
                    label: 'Printed Invoices',
                    data: [{{ $dailyPrintedJob }},{{ $weeklyPrintedJob }},{{ $monthlyPrintedJob }},{{ $yearlyPrintedJob }}],
                    borderColor: '#706f9a', // ash purple
                    fill: false
                },
                {
                    label: 'Inventories',
                    data: [{{ $dailyInventories }},{{ $weeklyInventories }},{{ $monthlyInventories }},{{ $yearlyInventories }}],
                    borderColor: '#cfa385', // brown
                    fill: false
                }
            ]
        };

        new Chart(ctx, {
            type: 'line',
            data: statsChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Business Progress' }
                }
            }
        });

        
    </script>
    

    
</x-app-layout>


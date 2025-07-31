<x-app-layout>
    <x-slot name="header">
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
                        <a href="{{ url('/repair-jobs') }}" class="block p-4 bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold rounded shadow text-center">
                            🛠️ Repair Jobs
                        </a>
                        <a href="{{ url('/printed') }}" class="block p-4 bg-green-100 hover:bg-green-200 text-green-800 font-semibold rounded shadow text-center">
                            🧾 Printed Invoices
                        </a>
                        <a href="{{ url('/vehicles') }}" class="block p-4 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-semibold rounded shadow text-center">
                            🚗 Vehicles
                        </a>
                        <a href="{{ url('/inventories') }}" class="block p-4 bg-purple-100 hover:bg-purple-200 text-purple-800 font-semibold rounded shadow text-center">
                            📦 Inventories
                        </a>
                    </div>

                    <div class="mt-6">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>

                <div class="mt-4">
                    <a href="{{ route('users.edit', $user->id) }}"
                       class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        Edit
                    </a>
                    <a href="{{ route('users.index') }}"
                       class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Back
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

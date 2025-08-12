<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-4 flex justify-between items-center">
                    <h3 class="text-lg font-bold">User List</h3>
                    <a href="{{ route('users.create') }}"
                       class="bg-primary-brown text-white px-4 py-2 rounded hover:bg-hover-brown">
                        + Add User
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Role</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="px-4 py-2 border">{{ $user->name }}</td>
                                <td class="px-4 py-2 border">{{ $user->email }}</td>
                                <td class="px-4 py-2 border capitalize">{{ $user->role }}</td>
                                <td class="px-4 py-2 border text-center">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="px-4 py-2 text-yellow-500 hover:scale-110 transition-transform duration-200 inline-block">
                                         Edit
                                     </a>
                                     
                                     <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit"
                                                 onclick="return confirm('Delete this user?')"
                                                 class="px-2 py-2 text-red-500 hover:scale-110 transition-transform duration-200 inline-block">
                                             Delete
                                         </button>
                                     </form>
                                     
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>

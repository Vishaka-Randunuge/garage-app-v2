<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to P.M.Motors</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFDFC] text-[#1b1b18] min-h-screen flex items-center justify-center p-6">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 max-w-7xl w-full items-center">
        <!-- Left Column -->
        <div class="space-y-6 px-4 lg:px-0">
            <h1 class="text-4xl font-bold">Welcome to <span class="text-primary-teal">P.M.<span class="text-primary-brown">Motors</span></span></h1>
            <p class="text-gray-600">From everyday maintenance to specialized components, find everything you need right here!</p>
            
            <div class="flex space-x-4">
                <a href="{{ route('login') }}"
                   class="bg-primary-brown hover:bg-hover-brown text-white px-6 py-2 rounded shadow transition">
                    Log in
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="border border-primary-brown hover:text-primary-brown text-[#1b1b18] px-6 py-2 rounded transition">
                    Register
                </a>
                @endif
            </div>
        </div>

        <!-- Right Column -->
        <div class="flex justify-center">
            <img src="{{ asset('images/garage.jpg') }}" alt="Garage" class="rounded-xl shadow-lg max-h-[400px] w-full object-cover">
        </div>
    </div>

</body>
</html>

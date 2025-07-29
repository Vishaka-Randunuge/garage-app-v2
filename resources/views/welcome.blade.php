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
            <h1 class="text-4xl font-bold text-[#1b1b18]">Welcome to <span class="text-red-600">P.M.Motors</span></h1>
            <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula, lacus nec fringilla cursus, sapien orci mattis velit.</p>
            
            <div class="flex space-x-4">
                <a href="{{ route('login') }}"
                   class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded shadow transition">
                    Log in
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="border border-gray-400 hover:border-red-600 text-[#1b1b18] px-6 py-2 rounded transition">
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

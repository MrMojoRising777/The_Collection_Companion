<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Include the compiled Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="container mx-auto p-4 bg-gray-100 dark:bg-gray-900">
        <div class="flex justify-end space-x-2">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a>
            @else
                <button class="hover:bg-red-500 hover:text-white text-black bg-transparent font-bold py-2 px-4 rounded-full" onclick="window.location='{{ route('login') }}'">
                    Log in
                </button>
                @if (Route::has('register'))
                    <button class="hover:bg-red-500 hover:text-white text-black bg-transparent font-bold py-2 px-4 rounded-full" onclick="window.location='{{ route('register') }}'">Register</button>
                @endif
            @endauth
        </div>        

        <img src="{{ asset('images/sw_welcome.jpeg') }}" alt="Description" class="mx-auto rounded-lg shadow-md max-w-full h-auto mt-4">
    </div>

    <!-- Your custom scripts -->

</body>
</html>

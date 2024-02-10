<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="container mx-auto p-4 bg-gray-100 dark:bg-gray-900">
            <div class="flex justify-end space-x-2">
                <button class="hover:bg-red-500 hover:text-white text-black bg-transparent font-bold py-2 px-4 rounded-full" onclick="window.location='{{ route('login') }}'">
                    Log in
                </button>
                @if (Route::has('register'))
                    <button class="hover:bg-red-500 hover:text-white text-black bg-transparent font-bold py-2 px-4 rounded-full" onclick="window.location='{{ route('register') }}'">Register</button>
                @endif
            </div>
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

                <!-- Image -->
                <div>
                    <img src="{{ asset('images/sw_welcome.jpeg') }}" alt="Description" class="mx-auto rounded-lg shadow-md max-w-full h-auto mt-4">
                </div>
    
                <!-- Content -->
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>

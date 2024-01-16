<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Include the compiled Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Your custom styles (if any) -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="antialiased bg-light text-dark">
    <div class="container mx-auto">
        @if (Route::has('login'))
            <div class="fixed top-0 right-0 p-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-blue-500 text-white p-2 rounded">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-500 text-white p-2 rounded">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-500 text-white p-2 ml-2 rounded">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <!-- Your content goes here -->

    </div>

    <!-- Your custom scripts -->

</body>
</html>

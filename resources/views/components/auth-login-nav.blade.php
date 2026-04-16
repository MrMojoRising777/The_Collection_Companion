<div class="flex justify-end space-x-2 m-2">
    <button class="bg-red-300 hover:bg-red-500 hover:text-white text-black font-bold py-2 px-4 rounded-full"
            onclick="window.location='{{ route('login') }}'">
        Inloggen
    </button>

    @if (Route::has('register'))
        <button class="bg-red-300 text-black hover:bg-red-500 hover:text-white font-bold py-2 px-4 rounded-full"
                onclick="window.location='{{ route('register') }}'">
            Registeren
        </button>
    @endif
</div>

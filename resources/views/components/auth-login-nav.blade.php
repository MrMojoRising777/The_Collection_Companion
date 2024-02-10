<div class="flex justify-end space-x-2">
  <button class="hover:bg-red-500 hover:text-white text-black bg-transparent font-bold py-2 px-4 rounded-full"
    onclick="window.location='{{ route('login') }}'">
    Inloggen
  </button>
  @if (Route::has('register'))
    <button class="hover:bg-red-500 hover:text-white text-black bg-transparent font-bold py-2 px-4 rounded-full"
      onclick="window.location='{{ route('register') }}'">
      Registeren
    </button>
  @endif
</div>

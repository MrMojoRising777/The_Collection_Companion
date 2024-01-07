@extends('layouts.app')

@section('content')
  <h1 class="text-4xl font-bold mb-2 ml-4 text-white dark:text-gray-800">
    Comics
  </h1>

  <div x-data="{ open: false }" class="relative inline-block text-left mt-4 ml-4">
    {{-- dropdown button --}}
    <button @click="open = !open" type="button" class="inline-flex justify-center w-40 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring focus:border-blue-300 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150">
      Series
      <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 11.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
      </svg>
    </button>

    {{-- dropdown items --}}
    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
      <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
        @foreach ($abbreviations as $abbreviation)
          <a href="#" @click.prevent="selectOption('{{ $abbreviation->abbreviation }} - {{ $abbreviation->description }}')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
            {{ $abbreviation->abbreviation }}
            -
            {{ $abbreviation->description }}
          </a>
        @endforeach
      </div>
    </div>
  </div>

  <div class="overflow-x-auto ml-4 mt-4">
    <table id="comicsTable" class="min-w-full table-auto border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800">
      <thead>
        <tr>
          @foreach(['id', 'datum', 'titel', 'VO', 'BR', 'HO', 'VT', 'HT', 'GT', 'VK', 'SK', 'DS', 'RK', 'BK', 'PR', 'CL', 'HR'] as $column)
            <th class="border border-gray-300 dark:border-gray-700 p-2 bg-gray-200 dark:bg-gray-600">
              {{ $column }}
            </th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach($comics as $comic)
          <tr class="comic-row">
            @foreach(['id', 'date', 'title', 'VO', 'BR', 'HO', 'VT', 'HT', 'GT', 'VK', 'SK', 'DS', 'RK', 'BK', 'PR', 'CL', 'HR'] as $column)
              <td class="border border-gray-300 dark:border-gray-700 p-2 bg-gray-200 dark:bg-gray-600">
                {{ $comic->$column }}
              </td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div>
    <a href="https://nl.wikipedia.org/wiki/Lijst_van_verhalen_van_Suske_en_Wiske">Bron: https://nl.wikipedia.org/wiki/Lijst_van_verhalen_van_Suske_en_Wiske</a>
  </div>

  <script>
    function selectOption(option) {
      console.log("Selected Option:", option);
    }
  </script>
@endsection
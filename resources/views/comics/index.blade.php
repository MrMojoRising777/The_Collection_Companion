@extends('layouts.app')

@section('content')
  <h1 class="text-4xl font-bold mb-2 ml-4 text-white dark:text-gray-800">
		Comics
	</h1>

  <div class="overflow-x-auto ml-4">
    <table class="min-w-full table-auto border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800">
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
          <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
            @foreach(['id', 'datum', 'title', 'VO', 'BR', 'HO', 'VT', 'HT', 'GT', 'VK', 'SK', 'DS', 'RK', 'BK', 'PR', 'CL', 'HR'] as $column)
              <td class="border border-gray-300 dark:border-gray-700 p-2 bg-gray-200 dark:bg-gray-600">
                {{ $comic->$column }}
              </td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
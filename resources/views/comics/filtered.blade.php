@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <h2 class="text-4xl font-bold mb-2 ml-4 text-white dark:text-gray-800">
      Filtered Comics - {{ strtoupper($abbreviation) }}
    </h2>

    <div class="table-responsive mt-4">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            @foreach (['id', 'date', 'title', strtoupper($abbreviation)] as $column)
              <th class="bg-gray-200">
                {{ $column }}
              </th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @php
            // Sort comics asc based on selected abbreviation column
            $filteredComics = $filteredComics->sortBy($abbreviation);
          @endphp

          @foreach ($filteredComics as $comic)
            <tr class="comic-row">
              @foreach (['id', 'date', 'title', strtoupper($abbreviation)] as $column)
                <td>
                  {{ $comic->$column }}
                </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

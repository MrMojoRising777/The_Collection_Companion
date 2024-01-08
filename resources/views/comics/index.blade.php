@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <h1 class="text-4xl font-bold mb-2 ml-4 text-white dark:text-gray-800">
      Comics
    </h1>

    <form method="POST" action="{{ route('comics.filter') }}" class="mt-3 p-4 bg-light rounded shadow">
      @csrf
      <div class="mb-3">
        <label for="abbreviation" class="form-label">Select Abbreviation:</label>
        <select name="abbreviation" id="abbreviation" class="form-select">
          @foreach ($abbreviations as $abbreviation)
            <option value="{{ strtolower($abbreviation->abbreviation) }}">
              {{ $abbreviation->abbreviation }} - {{ $abbreviation->description }}
            </option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary w-100">Filter</button>
    </form>

    <div class="mt-3 table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            @foreach(['id', 'datum', 'titel', 'VO', 'BR', 'HO', 'VT', 'HT', 'GT', 'VK', 'SK', 'DS', 'RK', 'BK', 'PR', 'CL', 'HR'] as $column)
              <th class="bg-gray-200">
                {{ $column }}
              </th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach($comics as $comic)
            <tr>
              @foreach(['id', 'date', 'title', 'VO', 'BR', 'HO', 'VT', 'HT', 'GT', 'VK', 'SK', 'DS', 'RK', 'BK', 'PR', 'CL', 'HR'] as $column)
                <td>
                  {{ $comic->$column }}
                </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      <a href="https://nl.wikipedia.org/wiki/Lijst_van_verhalen_van_Suske_en_Wiske">
        Bron: https://nl.wikipedia.org/wiki/Lijst_van_verhalen_van_Suske_en_Wiske
      </a>
    </div>
  </div>
@endsection
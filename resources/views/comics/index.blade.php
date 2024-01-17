@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <h1 class="text-4xl font-bold mb-2 ml-4 text-white dark:text-gray-800">
      Comics
    </h1>

    <form method="POST" action="{{ route('comics.filter') }}" class="mt-3 p-4 bg-light rounded shadow">
      @csrf
      <div class="mb-3">
        <label for="serie" class="form-label">Select serie:</label>
        <select name="serie" id="serie" class="form-select">
          @foreach ($series as $serie)
            <option value="{{ strtolower($serie->name) }}">
              {{ $serie->name }} - {{ $serie->abbreviation }}
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
            <tr onclick="window.location='{{ route('comics.show', $comic) }}';" style="cursor: pointer;">
              @foreach(['id', 'date', 'title', 'VO', 'BR', 'HO', 'VT', 'HT', 'GT', 'VK', 'SK', 'DS', 'RK', 'BK', 'PR', 'CL', 'HR', 'obtained'] as $column)
                <td>
                  @if($column == 'obtained')
                    <form method="POST" action="{{ route('comics.toggleObtained', $comic) }}">
                      @csrf
                      <button type="submit" class="btn btn-{{ $comic->obtained ? 'success' : 'danger' }}">
                        {{ $comic->obtained ? 'Obtained' : 'Unobtained' }}
                      </button>
                    </form>
                  @else
                    {{ $comic->$column }}
                  @endif
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

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $(document).ready(function () {
      // Handle click event on table rows
      $('.clickable-row').click(function () {
        var comicId = $(this).data('comic-id');

        // Send AJAX request to mark comic as obtained
        $.ajax({
          type: 'POST',
          url: '/mark-as-obtained/' + comicId,
          data: {
            _token: '{{ csrf_token() }}', // Add CSRF token
          },
          success: function (data) {
            // Handle success
            console.log('Comic marked as obtained:', data);
          },
          error: function (error) {
            // Handle error
            console.error('Error marking comic as obtained:', error);
          },
        });
      });
    });
  </script>
@endsection
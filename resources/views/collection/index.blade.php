@extends('layouts.app')

{{-- @if (Route::currentRouteName() !== 'albums.damaged')
  <a href="{{ route('albums.damaged') }}" class="btn btn-danger">
    Damaged
  </a>
@endif --}}

@section('content')
  <div class="container">
    <h1 class="h1 text-center mb-3 suske_wiske_font">Collection</h1>
    
    @if ($collection->isEmpty())
      <p>{{ __('You have no albums in your collection.') }}</p>
    @else
      <div class="row">
        <div class="col-md-4 mb-3">
          @if(Route::currentRouteName() !== 'collection.index')
            <a href="{{ route('collection.index') }}" class="btn btn-success">
              Collection
            </a>
          @endif
          @if (Route::currentRouteName() !== 'collection.favorites')
            <a href="{{ route('collection.favorites') }}" class="btn btn-warning">
              Favorites
            </a>
          @endif
          @if (Route::currentRouteName() !== 'collection.first_prints')
            <a href="{{ route('collection.first_prints') }}" class="btn btn-secondary">
              First prints
            </a>
          @endif
        </div>
      </div>

      {{ $collection->links() }}
      
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Collected</th>
              <th>Name</th>
              <th>Serie</th>
              <th>Volume</th>
              <th>Cover</th>
              <th>First Print</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($collection as $collected)
              <tr>
                <td class="d-flex">

                  <form method="POST" action="{{ route('collection.removeFromCollection', $collected->album_id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Remove from Collection</button>
                  </form>

                  <form method="POST" action="{{ route('collection.toggleFavorite', $collected->album_id) }}">
                    @csrf
                    <button type="submit" class="btn">
                      @if ($collected->favorite == 1)
                        <i class="bi bi-star-fill" style="color: #e5c73b;"></i>
                      @else
                        <i class="bi bi-star"></i>
                      @endif
                    </button>
                  </form>

                  <form method="POST" action="{{ route('collection.toggleFirstPrint', $collected->album_id) }}">
                    @csrf
                    <button type="submit" class="btn">
                      @if ($collected->first_print == 1)
                        <i class="bi bi-check-circle-fill"></i>
                      @else
                        <i class="bi bi-circle"></i>
                      @endif
                    </button>
                  </form>
                </td>
                <td>{{ $collected->album->name }}</td>
                <td>{{ $collected->album->serie->name }}</td>
                <td>{{ $collected->album->volume }}</td>
                <td>{{ $collected->album->cover }}</td>
                <td>{{ $collected->album->first_print }}</td>
                <td>
                  <a href="{{ route('collection.show', $collected->album_id) }}" class="btn btn-info">View</a>
                  <a href="{{ route('collection.edit', $collected->album_id) }}" class="btn btn-info">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection

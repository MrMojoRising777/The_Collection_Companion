@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="h1 text-center mb-3 suske_wiske_font">All Albums</h1>

    <div class="row">
      <div class="col-md-4 mb-3">
        @if (Auth::user() && Auth::user()->isAdmin())
          <a href="{{ route('albums.create') }}" class="btn btn-primary">
            Create
          </a>
        @endif
      </div>
      <div class="col-md-4 mb-3">
          <form action="{{ route('albums.search') }}" method="post">
              @csrf
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search..." name="search">
                  <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">Search</button>
                  </div>
              </div>
          </form>
      </div>
      <div class="col-md-4 mb-3">
          @if(Route::currentRouteName() !== 'albums.index')
              <a href="{{ route('albums.index') }}" class="btn btn-primary">
                  All
              </a>
          @endif
          @if(Route::currentRouteName() !== 'albums.obtained')
              <a href="{{ route('albums.obtained') }}" class="btn btn-success">
                  Obtained
              </a>
          @endif
          @if(Route::currentRouteName() !== 'albums.favorite')
              <a href="{{ route('albums.favorite') }}" class="btn btn-warning">
                  Favorites
              </a>
          @endif
          @if(Route::currentRouteName() !== 'albums.firstPrints')
              <a href="{{ route('albums.firstPrints') }}" class="btn btn-secondary">
                  First prints
              </a>
          @endif
      </div>
  </div>

  <div class="row">
    <form id="filterForm" action="{{ route('albums.index') }}" method="GET">
      <label for="serie_id">Filter by Serie:</label>
      <select class="form-select mb-1" name="serie_id" id="serie_id">
        <option value="">All Series</option>
        @foreach($series as $serie)
          <option value="{{ $serie->id }}" {{ request('serie_id') == $serie->id ? 'selected' : '' }}>
            {{ $serie->name }}
          </option>
        @endforeach
      </select>
    </form>

    <script>
      document.getElementById('serie_id').addEventListener('change', function () {
        document.getElementById('filterForm').submit();
      });
    </script>
  </div>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{ $albums->links() }}
    
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Collected</th>
            <th>Name</th>
            <th>Comic</th>
            <th>Serie</th>
            <th>Volume</th>
            <th>Cover</th>
            <th>First Print</th>
            @if (Auth::user() && Auth::user()->isAdmin())
              <th>Actions</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($albums as $album)
            <tr>
              <td class="d-flex">
                <form method="POST" action="{{ route('albums.toggleObtained', $album) }}">
                  @csrf
                  <button type="submit" class="btn btn-{{ $album->obtained ? 'success' : 'danger' }}">
                    {{ $album->obtained ? 'Obtained' : 'Unobtained' }}
                  </button>
                </form>

                <form method="POST" action="{{ route('albums.toggleFavorite', $album) }}">
                  @csrf
                  <button type="submit" class="btn">
                    @if($album->favorite == 1)
                      <i class="bi bi-star-fill" style="color: #e5c73b;"></i>
                    @else
                      <i class="bi bi-star"></i>
                    @endif
                  </button>
                </form>

                <form method="POST" action="{{ route('albums.toggleWanted', $album) }}">
                  @csrf
                  <button type="submit" class="btn">
                    @if($album->wanted == 1)
                      <i class="bi bi-bookmark-fill"></i>
                    @else
                      <i class="bi bi-bookmark"></i>
                    @endif
                  </button>
                </form>

                <form method="POST" action="{{ route('albums.toggleFirstPrint', $album) }}">
                  @csrf
                  <button type="submit" class="btn">
                    @if($album->first_print_obtained == 1)
                      <i class="bi bi-check-circle-fill"></i>
                    @else
                      <i class="bi bi-circle"></i>
                    @endif
                  </button>
                </form>
              </td>
              <td>{{ $album->name }}</td>
              <td>{{ $album->comic->name }}</td>
              <td>{{ $album->serie->name }}</td>
              <td>{{ $album->volume }}</td>
              <td>{{ $album->cover }}</td>
              <td>{{ $album->first_print }}</td>
              <td>
                <a href="{{ route('albums.show', $album->id) }}" class="btn btn-info">View</a>
                @if (Auth::user() && Auth::user()->isAdmin())
                  <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning">Edit</a>
                  <form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                      onclick="return confirm('Are you sure you want to delete this album?')">Delete</button>
                  </form>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

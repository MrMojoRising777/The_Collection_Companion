@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="h1 text-center mb-3 suske_wiske_font">Alle Albums</h1>

    {{-- @if (session('message'))
      <div class="alert alert-success">
        {{ session('message') }}
      </div>
    @endif --}}

    <div class="row">
      <div class="col-md-4 mb-3">
        @if (Auth::user() && Auth::user()->isAdmin())
          <a href="{{ route('albums.create') }}" class="btn btn-primary">
            Nieuw
          </a>
        @endif
      </div>
      <div class="col-md-4 mb-3">
        <form action="{{ route('albums.search') }}" method="post">
          @csrf
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Zoeken..." name="search">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Zoeken</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-4 mb-3">
        @if (Route::currentRouteName() !== 'albums.index')
          <a href="{{ route('albums.index') }}" class="btn btn-primary">
            Alle
          </a>
        @endif
        @if (Route::currentRouteName() !== 'collection.index')
          <a href="{{ route('collection.index') }}" class="btn btn-warning">
            Collectie
          </a>
        @endif
        {{-- add wishlist route --}}
      </div>
    </div>

    <div class="row">
      <form id="filterForm" action="{{ route('albums.index') }}" method="GET">
        <label for="serie_id">Filter d.m.v. Serie:</label>
        <select class="form-select mb-1" name="serie_id" id="serie_id">
          <option value="">Alle Series</option>
          @foreach ($series as $serie)
            <option value="{{ $serie->id }}" {{ request('serie_id') == $serie->id ? 'selected' : '' }}>
              {{ $serie->name }}
            </option>
          @endforeach
        </select>
      </form>

      <script>
        document.getElementById('serie_id').addEventListener('change', function() {
          document.getElementById('filterForm').submit();
        });
      </script>
    </div>

    {{ $albums->links() }}

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Verzameld</th>
            <th>Naam</th>
            <th>Serie</th>
            <th>Nummer</th>
            <th>Kaft</th>
            <th>Uitgebracht</th>
            @if (Auth::user() && Auth::user()->isAdmin())
              <th>Acties</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($albums as $album)
            <tr onclick="window.location='{{ route('albums.show', $album->id) }}';" style="cursor:pointer;">
              <td class="d-flex">

                <form method="POST" action="{{ route('albums.toggleCollected', $album) }}">
                  @csrf
                  @if ($album->isInCollection())
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                      Verwijder
                    </button>
                  @else
                    <button type="submit" class="btn btn-success">
                      Verzamel
                    </button>
                  @endif
                </form>

                <form method="POST" action="{{ route('wishlist.toggleWishlist', $album) }}">
                  @csrf
                  <button type="submit" class="btn">
                    @if ($wishlist->contains('album_id', $album->id))
                        <i class="bi bi-heart-fill" style="color: #b4311f;"></i>
                    @else
                        <i class="bi bi-heart"></i>
                    @endif
                  </button>
                </form>
              </td>
              <td>{{ $album->name }}</td>
              <td>{{ $album->serie->name }}</td>
              <td>{{ $album->volume }}</td>
              <td>{{ $album->cover }}</td>
              <td>{{ $album->first_print }}</td>
              <td>
                <a href="{{ route('albums.show', $album->id) }}" class="btn btn-info">Bekijk</a>

                {{-- admin actions | CRUD albums --}}
                @if (Auth::user() && Auth::user()->isAdmin())
                  <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning">Wijzig</a>
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

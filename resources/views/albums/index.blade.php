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
          @if(Route::currentRouteName() !== 'albums.wanted')
              <a href="{{ route('albums.wanted') }}" class="btn btn-warning">
                  Wanted
              </a>
          @endif
      </div>
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
            <th>ID</th>
            <th>Name</th>
            <th>Comic</th>
            <th>Serie</th>
            <th>Volume</th>
            <th>Obtained</th>
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
              <td>
                <form method="POST" action="{{ route('albums.toggleObtained', $album) }}">
                  @csrf
                  <button type="submit" class="btn btn-{{ $album->obtained ? 'success' : 'danger' }}">
                    {{ $album->obtained ? 'Obtained' : 'Unobtained' }}
                  </button>
                </form>
              </td>
              <td>{{ $album->id }}</td>
              <td>{{ $album->name }}</td>
              <td>{{ $album->comic->name }}</td>
              <td>{{ $album->serie->name }}</td>
              <td>{{ $album->volume }}</td>
              <td>{{ $album->obtained ? 'Yes' : 'No' }}</td>
              <td>{{ $album->cover }}</td>
              <td>{{ $album->first_print }}</td>
              @if (Auth::user() && Auth::user()->isAdmin())
                <td>
                  <a href="{{ route('albums.show', $album->id) }}" class="btn btn-info">View</a>
                  <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning">Edit</a>
                  <form action="{{ route('albums.destroy', $album->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                      onclick="return confirm('Are you sure you want to delete this album?')">Delete</button>
                  </form>
                </td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

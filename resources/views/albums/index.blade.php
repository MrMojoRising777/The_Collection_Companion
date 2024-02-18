@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="h1 text-center mb-3 suske_wiske_font">Alle Albums</h1>

    {{-- @if (session('message'))
      <div class="alert alert-success">
        {{ session('message') }}
      </div>
    @endif --}}

    <!-- View switch buttons -->
    <div class="row mb-3">
      <div class="col-md-12">
        <button id="tableViewBtn" class="btn btn-light view-btn active" data-target="tableView" style="cursor: pointer; border-radius: 50%;">
          <i class="bi bi-table"></i>
        </button>
        <span class="mx-2">|</span>
        <button id="gridViewBtn" class="btn btn-light view-btn" data-target="gridView" style="cursor: pointer; border-radius: 50%;">
          <i class="bi bi-grid"></i>
        </button>
      </div>
    </div>       

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

    <!-- Table view -->
    <div id="tableView" class="view-container">
      <div class="table-responsive mt-3">
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

    <!-- Grid view -->
    <div id="gridView" class="view-container" style="display: none;">
      <div class="albums-grid mt-3">
        <div class="row">
          @foreach ($albums as $album)
            <div class="col-lg-4 col-md-6">
              <div class="card mb-4">
                <div class="row no-gutters">
                  <div class="col-md-6">
                    <img class="w-full h-auto rounded-lg" src="{{ asset($album->image) }}" alt="Album Image">
                  </div>
                  <div class="col-md-6">
                    <div class="card-body">
                      <h5 class="card-title">{{ $album->name }}</h5>
                      <p class="card-text">Series: {{ $album->serie->name }}</p>
                      <!-- Add more album details as needed -->
                      <a href="{{ route('albums.show', $album->id) }}" class="btn btn-info">View</a>
                      <!-- Add admin actions if needed -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <script>
    // Function to switch between table and grid view
    function switchView(target) {
      // Hide all views
      document.querySelectorAll('.view-container').forEach(function(el) {
        el.style.display = 'none';
      });
      // Show target view
      document.getElementById(target).style.display = 'block';
    }
  
    // Event listeners for view switch buttons
    document.querySelectorAll('.view-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        // Remove 'active' class from all buttons
        document.querySelectorAll('.view-btn').forEach(function(el) {
          el.classList.remove('active');
        });
        // Add 'active' class to clicked button
        this.classList.add('active');
        // Switch view
        switchView(this.dataset.target);
      });
    });
  
    // Initially display table view
    switchView('tableView');
  </script>
@endsection

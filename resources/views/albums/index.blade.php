@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h1 text-center mb-3 suske_wiske_font">Alle Albums</h1>

        <blockquote>
            <i>Bekijk en doorzoek ALLE albums in de app. Hier kan je ook selecteren of je dit album reeds hebt verzamelt, deze verschijnt dan ook in jouw collectie.</i>
        </blockquote>

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
                <form action="{{ route('albums.index') }}" method="GET">
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
                @if (Route::currentRouteName() !== 'collection.albums.index')
                    <a href="{{ route('collection.albums.index') }}" class="btn btn-warning">
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
                @include('albums.partials.albums-table')
            </div>
        </div>

        <!-- Grid view -->
        <div id="gridView" class="view-container" style="display: none;">
            <div class="albums-grid mt-3">
                @include('albums.partials.albums-grid')
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

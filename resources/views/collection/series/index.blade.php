@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="h1 text-center mb-3 suske_wiske_font">Jouw Series</h1>

    <div class="row mb-3">
      <div class="col-md-12">
        <button id="tableViewBtn" class="btn btn-light view-btn active" data-target="tableView"
          style="cursor: pointer; border-radius: 50%;">
          <i class="bi bi-table"></i>
        </button>
        <span class="mx-2">|</span>
        <button id="gridViewBtn" class="btn btn-light view-btn" data-target="gridView"
          style="cursor: pointer; border-radius: 50%;">
          <i class="bi bi-grid"></i>
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 mb-3">
        <form action="{{ route('series.search') }}" method="post">
          @csrf
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Zoeken..." name="search">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Zoeken</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Table view -->
    <div id="tableView" class="view-container">
      <div class="table-responsive mt-3">
        <table class="table">
          <thead>
            <tr>
              <th>Verzamelen</th>
              <th>Afkorting</th>
              <th>Naam</th>
              <th>Periode</th>
              <th>Strips</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($series as $serie)
              <tr onclick="window.location='{{ route('series.show', $serie->id) }}';" style="cursor:pointer;">
                <td>
                  <form method="POST" action="{{ route('series.toggleTracking', $serie) }}">
                    @csrf
                    @if ($user->trackedSeries->contains($serie))
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Verwijder</button>
                    @else
                      <button type="submit" class="btn btn-success">Verzamel</button>
                    @endif
                  </form>
                </td>
                <td>{{ $serie->serie->abbreviation }}</td>
                <td>{{ $serie->serie->name }}</td>
                <td>{{ $serie->serie->period }}</td>
                <td>{{ $serie->serie->albums_count }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Grid view -->
    <div id="gridView" class="view-container" style="display: none;">
      <div class="series-grid mt-3">
        <div class="row">
          @foreach ($series as $serie)
            <div class="col-lg-4 col-md-6">
              <div class="card mb-4">
                <div class="row no-gutters">
                  <div class="col-md-6">
                    {{-- add cover image to each serie --}}
                    <img class="w-full h-auto rounded-lg" src="{{ asset('uploads/images/placeholder_cover.jpg') }}" alt="Album Image">
                  </div>
                  <div class="col-md-6">
                    <div class="card-body">
                      <h5 class="card-title">{{ $serie->serie->abbreviation }} - {{ $serie->serie->name }}</h5>
                      <p class="card-text">{{ $serie->serie->period }}</p>
                      <p class="card-text">Aantal strips {{ $serie->serie->albums_count }}</p>
                      <a href="{{ route('series.show', $serie->id) }}" class="btn btn-info">View</a>
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

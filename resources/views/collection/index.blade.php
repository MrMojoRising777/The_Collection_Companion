@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="h1 text-center mb-3 suske_wiske_font">Collectie</h1>

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
    
    @if ($collection->isEmpty())
      <p><i>Er zijn geen albums gevonden in je collectie</i></p>
    @else
      <div class="row">
        <div class="col-md-4 mb-3">
          @if(Route::currentRouteName() !== 'collection.index')
            <a href="{{ route('collection.index') }}" class="btn btn-success">
              Collectie
            </a>
          @endif
          @if (Route::currentRouteName() !== 'collection.favorites')
            <a href="{{ route('collection.favorites') }}" class="btn btn-warning">
              Favorieten
            </a>
          @endif
          @if (Route::currentRouteName() !== 'collection.first_prints')
            <a href="{{ route('collection.first_prints') }}" class="btn btn-secondary">
              Eerste drukken
            </a>
          @endif
        </div>
      </div>

      {{ $collection->links() }}
      
      <!-- Table view -->
      <div id="tableView" class="view-container">
        <div class="table-responsive mt-3">
          <table class="table">
            <thead>
              <tr>
                <th>Verzameld</th>
                <th>Name</th>
                <th>Serie</th>
                <th>Nummer</th>
                <th>Kaft</th>
                <th>Uitgebracht</th>
                <th>Acties</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($collection as $collected)
                <tr onclick="window.location='{{ route('collection.show', $collected->album_id) }}';" style="cursor:pointer;">
                  <td class="d-flex">

                    <form method="POST" action="{{ route('collection.removeFromCollection', $collected->album_id) }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Verwijder</button>
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
                    <a href="{{ route('collection.show', $collected->album_id) }}" class="btn btn-info">Bekijk</a>
                    <a href="{{ route('collection.edit', $collected->album_id) }}" class="btn btn-warning">Wijzig</a>
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
            @foreach ($collection as $collected)
              <div class="col-lg-4 col-md-6">
                <div class="card mb-4">
                  <div class="row no-gutters">
                    <div class="col-md-6">
                      <img class="w-full h-auto rounded-lg" src="{{ asset($collected->album->image) }}" alt="Album Image">
                    </div>
                    <div class="col-md-6">
                      <div class="card-body">
                        <h5 class="card-title">{{ $collected->album->name }}</h5>
                        <p class="card-text">Series: {{ $collected->album->serie->name }}</p>
                        <!-- Add more album details as needed -->
                        <a href="{{ route('collection.show', $collected->album_id) }}" class="btn btn-info">View</a>
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
    @endif
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

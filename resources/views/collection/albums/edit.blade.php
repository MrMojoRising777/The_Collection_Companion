@extends('layouts.app')

@section('content')
  <div class="container dark-mode">
    <div class="p-4">
      <h2 class="text-black">Wijzig Album</h2>
      <form method="POST" action="{{ route('collection.albums.update', $collected->album_id) }}">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-12">
            <div class="form-group mb-3"> {{-- CONDITION --}}
              <label for="condition" class="text-black">Conditie</label>
              <button type="button" onclick="legendModal()"><i class="bi bi-question-circle"></i></button>
              <select class="form-select" name="condition" id="condition">
                <option value="{{ old('condition', $collected->condition) }}" disabled></option>
                @foreach ($conditions as $condition)
                  <option value="{{ $condition }}">{{ $condition }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group mb-3"> {{-- NOTES --}}
              <label for="notes" class="text-black">Notities</label>
              <textarea name="notes" class="form-control">{{ old('notes', $collected->notes) }}</textarea>
            </div>

            <div class="form-group mb-3"> {{-- PRINT_YEAR --}}
              <label for="print_year" class="text-black">Drukjaar</label>
              <input type="text" name="print_year" class="form-control"
                value="{{ old('condition', $collected->print_year) }}">
            </div>

            <button class="btn btn-success" type="submit">Update Album</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal -->
  <div id="legendModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="legendModalLabel">Conditie Legenda</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>
            <strong>Nieuw: </strong>
            Perfecte, ongelezen staat, zonder enige schade of gebreken.
          </p>
          <p>
            <strong>Zeer Goed: </strong>
            Minimale tekenen van slijtage, zoals lichte krasjes op de cover of een lichte vervaging van de kleuren.
          </p>
          <p>
            <strong>Goed: </strong>
            Enige tekenen van gebruik, zoals lichte vouwen, kleine scheurtjes of verkleuring van de pagina's.
          </p>
          <p>
            <strong>Redelijk: </strong>
            Aanzienlijke slijtage of schade, zoals grote vouwen, scheuren, ontbrekende pagina's of losse binding.
          </p>
          <p>
            <strong>Slecht: </strong>
            Ernstige beschadiging, met aanzienlijke scheuren, loszittende pagina's, water- of vochtschade, of andere ernstige gebreken die de leesbaarheid aantasten.
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function legendModal() {
      $('#legendModal').modal('show');
    }
  </script>
@endsection
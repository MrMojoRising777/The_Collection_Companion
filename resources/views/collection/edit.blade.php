@extends('layouts.app')

@section('content')
  <div class="container dark-mode">
    <div class="p-4">
      <h2 class="text-black">Wijzig Album</h2>
      <form method="POST" action="{{ route('collection.update', $collected->album_id) }}">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-12">
            <div class="form-group mb-3"> {{-- CONDITION --}}
              <label for="condition" class="text-black">Conditie</label>
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
              <input type="text" name="print_year" class="form-control" value="{{ old('condition', $collected->print_year) }}">
            </div>

            <button class="btn btn-success" type="submit">Update Album</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

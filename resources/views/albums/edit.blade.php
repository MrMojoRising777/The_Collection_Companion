@extends('layouts.app')

@section('content')
  <div class="container dark-mode">
    <div class="p-4">
      <h2 class="text-white">Edit Album</h2>
      <form method="POST" action="{{ route('albums.update', $album->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

            <div class="form-group mb-3">
                <label for="name" class="text-white">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $album->name) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="comic_id" class="text-white">Comic:</label>
                <select name="comic_id" class="form-control" required>
                    @foreach ($comics as $comic)
                        <option value="{{ $comic->id }}" {{ ($comic->id == old('comic_id', $album->comic_id)) ? 'selected' : '' }}>
                          {{ $comic->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group mb-3">
                <label for="serie_id" class="text-white">Series:</label>
                <select name="serie_id" class="form-control" required>
                    @foreach ($series as $serie)
                        <option value="{{ $serie->id }}" {{ ($serie->id == old('serie_id', $album->serie_id)) ? 'selected' : '' }}>
                          {{ $serie->name }}
                        </option>
                    @endforeach
                </select>
            </div>            

            <div class="form-group mb-3">
                <label for="volume" class="text-white">Volume:</label>
                <input type="text" name="volume" class="form-control" value="{{ old('volume', $album->volume) }}">
            </div>

            <div class="form-group mb-3">
                <label for="cover" class="text-white">Cover:</label>
                <input type="text" name="cover" class="form-control" value="{{ old('cover', $album->cover) }}">
            </div>

            <div class="form-group mb-3">
                <label for="color" class="text-white">Color:</label>
                <input type="text" name="color" class="form-control" value="{{ old('color', $album->color) }}">
            </div>

            <div class="form-group mb-3">
                <label for="print_year" class="text-white">Print Year:</label>
                <input type="text" name="print_year" class="form-control" value="{{ old('print_year', $album->print_year) }}">
            </div>

            <div class="form-group mb-3">
                <label for="obtained" class="text-white">Obtained:</label>
                <input type="checkbox" name="obtained" {{ old('obtained', $album->obtained) ? 'checked' : '' }}>
            </div>

            <div class="form-group mb-3">
                <label for="condition" class="text-white">Condition:</label>
                <input type="text" name="condition" class="form-control" value="{{ old('condition', $album->condition) }}">
            </div>

            <div class="form-group mb-3">
                <label for="purchase_place" class="text-white">Purchase Place:</label>
                <input type="text" name="purchase_place" class="form-control" value="{{ old('purchase_place', $album->purchase_place) }}">
            </div>

            <div class="form-group mb-3">
                <label for="purchase_price" class="text-white">Purchase Price:</label>
                <input type="number" name="purchase_price" class="form-control" step="0.01" value="{{ old('purchase_price', $album->purchase_price) }}">
            </div>

            <div class="form-group mb-3">
                <label for="purchase_date" class="text-white">Purchase Date:</label>
                <input type="date" name="purchase_date" class="form-control" value="{{ old('purchase_date', $album->purchase_date) }}">
            </div>

            <div class="form-group mb-3">
                <label for="notes" class="text-white">Notes:</label>
                <textarea name="notes" class="form-control">{{ old('notes', $album->notes) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="image" class="text-white">Image:</label>
                <input type="file" name="image" class="form-control-file">
            </div>

          <button type="submit">Update Album</button>
      </form>
    </div>
  </div>
@endsection

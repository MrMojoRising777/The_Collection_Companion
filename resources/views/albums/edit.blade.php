@extends('layouts.app')

@section('content')
  <div class="container dark-mode">
    <div class="p-4">
      <h2 class="text-black">Edit Album</h2>
      <form method="POST" action="{{ route('albums.update', $album->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3"> {{-- ALBUM_NAME --}}
                        <label for="name" class="text-black">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $album->name) }}" required>
                    </div>
        
                    <div class="form-group mb-3"> {{-- ALBUM_COMIC --}}
                        <label for="comic_id" class="text-black">Comic:</label>
                        <select name="comic_id" class="form-control" required>
                            @foreach ($comics as $comic)
                                <option value="{{ $comic->id }}" {{ ($comic->id == old('comic_id', $album->comic_id)) ? 'selected' : '' }}>
                                  {{ $comic->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group mb-3"> {{-- ALBUM_SERIES --}}
                        <label for="serie_id" class="text-black">Series:</label>
                        <select name="serie_id" class="form-control" required>
                            @foreach ($series as $serie)
                                <option value="{{ $serie->id }}" {{ ($serie->id == old('serie_id', $album->serie_id)) ? 'selected' : '' }}>
                                  {{ $serie->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>            
        
                    <div class="form-group mb-3"> {{-- ALBUM_VOLUME --}}
                        <label for="volume" class="text-black">Volume:</label>
                        <input type="text" name="volume" class="form-control" value="{{ old('volume', $album->volume) }}">
                    </div>
        
                    <div class="form-group mb-3"> {{-- ALBUM_COVER --}}
                        <label for="cover" class="text-black">Cover:</label>
                        <input type="text" name="cover" class="form-control" value="{{ old('cover', $album->cover) }}">
                    </div>
        
                    <div class="form-group mb-3"> {{-- ALBUM_COLOR --}}
                        <label for="color" class="text-black">Color:</label>
                        <input type="text" name="color" class="form-control" value="{{ old('color', $album->color) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="value" class="text-black">Value:</label>
                        <input type="number" name="value" class="form-control" step="0.01" value="{{ old('value', $album->value) }}">
                    </div>
        
                    <div class="form-group mb-3"> {{-- FIRST_PRINT --}}
                        <label for="first_print" class="text-black">First Print:</label>
                        <input type="text" name="first_print" class="form-control" value="{{ old('first_print', $album->first_print) }}">
                    </div>
                    
                    <div class="form-group mb-3"> {{-- IMAGE --}}
                        <label for="image" class="text-black">Image:</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>

                    <button class="btn btn-success" type="submit">Update Album</button>
                </div>
            </div>
      </form>
    </div>
  </div>
@endsection

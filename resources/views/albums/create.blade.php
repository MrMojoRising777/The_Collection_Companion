@extends('layouts.app')

@section('content')
    <div class="container dark-mode">
        <div class="p-4">
            <h2 class="text-white">Add New Album</h2>
            <form method="POST" action="{{ route('albums.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="name" class="text-white">Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="comic_id" class="text-white">Comic:</label>
                    <select name="comic_id" class="form-control" required>
                        @foreach ($comics as $comic)
                            <option value="{{ $comic->id }}">{{ $comic->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group mb-3">
                    <label for="serie_id" class="text-white">Series:</label>
                    <select name="serie_id" class="form-control" required>
                        @foreach ($series as $serie)
                            <option value="{{ $serie->id }}">{{ $serie->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

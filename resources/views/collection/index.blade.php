@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="h1 text-center mb-3 suske_wiske_font">Jouw Collectie</h1>

    <div class="row">
      <div class="col-md-6 mb-3">
        <a href="{{ route('collection.series.index') }}" class="btn btn-primary btn-block">
          Jouw series
        </a>
      </div>
      <div class="col-md-6 mb-3">
        <a href="{{ route('collection.albums.index') }}" class="btn btn-secondary btn-block">
          Jouw albums
        </a>
      </div>
    </div>
  </div>
@endsection

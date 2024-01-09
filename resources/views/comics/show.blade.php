@extends('layouts.app')

@section('content')
  <h1>{{ $comic->title }}</h1>

  <p>ID: {{ $comic->id }}</p>
  <p>Date: {{ $comic->date }}</p>

<a href="{{ route('comics.index') }}">Back to Comics List</a>
@endsection
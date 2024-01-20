@extends('layouts.app')

@section('content')
    <h1>Album Details</h1>
    <p>Name: {{ $album->name }}</p>
    <!-- Add other album details here -->
@endsection

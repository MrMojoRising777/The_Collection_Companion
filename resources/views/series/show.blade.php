@extends('layouts.app')

@section('content')
  <div class="max-w-xl mx-auto mt-6 p-6 bg-white rounded-md shadow-md">
    <h1 class="text-3xl font-bold mb-4">{{ $serie->abbreviation }}</h1>
    <p class="text-gray-600">{{ $serie->name }}</p>
    <p class="text-gray-600">{{ $serie->period }}</p>

    <a href="{{ route('series.index') }}"
      class="mt-4 inline-block px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-700 active:bg-blue-800 transition ease-in-out duration-150">
      Back to Index - show albums from serie (collected or not)
    </a>
  </div>
@endsection

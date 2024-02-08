@extends('layouts.app')

@section('content')
  <div class="album-wrapper shadow-md p-6 pt-8 md:w-3/4 lg:w-4/6 xl:w-1/2 mx-auto suske_wiske_bg">
    <div class="album-header text-center mb-6">
      <p class="text-2xl font-bold suske_wiske_font">{{ $collected->album->name }}</p>
    </div>
    <div class="album-content flex flex-col md:flex-row">
      <div class="album-info mb-4 md:mb-0 md:mr-4 w-full md:w-2/3 lg:w-1/2 bg-gray-100 p-4 rounded-lg">
        <p class="mb-2"><strong>Serie:</strong> {{ $collected->album->serie->name }}</p>
        <p class="mb-2"><strong>Nummer:</strong> {{ $collected->album->volume }}</p>
        <p class="mb-2"><strong>Kaft:</strong> {{ $collected->album->cover }}</p>
        <p class="mb-2"><strong>Kleur:</strong> {{ $collected->album->color }}</p>
        <p class="mb-2"><strong>Eerste Druk:</strong> {{ $collected->album->first_print }}</p>
        <p class="mb-2"><strong>Waarde:</strong> €{{ $collected->album->value }}</p>

        <p class="mb-2"><strong>Notitie:</strong> {{ $collected->notes }}</p>
                    {{-- add extra values --}}
      </div>
      <div class="album-image w-full md:w-1/3 lg:w-1/2">
        @if ($collected->album->image)
          {{-- Album cover --}}
          <img class="w-full h-auto rounded-lg" src="{{ asset($collected->album->image) }}" alt="Album Image">
        @else
          {{-- Placeholder image --}}
          <img class="w-full h-auto rounded-lg" src="{{ asset('uploads/images/placeholder_cover.jpg') }}"
            alt="Placeholder Image">
        @endif
      </div>
    </div>
  </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="album-wrapper bg-white shadow-md p-6 pt-8 md:w-3/4 lg:w-4/6 xl:w-1/2 mx-auto">
        <div class="album-header text-center mb-6">
            <p class="text-2xl font-bold">{{ $album->name }}</p>
        </div>
        <div class="album-content flex flex-col md:flex-row">
            <div class="album-info mb-4 md:mb-0 md:mr-4 w-full md:w-2/3 lg:w-1/2 bg-gray-100 p-4 rounded-lg">
                <p class="mb-2"><strong>Serie:</strong> {{ $album->serie->name }}</p>
                <p class="mb-2"><strong>Nummer:</strong> {{ $album->volume }}</p>
                <p class="mb-2"><strong>Kaft:</strong> {{ $album->cover }}</p>
                <p class="mb-2"><strong>Kleur:</strong> {{ $album->color }}</p>
                <p class="mb-2"><strong>Eerste Druk:</strong> {{ $album->first_print }}</p>

                {{-- Display acquisition details if available --}}
                @if ($album->obtained)
                    <p class="mb-2"><strong>Notitie:</strong> {{ $album->notes }}</p>
                    <p class="mb-2"><strong>Print Jaar:</strong> {{ $album->print_year }}</p>
                    <p class="mb-2"><strong>Plaats van aankoop:</strong> {{ $album->purchase_place }}</p>
                    <p class="mb-2"><strong>Aankoopprijs:</strong> €{{ $album->purchase_price }}</p>
                    <p class="mb-2"><strong>Aankoopdatum:</strong> {{ $album->purchase_date }}</p>
                @else
                    <p class="mb-2"><strong>Nog niet in je collectie</strong></p>
                @endif
            </div>
            <div class="album-image w-full md:w-1/3 lg:w-1/2">
                @if ($album->image)
                {{-- Album cover --}}
                    <img class="w-full h-auto rounded-lg" src="{{ asset($album->image) }}" alt="Album Image">
                @else
                    {{-- Placeholder image --}}
                    <img class="w-full h-auto rounded-lg" src="{{ asset('uploads/images/placeholder_cover.jpg') }}" alt="Placeholder Image">
                @endif
            </div>
        </div>
    </div>
@endsection

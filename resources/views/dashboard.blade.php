@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-8">
                <h2>Progressie</h2>
                @include('components.series-progress-bars')
            </div>
            <div class="col-md-4">
                <h2>Favorieten</h2>
                @if ($favorites->isNotEmpty())
                    <ul class="list-group list-group-flush">
                        @foreach ($favorites as $favorite)
                            <li class="list-group-item">{{ $favorite->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p><i>Er zijn geen albums gevonden in je collectie</i></p>
                @endif
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-4">
                <h2>Recente toevoegingen</h2>
                @include('components.carousel')
            </div>
            <div class="col-md-4">
                <h2>Meest waardevolle albums</h2>
                @if ($valueAlbums->isNotEmpty())
                    <ul class="list-group list-group-flush">
                        @foreach ($valueAlbums as $valueAlbum)
                            <li class="list-group-item">{{ $valueAlbum->name }} - €{{ $valueAlbum->value }}</li>
                        @endforeach
                    </ul>
                @else
                    <p><i>Er zijn geen albums gevonden in je collectie</i></p>
                @endif
            </div>
            <div class="col-md-4">
                <h2>Collectie waarde</h2>
                @if ($collectionValue)
                    <p>€ {{ $collectionValue }}</p>
                @else
                    <p><i>Er zijn geen albums gevonden in je collectie</i></p>
                @endif
                <h2>Prestaties</h2>
                @if($achievements)
                    @foreach ($achievements as $achievement)
                        <img src="{{ $achievement->image }}" alt="">
                        <p>{{ $achievement->title }}</p>
                    @endforeach
                @else
                    <p><i>Je hebt nog geen prestaties behaald</i></p>
                @endif
            </div>
        </div>
    </div>
@endsection

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
                <h2>Progression</h2>
                @include('components.series-progress-bars')
            </div>
            <div class="col-md-4">
                <h2>Favorite albums</h2>
                @if ($favorites->isNotEmpty())
                    <ul class="list-group list-group-flush">
                        @foreach ($favorites as $favorite)
                            <li class="list-group-item">{{ $favorite->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p><i>Currently no albums in your collection</i></p>
                @endif
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-4">
                <h2>Recent additions</h2>
                @include('components.carousel')
            </div>
            <div class="col-md-4">
                <h2>Most valued albums</h2>
                @if ($valueAlbums->isNotEmpty())
                    <ul class="list-group list-group-flush">
                        @foreach ($valueAlbums as $valueAlbum)
                            <li class="list-group-item">{{ $valueAlbum->name }} - €{{ $valueAlbum->value }}</li>
                        @endforeach
                    </ul>
                @else
                    <p><i>Currently no albums in your collection</i></p>
                @endif
            </div>
            <div class="col-md-4">
                upcoming releases
            </div>
        </div>
    </div>
@endsection

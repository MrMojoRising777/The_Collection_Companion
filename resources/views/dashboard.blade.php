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
                @include('components.series-progress-bars')
            </div>
            <div class="col-md-4">
                Something
            </div>
        </div>
        <div class="row mt-1">
            {{-- recent additions carousel --}}
            <div class="col-md-4">
                @include('components.carousel')
            </div>
            {{-- most valued albums --}}
            <div class="col-md-4">
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

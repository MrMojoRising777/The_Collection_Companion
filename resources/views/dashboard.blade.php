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
                progress bar + summary of series
            </div>
            <div class="col-md-4">
                Something
            </div>
        </div>
        <div class="row mt-1">
            {{-- recent additions carousel --}}
            <div class="col-md-4">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($recentAlbums as $key => $recentAlbum)
                            <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                                @if($recentAlbum->image)
                                    <img src="{{ $recentAlbum->image }}" class="d-block w-100" alt="{{ $recentAlbum->name }}">
                                @else
                                    {{-- Placeholder image --}}
                                    <img class="w-full h-auto rounded-lg" src="{{ asset('uploads/images/placeholder_cover.jpg') }}" alt="Placeholder Image">
                                @endif
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="text-black font-weight-bold">{{ $recentAlbum->name }}</h5>
                                    <p>Some representative placeholder content for the slide.</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
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

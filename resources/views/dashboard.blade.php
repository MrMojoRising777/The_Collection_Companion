@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="container mt-2">
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Album Additions</h5>
                    </div>
                    <div class="card-body addition-container">
                        @foreach ($recentAlbums as $index => $album)
                            <div class="{{ $index === 0 ? '' : 'mt-2' }}">
                                <h6 class="card-subtitle text-muted mb-2">{{ $album->comics->name }} - {{ $album->name }}</h6>
                                <p>{{ $album->updated_at->diffForHumans() }}</p>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="container mt-2">
                <div class="card">
                    <div class="card-header">
                        <h5>Most Value Albums</h5>
                    </div>
                    <div class="card-body addition-container">
                        @foreach ($valueAlbums as $index => $album)
                            <div class="{{ $index === 0 ? '' : 'mt-2' }}">
                                <h6 class="card-subtitle text-muted mb-2">{{ $album->comics->name }} - {{ $album->name }}</h6>
                                <p>{{ $album->updated_at->diffForHumans() }}</p>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


        {{-- <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="suske_wiske_bg overflow-hidden shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="suske_wiske_font p-6">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div> --}}
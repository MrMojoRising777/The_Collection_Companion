<div class="row">
    @foreach ($albums as $album)
        @if(request('search') && $album->series?->count())
            @foreach ($album->series as $serie)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100" onclick="window.location='{{ route('albums.show', $album->id) }}'" style="cursor:pointer;">
                        <div class="row g-0 h-100">
                            <div class="col-5">
                                <img class="img-fluid h-100 object-fit-cover"
                                     src="{{ asset($album->image) }}"
                                     alt="{{ $album->name }}">
                            </div>

                            <div class="col-7">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">
                                        {{ $album->name }}
                                    </h5>

                                    <p class="mb-1 text-muted">
                                        {{ $serie->name }}
                                    </p>

                                    <small class="text-muted">
                                        Nummer: {{ $serie->pivot->number }}
                                    </small>

                                    <div class="mt-2">
                                        <a href="{{ route('albums.show', $album->id) }}"
                                           class="btn btn-sm btn-info">
                                            View
                                        </a>

                                        @if (Auth::user() && Auth::user()->isAdmin())
                                            <a href="{{ route('albums.edit', $album->id) }}"
                                               class="btn btn-sm btn-warning">
                                                Edit
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100"
                     onclick="window.location='{{ route('albums.show', $album->id) }}'"
                     style="cursor:pointer;">
                    <div class="row g-0 h-100">

                        <div class="col-5">
                            <img class="img-fluid h-100 object-fit-cover"
                                 src="{{ asset($album->image) }}"
                                 alt="{{ $album->name }}">
                        </div>

                        <div class="col-7">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $album->name }}
                                </h5>

                                <div class="mt-2">
                                    <a href="{{ route('albums.show', $album->id) }}"
                                       class="btn btn-sm btn-info">
                                        View
                                    </a>

                                    @if (Auth::user() && Auth::user()->isAdmin())
                                        <a href="{{ route('albums.edit', $album->id) }}"
                                           class="btn btn-sm btn-warning">
                                            Edit
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

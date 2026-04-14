<table class="table">
    <thead>
    <tr>
        <th>Verzameld</th>
        <th>Naam</th>

        @if(request('search'))
            <th>Serie</th>
            <th>Nummer</th>
        @endif

        @if (Auth::user() && Auth::user()->isAdmin())
            <th>Acties</th>
        @endif
    </tr>
    </thead>

    <tbody>
    @foreach ($albums as $album)
        @if(request('search') && $album->series->count())
            @foreach ($album->series as $serie)
                <tr onclick="window.location='{{ route('albums.show', $album->id) }}';" style="cursor:pointer;">
                    <td class="d-flex">
                        @include('albums.partials.collection-buttons', ['album' => $album])
                    </td>
                    <td>{{ $album->name }}</td>
                    <td>{{ $serie->name }}</td>
                    <td>{{ $serie->pivot->number }}</td>
                    @if (Auth::user() && Auth::user()->isAdmin())
                        <td>
                            @include('albums.partials.actions', ['album' => $album])
                        </td>
                    @endif
                </tr>
            @endforeach

        @else
            <tr onclick="window.location='{{ route('albums.show', $album->id) }}';" style="cursor:pointer;">
                <td class="d-flex">
                    @include('albums.partials.collection-buttons', ['album' => $album])
                </td>
                <td>{{ $album->name }}</td>
                @if (Auth::user() && Auth::user()->isAdmin())
                    <td>
                        @include('albums.partials.actions', ['album' => $album])
                    </td>
                @endif
            </tr>
        @endif
    @endforeach
    </tbody>
</table>

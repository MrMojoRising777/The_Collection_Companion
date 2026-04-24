<table class="w-full border">
    <thead>
    <tr>
        <th class="p-2">Serie</th>
        <th class="p-2">#</th>
        <th class="p-2"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($album->albumSeries as $albumSerie)
        <tr class="border-t">
            <td class="p-2">
                {{ $albumSerie->serie->name }}
            </td>

            <td class="p-2">
                {{ $albumSerie->volume }}
            </td>

            <td class="p-2">
                @if(! auth()->user()?->collectedAlbum($albumSerie))
                    <button
                        wire:click="collectAlbum({{ $albumSerie->id }})"
                        class="p-1 rounded bg-emerald-700 text-mist-300 cursor-pointer"
                    >
                        Collect
                    </button>
                @else
                    <button
                        wire:click="showAlbum({{ $albumSerie->id }})"
                        class="p-1 rounded bg-sky-600 text-mist-300 cursor-pointer"
                    >
                        View
                    </button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

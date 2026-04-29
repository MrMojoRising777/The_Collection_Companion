<table class="w-full border">
    <thead>
    <tr>
        <th class="p-2">Serie</th>
        <th class="p-2">#</th>
        <th class="p-2"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($album->editions as $edition)
        <tr class="border-t">
            <td class="p-2">
                {{ $edition->serie->name }}
            </td>

            <td class="p-2">
                {{ $edition->volume }}
            </td>

            <td class="p-2">
                @if(! auth()->user()?->collectedEdition($edition))
                    <button
                        wire:click="collectAlbum({{ $edition->id }})"
                        class="p-1 rounded bg-emerald-700 text-mist-300 cursor-pointer"
                    >
                        Collect
                    </button>
                @else
                    <button
                        wire:click="showAlbum({{ $edition->id }})"
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

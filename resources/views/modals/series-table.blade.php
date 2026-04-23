<table class="w-full border">
    <thead>
    <tr>
        <th class="p-2">{{ $album['name'] }}</th>
        <th class="p-2">Acties</th>
    </tr>
    </thead>
    <tbody>
    @foreach($album['series'] as $serie)
        <tr class="border-t">
            <td class="p-2">
                {{ $serie['name'] ?? '-' }}
            </td>
            <td class="p-2">
                <a
                    href="{{ route('collect-album', ['album' => $album['id'], 'serie' => $serie['id']]) }}"
                    class="btn p-1 rounded bg-green-500 text-mist-300"
                >
                    Collect
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

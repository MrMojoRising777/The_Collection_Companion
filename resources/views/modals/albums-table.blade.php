<table class="w-full border">
    <thead>
        <tr>
            <th class="p-2">Serie</th>
        </tr>
    </thead>
    <tbody>
        @foreach($albums as $albumSerie)
            <tr class="border-t">
                <td class="p-2">
                    {{ $albumSerie['serie']['name'] ?? '-' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

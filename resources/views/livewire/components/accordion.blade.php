<div class="space-y-2">
    @foreach ($items as $index => $item)
        <button
            wire:click="toggle({{ $index }})"
            class="w-full text-left p-3 border rounded hover:bg-gray-600 cursor-pointer font-semibold"
        >
            {{ $item['title'] }}
        </button>

        @if ($openIndex === $index)
            <div class="ml-4 mt-2 p-3 border rounded bg-gray-600">
                @if (is_string($item[$contentKey] ?? null))
                    {{ $item[$contentKey] }}
                @endif

                @if (is_array($item[$contentKey] ?? null))
                    <div class="space-y-2">
                        @foreach ($item[$contentKey] as $row)
                            <div class="p-2 border rounded bg-gray-400">
                                @if (is_array($row))
                                    <div class="font-medium">
                                        {{ $row['name'] ?? 'Unnamed' }}
                                    </div>

                                    @if (! empty($row['period']))
                                        <div class="text-sm text-gray-500">
                                            {{ $row['period'] }}
                                        </div>
                                    @endif

{{--                                    @if (! empty($row['abbreviation']))--}}
{{--                                        <div class="text-xs text-gray-400">--}}
{{--                                            {{ $row['abbreviation'] }}--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
                                @else
                                    {{ $row }}
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    @endforeach
</div>

<div>
    @if (empty($this->series))
        <p><i>Er zijn geen albums gevonden in je collectie</i></p>
    @else
        @foreach ($this->series as $serie)
            @if ($serie['obtained'] > 0)
                <div class="mb-3">
                    <p class="mb-0">{{ $serie['serie_name'] }}</p>

                    <div class="flex items-center">
                        <div
                            class="h-2 flex-1 overflow-hidden rounded bg-gray-200"
                            role="progressbar"
                            aria-valuenow="{{ $serie['percentage'] }}"
                            aria-valuemin="0"
                            aria-valuemax="100"
                        >
                            <div
                                class="h-full rounded bg-green-500"
                                style="width: {{ max($serie['percentage'], 2) }}%"
                            ></div>
                        </div>

                        <p class="mb-0 ml-2">
                            {{ $serie['obtained'] }} of {{ $serie['total'] }}
                        </p>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>

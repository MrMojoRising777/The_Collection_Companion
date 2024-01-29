@foreach ($seriesPercentages as $seriesPercentage)
    @if ($seriesPercentage['obtained'] !== 0)
        <div class="mb-3">
            <p class="mb-0">{{ $seriesPercentage['serie_name'] }}</p>
            <div class="d-flex align-items-center container">
                <div class="progress flex-grow-1 mt-1" role="progressbar" aria-label="Success example"
                    aria-valuenow="{{ $seriesPercentage['percentage'] }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: {{ $seriesPercentage['percentage'] }}%">
                        {{ $seriesPercentage['percentage'] }}%</div>
                </div>
                <p class="mb-0 ms-2">{{ $seriesPercentage['obtained'] }} of {{ $seriesPercentage['total'] }}</p>
            </div>
        </div>
    @endif
@endforeach
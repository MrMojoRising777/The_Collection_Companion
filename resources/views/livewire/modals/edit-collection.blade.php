<div>
    <select name="condition" id="condition">
        <option disabled selected value="">Selecteer een conditie</option>
        @foreach(\App\Enums\Condition::cases() as $condition)
            <option
                @if($collection->condition === $condition->name) selected @endif
                value="{{ $condition->name }}"
            >
                {{ $condition->value }}
            </option>
        @endforeach
    </select>
</div>

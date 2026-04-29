<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 bg-white dark:bg-gray-500 shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Progressie</h2>
             @include('components.series-progress-bars')
        </div>

        <div class="lg:col-span-4 bg-white dark:bg-gray-500 shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Favorieten</h2>
            @if ($favorites->isNotEmpty())
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($favorites as $favorite)
                        <li class="py-2 text-gray-800 dark:text-gray-200">
                            {{ $favorite->edition->album->name }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 dark:text-mist-300 italic">
                    Er zijn geen albums gevonden in je collectie
                </p>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-500 shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Recente toevoegingen</h2>

            <div
                x-init="interval = setInterval(() => $wire.dispatch('next'), 5000)"
                x-on:mouseenter="clearInterval(interval)"
                x-on:mouseleave="interval = setInterval(() => $wire.dispatch('next'), 5000)"
            >
                <livewire:components.carousel />
            </div>
        </div>

        <div class="bg-white dark:bg-gray-500 shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Meest waardevolle albums</h2>
{{--TODO NEEDS TO BE IMPLEMENTED--}}
{{--            @if ($mostValuedAlbums->isNotEmpty())--}}
{{--                <ul class="divide-y divide-gray-200 dark:divide-gray-700">--}}
{{--                    @foreach ($mostValuedAlbums as $valueAlbum)--}}
{{--                        <li class="py-2">--}}
{{--                            {{ $valueAlbum->name }} - €{{ $valueAlbum->value }}--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            @else--}}
{{--                <p class="text-gray-500 italic">Er zijn geen albums gevonden in je collectie</p>--}}
{{--            @endif--}}

        </div>

        <div class="bg-white dark:bg-gray-500 shadow rounded-lg p-6 space-y-6">
            <div>
                <h2 class="text-xl font-semibold mb-3">Collectie waarde</h2>
{{--TODO NEEDS TO BE IMPLEMENTED--}}
{{--                @if ($collectionValue)--}}
{{--                    <p class="text-2xl font-bold text-gray-900 dark:text-white">--}}
{{--                        € {{ $collectionValue }}--}}
{{--                    </p>--}}
{{--                @else--}}
{{--                    <p class="text-gray-500 italic">--}}
{{--                        Er zijn geen albums gevonden in je collectie--}}
{{--                    </p>--}}
{{--                @endif--}}
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-3">Prestaties</h2>
                @if($achievements)
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach ($achievements as $achievement)
                            <div class="flex flex-col items-center text-center space-y-2">
                                <img src="{{ $achievement->image }}"
                                     alt="{{ $achievement->title }}"
                                     class="w-12 h-12 object-contain">

                                <p class="text-sm text-gray-700 dark:text-mist-300">
                                    {{ $achievement->title }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 dark:text-mist-300 italic">
                        Je hebt nog geen prestaties behaald
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

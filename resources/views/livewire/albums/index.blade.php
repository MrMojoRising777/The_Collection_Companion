<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-mist-100 text-3xl font-bold text-center mb-3 font-serif">
        Alle Albums
    </h1>

    <blockquote class="text-center text-mist-300 italic mb-6">
        Bekijk en doorzoek ALLE albums in de app. Hier kan je jouw collectie beheren.
    </blockquote>

    <div class="flex justify-center items-center gap-3 mb-6">
        <button
            wire:click="setView('table')"
            class="p-3 rounded-full border transition
            {{ $view === 'table' ? 'bg-gray-900 text-white' : 'bg-white hover:bg-gray-100' }}"
        >
            <i class="bi bi-table"></i>
        </button>

        <span class="text-gray-400">|</span>

        <button
            wire:click="setView('grid')"
            class="p-3 rounded-full border transition
            {{ $view === 'grid' ? 'bg-gray-900 text-white' : 'bg-white hover:bg-gray-100' }}"
        >
            <i class="bi bi-grid"></i>
        </button>
    </div>

    <div class="flex justify-center mb-6">
        <div class="w-full max-w-md">
            <input
                type="text"
                wire:model.live.debounce.400ms="search"
                placeholder="Zoeken..."
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>
    </div>

    <div class="flex justify-center mb-6">
        <div class="w-full max-w-md">
            <select
                wire:model.live="serieId"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="" class="dark:text-gray-400 dark:bg-gray-800">Alle Series</option>
                @foreach ($series as $serie)
                    <option value="{{ $serie->id }}" class="dark:text-gray-400 dark:bg-gray-800">
                        {{ $serie->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    @if ($view === 'table')
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-600 rounded-lg overflow-hidden">
                <thead class="bg-gray-600 text-mist-300 text-left">
                <tr>
                    <th class="p-3">Naam</th>
                    <th class="p-3">Aantal uitgaven</th>
                    @if($filteredOnSerie)
                        <th class="p-3"># in serie</th>
                    @endif
                </tr>
                </thead>

                <tbody>
                    @forelse ($albums as $album)
                        <tr class="border-t hover:bg-gray-400 cursor-pointer" wire:click="openCollectModal({{ $album->id }})">
                            <td class="p-3 font-medium">
                                {{ $album->name }}
                            </td>

                            <td class="p-3 font-medium">
                                {{ $album->editions->count() }}
                            </td>

                            @if($filteredOnSerie)
                                <td class="p-3 font-medium">
                                    {{ $album->editions->first()->volume }}
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr class="border-t">
                            <td colspan="{{ $filteredOnSerie ? 3 : 2 }}">
                                No albums found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif

    @if ($view === 'grid')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($albums as $album)
                <div class="bg-white rounded-xl shadow border overflow-hidden flex">

                    <div class="w-1/2">
                        <img
                            src="{{ asset('uploads/images/placeholder_cover.jpg') }}"
                            class="w-full h-full object-cover"
                            alt="Album cover"
                        >
                    </div>

                    <div class="w-1/2 p-4 flex flex-col justify-between">
                        <div>
                            <h5 class="font-semibold text-lg">
                                {{ $album->name }}
                            </h5>
                        </div>

                        <div class="mt-3">
                            <button
                                class="w-full px-3 py-1 rounded text-white text-sm bg-green-500 hover:bg-green-600"
                            >
                                In collectie
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-6 flex justify-center">
        {{ $albums->links() }}
    </div>
</div>

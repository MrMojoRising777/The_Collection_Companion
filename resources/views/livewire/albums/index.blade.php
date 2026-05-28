<div class="max-w-7xl mx-auto px-4 py-2">
    <h1 class="text-mist-100 text-3xl font-bold text-center mb-3 font-serif">
        Alle Albums
    </h1>

    <blockquote class="text-center text-mist-300 italic mb-4">
        Bekijk en doorzoek ALLE albums in de app. Hier kan je jouw collectie beheren.
    </blockquote>

    <div class="relative mb-6">
        <div class="flex justify-center px-4 sm:px-0 mb-2">
            <div class="w-full max-w-md">
                <input
                    type="text"
                    wire:model.live.debounce.400ms="search"
                    placeholder="Zoeken..."
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
        </div>

        <div class="flex justify-center px-4 sm:px-0">
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

        <div class="
            flex items-center justify-center gap-2 mt-4
            sm:absolute sm:right-0 sm:top-1/2 sm:-translate-y-1/2 sm:mt-0 sm:justify-start
        ">
            <button
                wire:click="setView('table')"
                class="p-2 rounded-md border transition cursor-pointer text-mist-300
                    {{ $view === 'table' ? 'bg-gray-900 hover:bg-gray-700' : 'bg-gray-700 hover:bg-gray-500' }}"
            >
                <i class="bi bi-table"></i>
            </button>

            <button
                wire:click="setView('grid')"
                class="p-2 rounded-md border transition cursor-pointer text-mist-300
                    {{ $view === 'grid' ? 'bg-gray-900 hover:bg-gray-700' : 'bg-gray-700 hover:bg-gray-500' }}"
            >
                <i class="bi bi-grid"></i>
            </button>
        </div>
    </div>

    @if ($view === 'table')
        <div class="scroll-area max-h-96 overflow-y-auto overflow-x-auto border border-gray-600 rounded-lg">
            <table class="w-full border-collapse">
                <thead class="sticky top-0 bg-gray-600 text-mist-300 z-10">
                    <tr>
                        <th class="p-3">Naam</th>
                        <th class="p-3 hidden md:table-cell">Aantal uitgaven</th>
                        @if($filteredOnSerie)
                            <th class="p-3"># in serie</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @forelse ($albums as $album)
                        <tr
                            class="border-t hover:bg-gray-400 cursor-pointer"
                            wire:click="openCollectModal({{ $album->id }})"
                        >
                            <td class="p-3 font-medium text-center">
                                {{ $album->name }}
                            </td>

                            <td class="p-3 font-medium text-center hidden md:table-cell">
                                {{ $album->editions->count() }}
                            </td>

                            @if($filteredOnSerie)
                                <td class="p-3 font-medium text-center">
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
                <div class="bg-gray-700 rounded-lg shadow border border-mist-300 overflow-hidden flex">
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
                                class="w-full px-3 py-1 rounded text-mist-300 text-sm bg-green-500 hover:bg-green-600"
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

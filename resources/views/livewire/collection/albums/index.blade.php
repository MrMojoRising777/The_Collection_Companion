<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-mist-300 text-3xl font-bold text-center mb-6 font-serif">
        Jouw albums
    </h1>

    <div class="flex justify-center items-center mb-6 gap-3">
        <button wire:click="switchView('table')"
                class="px-4 py-2 rounded-lg shadow transition
                {{ $viewMode === 'table' ? 'bg-gray-700 text-white' : 'bg-gray-500 text-white hover:bg-gray-600' }}"
        >
            Tabel
        </button>

        <button wire:click="switchView('grid')"
                class="px-4 py-2 rounded-lg shadow transition
                {{ $viewMode === 'grid' ? 'bg-gray-700 text-white' : 'bg-gray-500 text-white hover:bg-gray-600' }}"
        >
            Grid
        </button>
    </div>

    @if ($collection->isEmpty())
        <p class="text-center text-gray-400 italic">
            Geen albums gevonden in je collectie
        </p>
    @else

        <div class="mb-6">
            {{ $collection->links() }}
        </div>

        @if ($viewMode === 'grid')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($collection as $collected)
                    <div
                        wire:click="showAlbum({{ $collected->edition->id }})"
                        class="bg-gray-500 rounded-xl shadow border hover:shadow-lg transition overflow-hidden"
                    >

                        <img src="{{ asset($collected->edition->album->image) }}"
                             alt="{{ $collected->edition->album->name }}"
                             class="w-full h-48 object-cover"
                        />

                        <div class="p-4 text-center">
                            <h2 class="text-lg font-semibold mb-1">
                                {{ $collected->edition->album->name }}
                            </h2>

                            <p class="text-mist-300 text-sm mb-2">
                                {{ $collected->edition->serie->name }}
                            </p>

                            <p class="text-xs text-gray-300 mb-3">
                                Nr. {{ $collected->edition->volume }}
                            </p>

                            <div class="flex justify-center gap-2 mb-3">
                                <button wire:click="toggleFavorite({{ $collected->editionId }})">
                                    <i class="bi {{ $collected->favorite ? 'bi-star-fill' : 'bi-star' }} text-yellow-400 cursor-pointer"></i>
                                </button>

                                <button wire:click="toggleFirstPrint({{ $collected->editionId }})">
                                    <i class="bi {{ $collected->firstPrint ? 'bi-check-circle-fill' : 'bi-circle' }} text-mist-400 cursor-pointer"></i>
                                </button>

                                <button wire:click="remove({{ $collected->editionId }})">
                                    <i class="bi bi-x text-xl text-red-400 cursor-pointer"></i>
                                </button>
                            </div>

{{--                            <a href="{{ route('collection.albums.show', $collected->albumId) }}"--}}
{{--                               class="inline-block mt-2 px-4 py-2 bg-blue-600 hover:bg-blue-500 rounded text-white text-sm">--}}
{{--                                Bekijk--}}
{{--                            </a>--}}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($viewMode === 'table')
            <div class="bg-gray-500 rounded-xl shadow border overflow-hidden">
                <table class="w-full text-sm">

                    <thead class="bg-gray-600 text-white">
                        <tr>
                            <th class="p-3 text-left">Naam</th>
                            <th class="p-3 text-left">Serie</th>
                            <th class="p-3 text-left">Nr</th>
                            <th class="p-3 text-left">Acties</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($collection as $collected)
                        <tr
                            wire:click="showAlbum({{ $collected->edition->id }})"
                            class="border-t border-gray-400 hover:bg-gray-600 transition"
                        >
                            <td class="p-3">
                                {{ $collected->edition->album->name }}
                            </td>

                            <td class="p-3">
                                {{ $collected->edition->serie->name }}
                            </td>

                            <td class="p-3">
                                {{ $collected->edition->volume }}
                            </td>

                            <td class="p-3 flex gap-2">
                                <button wire:click="toggleFavorite({{ $collected->editionId }})">
                                    <i class="bi {{ $collected->favorite ? 'bi-star-fill' : 'bi-star' }} text-yellow-400 cursor-pointer"></i>
                                </button>

                                <button wire:click="toggleFirstPrint({{ $collected->editionId }})">
                                    <i class="bi {{ $collected->firstPrint ? 'bi-check-circle-fill' : 'bi-circle' }} text-mist-400 cursor-pointer"></i>
                                </button>

                                <button wire:click="remove({{ $collected->editionId }})">
                                    <i class="bi bi-x text-xl text-red-400 cursor-pointer"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif
</div>

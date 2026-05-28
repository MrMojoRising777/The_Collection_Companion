<div class="max-w-7xl mx-auto px-4 py-2">
    <h1 class="text-mist-100 text-3xl font-bold text-center mb-3 font-serif">
        Alle Series
    </h1>

    <blockquote class="text-center text-mist-300 italic mb-4">
        Bekijk en doorzoek ALLE series in de app. Beslis hier of je de serie wil verzamelen.
    </blockquote>

    <div class="relative mb-6">
        <div class="flex justify-center px-4 sm:px-0">
            <div class="w-full max-w-md">
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Zoeken..."
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
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
                        <th class="p-3">
                            <span class="hidden md:inline">Verzamelen</span>
                        </th>
                        <th class="p-3">
                            <span class="hidden md:inline">Afkorting</span>
                            <span class="inline md:hidden">Afk.</span>
                        </th>
                        <th class="p-3 hidden md:table-cell">Naam</th>
                        <th class="p-3 hidden md:table-cell">Periode</th>
                        <th class="p-3">Strips</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($series as $serie)
                        <tr
                            class="border-t hover:bg-gray-400 cursor-pointer"
                            wire:click="showSerie({{ $serie->id }})"
                        >
                            <td class="p-3" @click.stop>
                                <button
                                    wire:click="toggleTracking({{ $serie->id }})"
                                    class="px-3 py-1 rounded text-white text-sm
                                        {{ $user->trackedSeries->contains($serie) ? 'bg-red-500' : 'bg-green-500' }}"
                                >
                                    <i class="bi bi-collection md:hidden"></i>

                                    <span class="hidden md:inline">
                                        {{ $user->trackedSeries->contains($serie) ? 'Verwijder' : 'Verzamel' }}
                                    </span>
                                </button>
                            </td>
                            <td class="p-3 text-center">{{ $serie->abbreviation }}</td>
                            <td class="p-3 hidden md:table-cell">{{ $serie->name }}</td>
                            <td class="p-3 hidden md:table-cell">{{ $serie->period }}</td>
                            <td class="p-3 text-center">{{ $serie->albums_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if ($view === 'grid')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($series as $serie)
                <div class="bg-gray-700 rounded-lg shadow border border-mist-300 overflow-hidden flex">
                    <div class="w-1/2">
                        <img
                            src="{{ asset('uploads/images/placeholder_cover.jpg') }}"
                            class="w-full h-full object-cover"
                            alt="Serie cover"
                        >
                    </div>

                    <div class="w-1/2 p-4 flex flex-col justify-between">
                        <div>
                            <h5 class="font-semibold text-lg">
                                {{ $serie->abbreviation }} - {{ $serie->name }}
                            </h5>

                            <p class="text-sm text-gray-500">
                                {{ $serie->period }}
                            </p>

                            <p class="text-sm text-gray-700 mt-1">
                                Aantal strips: {{ $serie->albums_count }}
                            </p>
                        </div>

                        <div class="mt-3 flex flex-col gap-2">
                            <a
                                href="{{ route('series.show', $serie->id) }}"
                                class="text-center px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm"
                            >
                                View
                            </a>

                            <button
                                wire:click="toggleTracking({{ $serie->id }})"
                                class="px-3 py-1 rounded text-white text-sm
                                {{ $user->trackedSeries->contains($serie) ? 'bg-red-500' : 'bg-green-500' }}"
                            >
                                {{ $user->trackedSeries->contains($serie) ? 'Verwijder' : 'Verzamel' }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <livewire:components.modal />
</div>

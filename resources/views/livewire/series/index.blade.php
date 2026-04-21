<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-mist-100 text-3xl font-bold text-center mb-3 font-serif">
        Alle Series
    </h1>

    <blockquote class="text-center text-mist-300 italic mb-6">
        Bekijk en doorzoek ALLE series in de app. Beslis hier of je de serie wil verzamelen.
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
            <button class="bg-red-500 mb-4 rounded-full p-2 cursor-pointer" wire:click="scanISBN()">
                <span class="font-bold">Scan ISBN</span>
            </button>

            <button class="bg-indigo-500 nm-4 rounded-full p-2" wire:click="seedDB()">
                <span class="font-bold">Seed DB</span>
            </button>

            <input
                type="text"
                wire:model.live="search"
                placeholder="Zoeken..."
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>
    </div>

    @if ($view === 'table')
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-600 rounded-lg overflow-hidden">
                <thead class="bg-gray-600 text-mist-300 text-left">
                    <tr>
                        <th class="p-3">Verzamelen</th>
                        <th class="p-3">Afkorting</th>
                        <th class="p-3">Naam</th>
                        <th class="p-3">Periode</th>
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
                                    {{ $user->trackedSeries->contains($serie) ? 'Verwijder' : 'Verzamel' }}
                                </button>
                            </td>

                            <td class="p-3">{{ $serie->abbreviation }}</td>
                            <td class="p-3">{{ $serie->name }}</td>
                            <td class="p-3">{{ $serie->period }}</td>
                            <td class="p-3">{{ $serie->albums_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if ($view === 'grid')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($series as $serie)
                <div class="bg-white rounded-xl shadow border overflow-hidden flex">
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

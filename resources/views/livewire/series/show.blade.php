<div class="max-w-md mx-auto mt-6">
    <div class="bg-white dark:bg-gray-600 shadow-lg rounded-2xl p-6">
        <h1 class="text-2xl font-bold text-center mb-6 text-gray-900 dark:text-white">
            {{ $serie->name }} - {{ $serie->abbreviation }}
        </h1>

        <div class="space-y-3 text-center">
            <p class="text-gray-700 dark:text-gray-300 text-lg">
                Aantal strips: {{ $serie->albums_count }}
            </p>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $serie->period }}
            </p>
        </div>
        <div class="mt-6 flex justify-center">
            <a
                href="{{ route('series.index') }}"
                class="px-5 py-2 rounded-lg font-medium text-white
                       bg-indigo-600 hover:bg-indigo-700
                       focus:ring-2 focus:ring-indigo-500
                       transition"
            >
                Terug naar overzicht
            </a>
        </div>
    </div>
</div>

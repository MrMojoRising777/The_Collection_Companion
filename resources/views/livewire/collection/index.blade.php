<div class="max-w-4xl mx-auto px-4 py-6">
    <h1 class="text-mist-300 text-3xl font-bold text-center mb-6 font-serif">
        Jouw Collectie
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div
            wire:click="goToSeries"
            class="cursor-pointer bg-gray-500 rounded-xl shadow border p-6 text-center hover:shadow-lg transition"
        >
            <h2 class="text-xl font-semibold mb-2">
                Jouw series
            </h2>

            <p class="text-mist-300 text-sm">
                Bekijk en beheer je series
            </p>
        </div>

        <div
            wire:click="goToAlbums"
            class="cursor-pointer bg-gray-500 rounded-xl shadow border p-6 text-center hover:shadow-lg transition"
        >
            <h2 class="text-xl font-semibold mb-2">
                Jouw albums
            </h2>

            <p class="text-mist-300 text-sm">
                Bekijk en beheer je albums
            </p>
        </div>
    </div>
</div>

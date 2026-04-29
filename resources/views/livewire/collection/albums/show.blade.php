<div class="max-w-5xl mx-auto px-4 py-6">
    <h1 class="text-mist-100 text-3xl font-bold text-center mb-3 font-serif">
        {{ $edition->album->name }}
    </h1>

    <h3 class="text-mist-100 text-xl font-semibold text-center mb-4">
        {{ $edition->serie->name }}
    </h3>

    <blockquote class="text-center text-mist-300 italic mb-6">
        Album details en informatie uit je collectie.
    </blockquote>

    <div class="bg-white/5 border border-gray-700 rounded-xl shadow-md p-6 flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-2/3 bg-gray-900/40 p-4 rounded-lg text-gray-200 relative">
            <i
                class="bi bi-pencil absolute top-3 right-3 cursor-pointer hover:text-white"
                wire:click="openEditAlbumModal({{ $edition->id }})"
            ></i>

            <p class="mb-2">
                <strong>Nummer:</strong> {{ $edition->volume }}
            </p>

            <p class="mb-2">
                <strong>Kaft:</strong> {{ $edition->cover }}
            </p>

            <p class="mb-2">
                <strong>Kleur:</strong> {{ $edition->color }}
            </p>

            <p class="mb-2">
                <strong>Eerste Druk:</strong> {{ $edition->firstPrint }}
            </p>

            <p class="mb-2">
                <strong>Waarde:</strong> €{{ $edition->value }}
            </p>

            <hr class="my-4 border-gray-700">

            <p class="mb-2">
                <strong>Notitie:</strong> {{ $edition->notes }}
            </p>

            <p class="mb-2">
                <strong>Print Jaar:</strong> {{ $edition->printYear }}
            </p>

            <p class="mb-2">
                <strong>Plaats van aankoop:</strong> {{ $edition->purchasePlace }}
            </p>

            <p class="mb-2">
                <strong>Aankoopprijs:</strong> €{{ $edition->purchasePrice }}
            </p>

            <p class="mb-2">
                <strong>Aankoopdatum:</strong> {{ $edition->purchaseDate }}
            </p>
        </div>

        <div class="w-full md:w-1/3 flex items-center justify-center">
            <img
                src="{{ $edition->image ? asset($edition->image) : asset('uploads/images/placeholder_cover.jpg') }}"
                alt="Album cover"
                class="w-full h-auto rounded-lg shadow"
            >
        </div>
    </div>
</div>

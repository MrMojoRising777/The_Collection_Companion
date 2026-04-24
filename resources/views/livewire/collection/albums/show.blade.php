<div class="max-w-5xl mx-auto px-4 py-6">
    <h1 class="text-mist-100 text-3xl font-bold text-center mb-3 font-serif">
        {{ $albumSerie->album->name }}
    </h1>

    <h3 class="text-mist-100 text-xl font-semibold text-center mb-4">
        {{ $albumSerie->serie->name }}
    </h3>

    <blockquote class="text-center text-mist-300 italic mb-6">
        Album details en informatie uit je collectie.
    </blockquote>

    <div class="bg-white/5 border border-gray-700 rounded-xl shadow-md p-6 flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-2/3 bg-gray-900/40 p-4 rounded-lg text-gray-200">
            <p class="mb-2">
                <strong>Nummer:</strong> {{ $albumSerie->volume }}
            </p>

            <p class="mb-2">
                <strong>Kaft:</strong> {{ $albumSerie->cover }}
            </p>

            <p class="mb-2">
                <strong>Kleur:</strong> {{ $albumSerie->color }}
            </p>

            <p class="mb-2">
                <strong>Eerste Druk:</strong> {{ $albumSerie->firstPrint }}
            </p>

            <p class="mb-2">
                <strong>Waarde:</strong> €{{ $albumSerie->value }}
            </p>

            <hr class="my-4 border-gray-700">

            <p class="mb-2">
                <strong>Notitie:</strong> {{ $albumSerie->notes }}
            </p>

            <p class="mb-2">
                <strong>Print Jaar:</strong> {{ $albumSerie->printYear }}
            </p>

            <p class="mb-2">
                <strong>Plaats van aankoop:</strong> {{ $albumSerie->purchasePlace }}
            </p>

            <p class="mb-2">
                <strong>Aankoopprijs:</strong> €{{ $albumSerie->purchasePrice }}
            </p>

            <p class="mb-2">
                <strong>Aankoopdatum:</strong> {{ $albumSerie->purchaseDate }}
            </p>
        </div>

        <div class="w-full md:w-1/3 flex items-center justify-center">
            <img
                src="{{ $albumSerie->image ? asset($albumSerie->image) : asset('uploads/images/placeholder_cover.jpg') }}"
                alt="Album cover"
                class="w-full h-auto rounded-lg shadow"
            >
        </div>
    </div>
</div>

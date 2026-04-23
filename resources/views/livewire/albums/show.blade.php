<div class="max-w-5xl mx-auto px-4 py-6">
    <h1 class="text-mist-100 text-3xl font-bold text-center mb-3 font-serif">
        {{ $album->name }}
    </h1>

    <blockquote class="text-center text-mist-300 italic mb-6">
        Album details en informatie uit je collectie.
    </blockquote>

    <div class="bg-white/5 border border-gray-700 rounded-xl shadow-md p-6 flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-2/3 bg-gray-900/40 p-4 rounded-lg text-gray-200">
            <p class="mb-2">
                <strong>Nummer:</strong> {{ $album->volume }}
            </p>

            <p class="mb-2">
                <strong>Kaft:</strong> {{ $album->cover }}
            </p>

            <p class="mb-2">
                <strong>Kleur:</strong> {{ $album->color }}
            </p>

            <p class="mb-2">
                <strong>Eerste Druk:</strong> {{ $album->first_print }}
            </p>

            <p class="mb-2">
                <strong>Waarde:</strong> €{{ $album->value }}
            </p>

{{--            @if ($this->hasAlbum())--}}
{{--                <hr class="my-4 border-gray-700">--}}

{{--                <p class="mb-2">--}}
{{--                    <strong>Notitie:</strong> {{ $album->notes }}--}}
{{--                </p>--}}

{{--                <p class="mb-2">--}}
{{--                    <strong>Print Jaar:</strong> {{ $album->print_year }}--}}
{{--                </p>--}}

{{--                <p class="mb-2">--}}
{{--                    <strong>Plaats van aankoop:</strong> {{ $album->purchase_place }}--}}
{{--                </p>--}}

{{--                <p class="mb-2">--}}
{{--                    <strong>Aankoopprijs:</strong> €{{ $album->purchase_price }}--}}
{{--                </p>--}}

{{--                <p class="mb-2">--}}
{{--                    <strong>Aankoopdatum:</strong> {{ $album->purchase_date }}--}}
{{--                </p>--}}
{{--            @else--}}
{{--                <p class="italic text-gray-400 mt-4">--}}
{{--                    Meer informatie wordt beschikbaar als je dit album in je collectie hebt.--}}
{{--                </p>--}}
{{--            @endif--}}
        </div>

        <div class="w-full md:w-1/3 flex items-center justify-center">
            <img
                src="{{ $album->image ? asset($album->image) : asset('uploads/images/placeholder_cover.jpg') }}"
                alt="Album cover"
                class="w-full h-auto rounded-lg shadow"
            >
        </div>
    </div>
</div>

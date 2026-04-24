<div class="relative w-full max-w-3xl mx-auto">

    <div class="overflow-hidden rounded-2xl">
        <div
            class="flex transition-transform duration-500"
             style="transform: translateX(-{{ $currentIndex * 100 }}%)"
        >
            @foreach ($recentAlbums as $recentAlbum)
                <div class="w-full flex-shrink-0">
                    <img
                        src="{{ $recentAlbum->albumSerie->cover }}"
                        alt="{{ $recentAlbum->albumSerie->album->name }}"
                         class="w-full h-64 object-cover"
                    />

                    <div class="p-4 bg-black/50 text-white absolute bottom-0 w-full">
                        {{ $recentAlbum->albumSerie->album->name }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <button wire:click="prev"
            class="
                absolute left-2 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white px-3 py-1 rounded-full
                dark:bg-black/50 dark:hover:bg-gray-700
            "
    >
        <i class="bi bi-arrow-left-short"></i>
    </button>

    <button wire:click="next"
            class="
                absolute right-2 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white px-3 py-1 rounded-full
                dark:bg-black/50 dark:hover:bg-gray-700
            "
    >
        <i class="bi bi-arrow-right-short"></i>
    </button>

    <div class="flex justify-center mt-4 gap-2">
        @foreach ($recentAlbums as $index => $recentAlbum)
            <button
                wire:click="goTo({{ $index }})"
                class="w-3 h-3 rounded-full {{ $currentIndex === $index ? 'bg-blue-500' : 'bg-gray-300' }}"
            >
            </button>
        @endforeach
    </div>
</div>

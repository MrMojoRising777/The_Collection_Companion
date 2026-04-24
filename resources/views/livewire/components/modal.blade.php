<div
    x-data="{ open: @entangle('open') }"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center"
>
    <div
        class="absolute inset-0 bg-black/50"
        @click="open = false"
    ></div>

    <div
        x-show="open"
        x-transition
        class="relative bg-gray-600 rounded-2xl shadow-xl w-full max-w-lg p-6"
    >
        <button
            class="absolute top-2 right-3 text-mist-300 cursor-pointer"
            @click="open = false"
        >
            <i class="bi bi-x text-2xl text-gray-300 hover:text-red-300"></i>
        </button>

        <h2 class="text-xl font-bold mb-4">
            {{ $title }}
        </h2>

        <div>
            @if($component)
                @livewire($component, $props, key($component.'-'.($props['albumId'] ?? 'default')))
            @endif
        </div>
    </div>
</div>

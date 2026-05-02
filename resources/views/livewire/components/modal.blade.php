<div
    x-data
    x-show="$wire.open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center"
>
    <div
        class="absolute inset-0 bg-black/50"
        wire:click="close"
    ></div>

    <div
        x-show="$wire.open"
        x-transition
        class="relative bg-gray-800 rounded-2xl shadow-xl w-full max-w-lg p-6
            max-h-[90vh] flex flex-col overflow-hidden"
    >
        <button
            class="absolute top-2 right-3 text-mist-300 cursor-pointer"
            wire:click="close"
        >
            <i class="bi bi-x text-2xl text-gray-300 hover:text-red-300"></i>
        </button>

        <h2 class="text-xl font-bold mb-4">
            {{ $title }}
        </h2>

        <div class="px-6 pb-6 overflow-y-auto flex-1">
            @if($component)
                @livewire($component, $props, key($component.'-'.($props['albumId'] ?? 'default')))
            @endif
        </div>
    </div>
</div>

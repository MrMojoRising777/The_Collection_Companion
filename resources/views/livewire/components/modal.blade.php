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
            class="absolute top-2 right-2 text-mist-300"
            @click="open = false"
        >
            ✕
        </button>

        <h2 class="text-xl font-bold mb-4">
            {{ $title }}
        </h2>

        <div>
            @if($view)
                @include($view, $viewData)
            @endif
        </div>
    </div>
</div>

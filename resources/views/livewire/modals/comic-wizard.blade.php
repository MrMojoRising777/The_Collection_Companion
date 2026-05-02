<div class="relative space-y-4">
    @if($step === 'search')
        <div class="space-y-3">
            <h2 class="text-lg font-bold">Strip opzoeken</h2>

            <input
                wire:model="query"
                wire:keydown.enter="search"
                type="text"
                placeholder="Title"
                class="w-full border rounded p-2"
            />

            <div class="flex gap-2">
                <button
                    wire:click="search"
                    class="flex-1 bg-blue-500 text-white rounded p-2 cursor-pointer"
                >
                    Search
                </button>
            </div>
        </div>
    @endif

    @if($step === 'confirm' && ! empty($results))
            <div class="space-y-2">
                <livewire:components.accordion :items="$results" />
            </div>
    @endif

    @if($step === 'idle')
        <div class="flex justify-center">
            <button
                wire:click="startScan"
                class="px-4 py-2 bg-indigo-600 text-white rounded"
            >
                Start Scan
            </button>
        </div>
    @endif
</div>

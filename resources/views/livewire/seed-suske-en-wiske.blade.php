<div>
    <button
        wire:click="seed"
        wire:loading.attr="disabled"
        class="px-4 py-2 bg-blue-500 text-white rounded"
    >
        <span wire:loading.remove>
            Import Suske en Wiske
        </span>

        <span wire:loading>
            Seeding...
        </span>
    </button>
</div>

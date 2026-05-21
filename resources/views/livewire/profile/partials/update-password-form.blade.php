<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Wijzig wachtwoord
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Zorg ervoor dat je account een lang, willekeurig wachtwoord gebruikt om veilig te blijven.
        </p>
    </header>

    <form wire:submit.prevent="updatePassword" class="mt-6 space-y-6">

        <div>
            <x-input-label for="current_password" value="Huidig wachtwoord" />
            <x-text-input
                id="current_password"
                type="password"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                wire:model.defer="current_password"
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Nieuw wachtwoord" />
            <x-text-input
                id="password"
                type="password"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                wire:model.defer="password"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Bevestig wachtwoord" />
            <x-text-input
                id="password_confirmation"
                type="password"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                wire:model.defer="password_confirmation"
                autocomplete="new-password"
            />
        </div>

        <div class="flex items-center gap-4">
            <button class="bg-indigo-500 nm-4 rounded p-2 cursor-pointer" wire:loading.attr="disabled">
                <span wire:loading.remove>Opslaan</span>
                <span wire:loading>Bezig...</span>
            </button>
        </div>
    </form>
</section>

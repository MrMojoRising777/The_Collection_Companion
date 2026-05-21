<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Verwijder account
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Eenmaal je account verwijderd is, zullen al je gegevens permanent verwijderd worden.
            Voordat je je account verwijdert, gelieve alle gegevens of informatie die je wenst te behouden te exporteren.
        </p>
    </header>

    <x-danger-button wire:click="confirmUserDeletion">
        Verwijder
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$confirmingUserDeletion" focusable>
        <form wire:submit.prevent="deleteUser" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Ben je zeker dat je je account wil verwijderen?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Zodra je account is verwijderd, worden al je gegevens permanent verwijderd.
                Voer alsjeblieft je wachtwoord in om te bevestigen dat je je account permanent wilt verwijderen.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Password" class="sr-only" />

                <x-text-input
                    wire:model.defer="password"
                    id="password"
                    type="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Wachtwoord"
                />

                @error('password')
                    <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button wire:click="$set('confirmingUserDeletion', false)">
                    Terug
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Verwijder Account
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

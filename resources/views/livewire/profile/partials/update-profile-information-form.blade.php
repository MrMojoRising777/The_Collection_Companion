<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Profiel Informatie
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Werk de profielinformatie en het e-mailadres van uw account bij.
        </p>
    </header>

    <form wire:submit.prevent="updateProfile" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" value="Naam" />
            <x-text-input
                id="name"
                type="text"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                wire:model.defer="name"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                type="email"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                wire:model.defer="email"
                required
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (
                $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&
                ! $user->hasVerifiedEmail()
            )
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        Je emailadres is niet geverifieerd.

                        <button
                            type="button"
                            wire:click="sendVerification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        >
                            Klik hier om de verificatie-email opnieuw te verzenden.
                        </button>
                    </p>

                    @if ($verificationLinkSent)
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            Er is een nieuwe verificatielink naar uw emailadres verzonden.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button class="bg-indigo-500 nm-4 rounded p-2 cursor-pointer" wire:loading.attr="disabled">
                Opslaan
            </button>
        </div>
    </form>
</section>

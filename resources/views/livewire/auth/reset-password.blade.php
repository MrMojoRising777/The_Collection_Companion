<div class="max-w-md mx-auto">
    <x-auth-session-status
        class="mb-4 text-sm text-green-600"
        :status="session('status')" />

    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">
        <h1 class="text-2xl font-bold text-center mb-6">
            Nieuw wachtwoord instellen
        </h1>

        <form wire:submit.prevent="resetPassword" class="space-y-5">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Email
                </label>

                <input
                    wire:model.defer="email"
                    id="email"
                    type="email"
                    required
                    autocomplete="username"
                    class="mt-1 w-full px-4 py-2 border rounded-lg
                           bg-white dark:bg-gray-900
                           border-gray-300 dark:border-gray-700
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                           outline-none transition"
                />

                @error('email')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Wachtwoord
                </label>

                <input
                    wire:model.defer="password"
                    id="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="mt-1 w-full px-4 py-2 border rounded-lg
                           bg-white dark:bg-gray-900
                           border-gray-300 dark:border-gray-700
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                           outline-none transition"
                />

                @error('password')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Bevestig wachtwoord
                </label>

                <input
                    wire:model.defer="password_confirmation"
                    id="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="mt-1 w-full px-4 py-2 border rounded-lg
                           bg-white dark:bg-gray-900
                           border-gray-300 dark:border-gray-700
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                           outline-none transition"
                />

                @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="px-5 py-2 rounded-lg font-medium text-white
                           bg-indigo-600 hover:bg-indigo-700
                           focus:ring-2 focus:ring-indigo-500
                           disabled:opacity-50 transition">

                    <span wire:loading.remove>Wachtwoord resetten</span>
                    <span wire:loading>Bezig...</span>
                </button>
            </div>
        </form>
    </div>
</div>

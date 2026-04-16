<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">
        <h1 class="text-2xl font-bold text-center mb-6">
            Registreren
        </h1>

        <form wire:submit.prevent="register" class="space-y-5">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Naam
                </label>

                <input
                    wire:model.defer="name"
                    id="name"
                    type="text"
                    required
                    autofocus
                    class="mt-1 w-full px-4 py-2 border rounded-lg
                           bg-white dark:bg-gray-900
                           border-gray-300 dark:border-gray-700
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                           outline-none transition"
                />

                @error('name')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

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
            </div>

            <div class="flex items-center justify-between pt-2">
                <a
                    href="{{ route('login') }}"
                    class="text-sm text-indigo-600 hover:underline">
                    Al een account?
                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="ml-3 px-5 py-2 rounded-lg font-medium text-white
                           bg-indigo-600 hover:bg-indigo-700
                           focus:ring-2 focus:ring-indigo-500
                           disabled:opacity-50 transition">

                    <span wire:loading.remove>Registreren</span>
                    <span wire:loading>Bezig...</span>
                </button>
            </div>
        </form>
    </div>
</div>

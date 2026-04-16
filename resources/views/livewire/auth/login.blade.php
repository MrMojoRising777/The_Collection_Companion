<div class="max-w-md mx-auto">
    <x-auth-session-status
        class="mb-4 text-sm text-green-600"
        :status="session('status')" />

    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">
        <h1 class="text-2xl font-bold text-center mb-6">
            Inloggen
        </h1>

        <form wire:submit.prevent="login" class="space-y-5">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Email
                </label>

                <input
                    wire:model.defer="email"
                    id="email"
                    type="email"
                    required
                    autofocus
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
                    autocomplete="current-password"
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

            <div class="flex items-center">
                <input
                    id="remember"
                    type="checkbox"
                    wire:model="remember"
                    class="h-4 w-4 text-indigo-600 border-gray-300 rounded
                        focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700"
                >

                <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                    Onthoud mij
                </label>
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-sm text-indigo-600 hover:underline">
                        Wachtwoord vergeten?
                    </a>
                @endif

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="ml-3 px-5 py-2 rounded-lg font-medium text-white
                           bg-indigo-600 hover:bg-indigo-700
                           focus:ring-2 focus:ring-indigo-500
                           disabled:opacity-50 transition">

                    <span wire:loading.remove>Inloggen</span>
                    <span wire:loading>Bezig...</span>
                </button>
            </div>
        </form>
    </div>
</div>

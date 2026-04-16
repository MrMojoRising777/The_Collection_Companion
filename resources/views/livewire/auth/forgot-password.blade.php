<div class="max-w-md mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">
        <h1 class="text-2xl font-bold text-center mb-4">
            Wachtwoord vergeten?
        </h1>

        <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 text-center">
            Geen probleem! Vul je e-mail in en we sturen je een reset link.
        </p>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit.prevent="sendResetLink" class="space-y-5">
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

            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}"
                   class="text-sm text-indigo-600 hover:underline">
                    Terug naar login
                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="px-5 py-2 rounded-lg font-medium text-white
                           bg-indigo-600 hover:bg-indigo-700
                           focus:ring-2 focus:ring-indigo-500
                           disabled:opacity-50 transition">

                    <span wire:loading.remove>
                        Verstuur reset link
                    </span>

                    <span wire:loading>
                        Bezig...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

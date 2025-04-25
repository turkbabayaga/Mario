<x-guest-layout>

    <!-- ✅ Message de succès -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 font-semibold text-center rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- ❌ Message d'erreur API générique -->
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 font-semibold text-center rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- ❌ Erreurs de validation Laravel -->
    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 font-semibold text-center rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.api') }}"
          class="max-w-md mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
        @csrf

        <h2 class="text-center text-white text-2xl font-bold mb-6">Connexion au panel Mario</h2>

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                       name="remember">
                <span class="ms-2 text-sm text-gray-300">{{ __('Se souvenir de moi') }}</span>
            </label>
        </div>

        <!-- Submit -->
        <div class="flex justify-center mt-6">
            <x-primary-button class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-md">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

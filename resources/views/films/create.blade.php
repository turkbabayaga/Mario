<<<<<<< HEAD
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Ajouter un film') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-2xl w-full bg-white dark:bg-gray-800 shadow-xl rounded-lg p-8">

            <!-- Affichage des messages -->
            @if(session('success'))
                <div class="mb-4 text-green-700 bg-green-100 border border-green-400 rounded-lg p-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 text-red-700 bg-red-100 border border-red-400 rounded-lg p-4 text-center">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-700 bg-red-100 border border-red-400 rounded-lg p-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('films.store') }}" method="POST">
                @csrf

                <!-- Titre -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 dark:text-gray-300 font-medium">Titre</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-3/4 mx-auto px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 dark:text-gray-300 font-medium">Description</label>
                    <textarea name="description" id="description"
                        class="w-3/4 mx-auto px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500"
                        required>{{ old('description') }}</textarea>
                </div>

                <!-- Année de sortie -->
                <div class="mb-4">
                    <label for="release_year" class="block text-gray-700 dark:text-gray-300 font-medium">Année de sortie</label>
                    <input type="number" name="release_year" id="release_year" value="{{ old('release_year') }}"
                        class="w-1/2 mx-auto px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- ID Langue et ID Langue d'origine -->
                <div class="grid grid-cols-2 gap-4 mb-4 max-w-lg mx-auto">
                    <div>
                        <label for="language_id" class="block text-gray-700 dark:text-gray-300 font-medium">ID Langue</label>
                        <input type="number" name="language_id" id="language_id" value="{{ old('language_id') }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div>
                        <label for="original_language_id" class="block text-gray-700 dark:text-gray-300 font-medium">ID Langue d'origine</label>
                        <input type="number" name="original_language_id" id="original_language_id" value="{{ old('original_language_id') }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Durée et taux de location -->
                <div class="grid grid-cols-2 gap-4 mb-4 max-w-lg mx-auto">
                    <div>
                        <label for="rental_duration" class="block text-gray-700 dark:text-gray-300 font-medium">Durée de location</label>
                        <input type="number" name="rental_duration" id="rental_duration" value="{{ old('rental_duration', 3) }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="rental_rate" class="block text-gray-700 dark:text-gray-300 font-medium">Taux de location</label>
                        <input type="number" step="0.01" name="rental_rate" id="rental_rate" value="{{ old('rental_rate') }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Longueur et coût de remplacement -->
                <div class="grid grid-cols-2 gap-4 mb-4 max-w-lg mx-auto">
                    <div>
                        <label for="length" class="block text-gray-700 dark:text-gray-300 font-medium">Longueur (en minutes)</label>
                        <input type="number" name="length" id="length" value="{{ old('length') }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="replacement_cost" class="block text-gray-700 dark:text-gray-300 font-medium">Coût de remplacement</label>
                        <input type="number" step="0.01" name="replacement_cost" id="replacement_cost" value="{{ old('replacement_cost') }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Évaluation et caractéristiques spéciales -->
                <div class="grid grid-cols-2 gap-4 mb-4 max-w-lg mx-auto">
                    <div>
                        <label for="rating" class="block text-gray-700 dark:text-gray-300 font-medium">Évaluation</label>
                        <input type="text" name="rating" id="rating" value="{{ old('rating') }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="special_features" class="block text-gray-700 dark:text-gray-300 font-medium">Caractéristiques spéciales</label>
                        <input type="text" name="special_features" id="special_features" value="{{ old('special_features') }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- ID du réalisateur -->
                <div class="mb-6 max-w-lg mx-auto">
                    <label for="id_director" class="block text-gray-700 dark:text-gray-300 font-medium">ID du réalisateur</label>
                    <input type="number" name="id_director" id="id_director" value="{{ old('id_director') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Date de dernière mise à jour -->
                <div class="mb-6 max-w-lg mx-auto">
                    <label for="last_update" class="block text-gray-700 dark:text-gray-300 font-medium">Date de dernière mise à jour</label>
                    <input type="datetime-local" name="last_update" id="last_update"
                        value="{{ old('last_update', now()->format('Y-m-d\TH:i')) }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <!-- Bouton d'ajout -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-green-600 transform hover:scale-105 transition-all duration-300">
                        Ajouter le film
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
=======
<form action="{{ route('films.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="description" id="description" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="release_year">Année de sortie</label>
        <input type="number" name="release_year" id="release_year" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="language_id">ID Langue</label>
        <input type="number" name="language_id" id="language_id" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="original_language_id">ID Langue d'origine</label>
        <input type="number" name="original_language_id" id="original_language_id" class="form-control">
    </div>
    <div class="form-group">
        <label for="rental_duration">Durée de location</label>
        <input type="number" name="rental_duration" id="rental_duration" class="form-control" value="3">
    </div>
    <div class="form-group">
        <label for="rental_rate">Taux de location</label>
        <input type="number" name="rental_rate" id="rental_rate" class="form-control" step="0.01">
    </div>
    <div class="form-group">
        <label for="length">Longueur (en minutes)</label>
        <input type="number" name="length" id="length" class="form-control">
    </div>
    <div class="form-group">
        <label for="replacement_cost">Coût de remplacement</label>
        <input type="number" name="replacement_cost" id="replacement_cost" class="form-control" step="0.01">
    </div>
    <div class="form-group">
        <label for="rating">Évaluation</label>
        <input type="text" name="rating" id="rating" class="form-control">
    </div>
    <div class="form-group">
        <label for="special_features">Caractéristiques spéciales</label>
        <input type="text" name="special_features" id="special_features" class="form-control">
    </div>
    <div class="form-group">
        <label for="id_director">ID du réalisateur</label>
        <input type="number" name="id_director" id="id_director" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Ajouter le film</button>
</form>
>>>>>>> a7da741f8cccd78179be3aa76fc445a4adf643c9

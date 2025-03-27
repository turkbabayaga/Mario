<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier le film') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg border border-gray-200 dark:border-gray-700 p-8">
                <form action="{{ route('films.update', $film['filmId']) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Form fields for movie details -->
                    <div class="space-y-4">
                        <!-- Titre -->
                        <div>
                            <label for="title" class="block text-lg text-gray-700 dark:text-gray-300">Titre</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $film['title']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700" required>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-lg text-gray-700 dark:text-gray-300">Description</label>
                            <input type="text" id="description" name="description" value="{{ old('description', $film['description']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700" required>
                        </div>

                        <!-- Année de sortie -->
                        <div>
                            <label for="release_year" class="block text-lg text-gray-700 dark:text-gray-300">Année de sortie</label>
                            <input type="number" id="release_year" name="release_year" value="{{ old('release_year', $film['releaseYear']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700" required>
                        </div>

                        <!-- ID Langue -->
                        <div>
                            <label for="language_id" class="block text-lg text-gray-700 dark:text-gray-300">ID Langue</label>
                            <input type="number" id="language_id" name="language_id" value="{{ old('language_id', $film['languageId']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700" required>
                        </div>

                        <!-- ID Langue d'origine -->
                        <div>
                            <label for="original_language_id" class="block text-lg text-gray-700 dark:text-gray-300">ID Langue d'origine</label>
                            <input type="number" id="original_language_id" name="original_language_id" value="{{ old('original_language_id', $film['originalLanguageId']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700">
                        </div>

                        <!-- Durée de location -->
                        <div>
                            <label for="rental_duration" class="block text-lg text-gray-700 dark:text-gray-300">Durée de location</label>
                            <input type="number" id="rental_duration" name="rental_duration" value="{{ old('rental_duration', $film['rentalDuration']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700">
                        </div>

                        <!-- Taux de location -->
                        <div>
                            <label for="rental_rate" class="block text-lg text-gray-700 dark:text-gray-300">Taux de location</label>
                            <input type="number" id="rental_rate" name="rental_rate" value="{{ old('rental_rate', $film['rentalRate']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700" step="0.01">
                        </div>

                        <!-- Longueur -->
                        <div>
                            <label for="length" class="block text-lg text-gray-700 dark:text-gray-300">Longueur (en minutes)</label>
                            <input type="number" id="length" name="length" value="{{ old('length', $film['length']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700">
                        </div>

                        <!-- Coût de remplacement -->
                        <div>
                            <label for="replacement_cost" class="block text-lg text-gray-700 dark:text-gray-300">Coût de remplacement</label>
                            <input type="number" id="replacement_cost" name="replacement_cost" value="{{ old('replacement_cost', $film['replacementCost']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700" step="0.01">
                        </div>

                        <!-- Évaluation -->
                        <div>
                            <label for="rating" class="block text-lg text-gray-700 dark:text-gray-300">Évaluation</label>
                            <input type="text" id="rating" name="rating" value="{{ old('rating', $film['rating']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700">
                        </div>

                        <!-- Caractéristiques spéciales -->
                        <div>
                            <label for="special_features" class="block text-lg text-gray-700 dark:text-gray-300">Caractéristiques spéciales</label>
                            <input type="text" id="special_features" name="special_features" value="{{ old('special_features', $film['specialFeatures']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700">
                        </div>

<<<<<<< HEAD
=======
                        <!-- ID du réalisateur -->
                        <div>
                            <label for="id_director" class="block text-lg text-gray-700 dark:text-gray-300">ID du réalisateur</label>
                            <input type="number" id="id_director" name="id_director" value="{{ old('id_director', $film['idDirector']) }}" class="w-full px-4 py-2 rounded-lg border dark:border-gray-700">
                        </div>

>>>>>>> a7da741f8cccd78179be3aa76fc445a4adf643c9
                        <!-- Bouton de soumission -->
                        <div>
                            <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700">Mettre à jour</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </div>

    <!-- SweetAlert pour les messages -->
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Succès',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @elseif(session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Erreur',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
</x-app-layout>

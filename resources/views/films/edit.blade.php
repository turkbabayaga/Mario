<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl text-center text-white uppercase tracking-wide">
            {{ __('Modifier le film') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-gray-800 bg-opacity-60 backdrop-blur-md rounded-2xl shadow-2xl p-8">

                <form action="{{ route('films.update', $film['filmId']) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Titre --}}
                        <div>
                            <label for="title" class="block text-gray-200 mb-1">
                                <i class="bx bx-heading mr-1 text-indigo-400"></i>
                                Titre
                            </label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $film['title']) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500"
                                   required>
                        </div>

                        {{-- Année de sortie --}}
                        <div>
                            <label for="release_year" class="block text-gray-200 mb-1">
                                <i class="bx bx-calendar-alt mr-1 text-indigo-400"></i>
                                Année de sortie
                            </label>
                            <input type="number"
                                   id="release_year"
                                   name="release_year"
                                   value="{{ old('release_year', $film['releaseYear']) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500"
                                   required>
                        </div>

                        {{-- Langue --}}
                        <div>
                            <label for="language_id" class="block text-gray-200 mb-1">
                                <i class="bx bx-globe mr-1 text-indigo-400"></i>
                                ID Langue
                            </label>
                            <input type="number"
                                   id="language_id"
                                   name="language_id"
                                   value="{{ old('language_id', $film['languageId']) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500"
                                   required>
                        </div>

                        {{-- Langue d’origine --}}
                        <div>
                            <label for="original_language_id" class="block text-gray-200 mb-1">
                                <i class="bx bx-world mr-1 text-indigo-400"></i>
                                Langue d’origine
                            </label>
                            <input type="number"
                                   id="original_language_id"
                                   name="original_language_id"
                                   value="{{ old('original_language_id', $film['originalLanguageId']) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Durée (minutes) --}}
                        <div>
                            <label for="length" class="block text-gray-200 mb-1">
                                <i class="bx bx-time-five mr-1 text-indigo-400"></i>
                                Durée (min.)
                            </label>
                            <input type="number"
                                   id="length"
                                   name="length"
                                   value="{{ old('length', $film['length']) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Tarif de location --}}
                        <div>
                            <label for="rental_rate" class="block text-gray-200 mb-1">
                                <i class="bx bx-euro mr-1 text-indigo-400"></i>
                                Tarif location (€)
                            </label>
                            <input type="number"
                                   id="rental_rate"
                                   name="rental_rate"
                                   value="{{ old('rental_rate', $film['rentalRate']) }}"
                                   step="0.01"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Durée location --}}
                        <div>
                            <label for="rental_duration" class="block text-gray-200 mb-1">
                                <i class="bx bx-timer mr-1 text-indigo-400"></i>
                                Durée location (j)
                            </label>
                            <input type="number"
                                   id="rental_duration"
                                   name="rental_duration"
                                   value="{{ old('rental_duration', $film['rentalDuration']) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Coût de remplacement --}}
                        <div>
                            <label for="replacement_cost" class="block text-gray-200 mb-1">
                                <i class="bx bx-money mr-1 text-indigo-400"></i>
                                Remplacement (€)
                            </label>
                            <input type="number"
                                   id="replacement_cost"
                                   name="replacement_cost"
                                   value="{{ old('replacement_cost', $film['replacementCost']) }}"
                                   step="0.01"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Évaluation --}}
                        <div>
                            <label for="rating" class="block text-gray-200 mb-1">
                                <i class="bx bxs-star mr-1 text-indigo-400"></i>
                                Évaluation
                            </label>
                            <input type="text"
                                   id="rating"
                                   name="rating"
                                   value="{{ old('rating', $film['rating']) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Spécial Features --}}
                        <div class="md:col-span-2">
                            <label for="special_features" class="block text-gray-200 mb-1">
                                <i class="bx bx-purchase-tag mr-1 text-indigo-400"></i>
                                Caractéristiques spéciales (séparées par des virgules)
                            </label>
                            <input type="text"
                                   id="special_features"
                                   name="special_features"
                                   value="{{ old('special_features', $film['specialFeatures']) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    {{-- Description (plein width) --}}
                    <div>
                        <label for="description" class="block text-gray-200 mb-1">
                            <i class="bx bx-comment-detail mr-1 text-indigo-400"></i>
                            Description
                        </label>
                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500"
                                  required>{{ old('description', $film['description']) }}</textarea>
                    </div>

                    {{-- Bouton de mise à jour --}}
                    <div>
                        <button type="submit"
                                class="w-full flex justify-center items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-lg transition">
                            <i class="bx bx-save text-xl"></i>
                            Mettre à jour
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- SweetAlert2 --}}
    @once
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endonce

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: "{{ session('success') }}",
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "{{ session('error') }}",
            });
        </script>
    @endif

</x-app-layout>

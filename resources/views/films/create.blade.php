<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl text-center text-white uppercase tracking-wide">
            {{ __('Ajouter un film') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-2xl w-full bg-gray-800 bg-opacity-60 backdrop-blur-md rounded-2xl shadow-2xl p-8">

            {{-- Alerts --}}
            @if(session('success'))
                <div class="mb-4 px-4 py-2 bg-green-700 bg-opacity-50 text-green-200 rounded-lg border border-green-600">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 px-4 py-2 bg-red-700 bg-opacity-50 text-red-200 rounded-lg border border-red-600">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 px-4 py-2 bg-red-700 bg-opacity-30 text-red-200 rounded-lg border border-red-600">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('films.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Titre --}}
                <div>
                    <label for="title" class="block text-gray-200 mb-1">
                        <i class="bx bx-heading mr-1 text-indigo-400"></i>
                        Titre
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500"
                           required>
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-gray-200 mb-1">
                        <i class="bx bx-comment-detail mr-1 text-indigo-400"></i>
                        Description
                    </label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500"
                              required>{{ old('description') }}</textarea>
                </div>

                {{-- Ligne 1 : année & langues --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="release_year" class="block text-gray-200 mb-1">
                            <i class="bx bx-calendar-alt mr-1 text-indigo-400"></i>
                            Année de sortie
                        </label>
                        <input type="number" name="release_year" id="release_year" value="{{ old('release_year') }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500"
                               required>
                    </div>
                    <div>
                        <label for="language_id" class="block text-gray-200 mb-1">
                            <i class="bx bx-globe mr-1 text-indigo-400"></i>
                            ID Langue
                        </label>
                        <input type="number" name="language_id" id="language_id" value="{{ old('language_id') }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500"
                               required>
                    </div>
                    <div>
                        <label for="original_language_id" class="block text-gray-200 mb-1">
                            <i class="bx bx-world mr-1 text-indigo-400"></i>
                            Langue d’origine
                        </label>
                        <input type="number" name="original_language_id" id="original_language_id" value="{{ old('original_language_id') }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                {{-- Ligne 2 : locations & tarifs --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="rental_duration" class="block text-gray-200 mb-1">
                            <i class="bx bx-timer mr-1 text-indigo-400"></i>
                            Durée location (j)
                        </label>
                        <input type="number" name="rental_duration" id="rental_duration" value="{{ old('rental_duration', 3) }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="rental_rate" class="block text-gray-200 mb-1">
                            <i class="bx bx-euro mr-1 text-indigo-400"></i>
                            Tarif location (€)
                        </label>
                        <input type="number" name="rental_rate" id="rental_rate" step="0.01" value="{{ old('rental_rate') }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                {{-- Ligne 3 : durée & remplacement --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="length" class="block text-gray-200 mb-1">
                            <i class="bx bx-time-five mr-1 text-indigo-400"></i>
                            Longueur (min)
                        </label>
                        <input type="number" name="length" id="length" value="{{ old('length') }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="replacement_cost" class="block text-gray-200 mb-1">
                            <i class="bx bx-money mr-1 text-indigo-400"></i>
                            Coût remplacement (€)
                        </label>
                        <input type="number" name="replacement_cost" id="replacement_cost" step="0.01" value="{{ old('replacement_cost') }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                {{-- Ligne 4 : évaluation & fonctionnalités --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="rating" class="block text-gray-200 mb-1">
                            <i class="bx bxs-star mr-1 text-indigo-400"></i>
                            Évaluation
                        </label>
                        <input type="text" name="rating" id="rating" value="{{ old('rating') }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="special_features" class="block text-gray-200 mb-1">
                            <i class="bx bx-purchase-tag mr-1 text-indigo-400"></i>
                            Caractéristiques spéciales
                        </label>
                        <input type="text" name="special_features" id="special_features" value="{{ old('special_features') }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                {{-- Ligne 5 : réalisateur & mise à jour --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="id_director" class="block text-gray-200 mb-1">
                            <i class="bx bx-user-check mr-1 text-indigo-400"></i>
                            ID Réalisateur
                        </label>
                        <input type="number" name="id_director" id="id_director" value="{{ old('id_director') }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="last_update" class="block text-gray-200 mb-1">
                            <i class="bx bx-time-five mr-1 text-indigo-400"></i>
                            Dernière mise à jour
                        </label>
                        <input type="datetime-local" name="last_update" id="last_update"
                               value="{{ old('last_update', now()->format('Y-m-d\TH:i')) }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-200 focus:ring-2 focus:ring-indigo-500"
                               required>
                    </div>
                </div>

                {{-- Bouton --}}
                <div class="flex justify-center">
                    <button type="submit"
                            class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transform hover:scale-105 transition">
                        <i class="bx bx-plus text-xl"></i>
                        Ajouter le film
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

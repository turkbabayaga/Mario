<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Liste des films') }}
            </h2>

            <!-- Bouton Ajouter DVD placé en haut à droite -->
            <a href="{{ route('films.create') }}"
                class="bg-gradient-to-r from-green-400 to-green-600 text-white py-3 px-6 rounded-full shadow-lg 
                       hover:from-green-500 hover:to-green-700 transform hover:scale-105 transition-all duration-300 ease-in-out">
                <i class="fas fa-plus-circle mr-2"></i> Ajouter DVD
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Conteneur des films -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <!-- Titre principal -->
                    <h1 class="text-3xl font-bold mb-12 text-[#ff2d20] dark:text-[#ff2d20] text-center">
                        {{ __("Voici la liste des films disponibles.") }}
                    </h1>

                    <!-- Formulaire de recherche -->
                    <form method="GET" action="{{ route('films.index') }}" class="mb-8">
                        <div class="flex items-center gap-4">
                            <!-- Champ de recherche -->
                            <div class="flex-1">
                                <label for="search" class="text-gray-700 dark:text-gray-300 font-medium">Titre du film</label>
                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    placeholder="Rechercher un film..."
                                    value="{{ request('search') }}"
                                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            </div>

                            <!-- Bouton de recherche -->
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-500 dark:bg-blue-700 dark:hover:bg-blue-600">
                                Rechercher
                            </button>
                        </div>
                    </form>

                    <!-- Liste des films -->
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left bg-gray-200 dark:bg-gray-700">Titre</th>
                                <th class="px-4 py-2 text-left bg-gray-200 dark:bg-gray-700">Langue</th>
                                <th class="px-4 py-2 text-left bg-gray-200 dark:bg-gray-700">Description</th>
                                <th class="px-4 py-2 text-left bg-gray-200 dark:bg-gray-700">Année de sortie</th>
                                <th class="px-4 py-2 text-left bg-gray-200 dark:bg-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $response = file_get_contents('http://127.0.0.1:8080/toad/film/all');
                            $films = json_decode($response, true);
                            @endphp
                            @if(isset($films) && is_array($films))
                            @foreach($films as $film)
                            <tr>
                                <td class="p-4">{{ $film['title'] ?? 'Titre non disponible' }}</td>
                                <td class="p-4">{{ $film['languageId'] ?? 'Langue non spécifiée' }}</td>
                                <td class="p-4">{{ $film['description'] ?? 'Description non disponible' }}</td>
                                <td class="p-4">{{ $film['releaseYear'] ?? 'Année non spécifiée' }}</td>
                                <td class="p-4">
                                    <a href="{{ route('films.show', $film['filmId']) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-500 dark:bg-blue-700 dark:hover:bg-blue-600">
                                        Détails
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center p-4">Aucun film trouvé.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

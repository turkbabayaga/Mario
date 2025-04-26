<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center text-xl font-medium text-gray-100">
            Détails du film
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 rounded-lg shadow-lg p-6">

                @if(isset($film) && is_array($film))
                    <!-- Titre du film avec séparateur -->
                    <div class="mb-6">
                        <h1 class="text-2xl text-center font-bold text-white mb-4">
                            {{ $film['title'] ?? 'Titre non disponible' }}
                        </h1>
                        <hr class="border-gray-700">
                    </div>

                    <!-- Badges d'informations clés -->
                    <div class="flex justify-center space-x-4 mb-10">
                        <div class="bg-gray-800 px-8 py-3 rounded text-center">
                            <p class="text-sm text-gray-400">Année</p>
                            <p class="text-xl font-semibold text-white">{{ $film['releaseYear'] ?? '-' }}</p>
                        </div>
                        
                        <div class="bg-gray-800 px-8 py-3 rounded text-center">
                            <p class="text-sm text-gray-400">Classification</p>
                            <p class="text-xl font-semibold text-white">{{ $film['rating'] ?? '-' }}</p>
                        </div>
                        
                        <div class="bg-gray-800 px-8 py-3 rounded text-center">
                            <p class="text-sm text-gray-400">Durée</p>
                            <p class="text-xl font-semibold text-white">{{ $film['length'] ?? '-' }} min</p>
                        </div>
                    </div>

                    <!-- Section Synopsis -->
                    <div class="mb-8 bg-gray-800 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Synopsis
                        </h3>
                        <p class="text-gray-300">
                            {{ $film['description'] ?? 'Aucune description disponible.' }}
                        </p>
                    </div>

                    <!-- Section Détails techniques -->
                    <div class="mb-8 bg-gray-800 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                            </svg>
                            Détails techniques
                        </h3>
                        <div class="space-y-2">
                            <div class="flex justify-between border-b border-gray-700 py-2">
                                <span class="text-gray-400">Langue</span>
                                <span class="text-gray-300">
                                    @php
                                        $languages = [
                                            1 => 'Anglais',
                                            2 => 'Italien',
                                            3 => 'Japonais',
                                            4 => 'Mandarin',
                                            5 => 'Français',
                                            6 => 'Allemand',
                                            7 => 'Espagnol'
                                        ];
                                    @endphp
                                    {{ $languages[$film['languageId'] ?? 0] ?? 'Langue ' . ($film['languageId'] ?? '-') }}
                                </span>
                            </div>
                            <div class="flex justify-between border-b border-gray-700 py-2">
                                <span class="text-gray-400">Caractéristiques</span>
                                <span class="text-gray-300">{{ $film['specialFeatures'] ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Section Informations de location -->
                    <div class="mb-8 bg-gray-800 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Informations de location
                        </h3>
                        <div class="space-y-2">
                            <div class="flex justify-between border-b border-gray-700 py-2">
                                <span class="text-gray-400">Tarif</span>
                                <span class="text-gray-300">{{ $film['rentalRate'] ?? '-' }} €</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-700 py-2">
                                <span class="text-gray-400">Durée de location</span>
                                <span class="text-gray-300">{{ $film['rentalDuration'] ?? '-' }} jours</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-700 py-2">
                                <span class="text-gray-400">Coût de remplacement</span>
                                <span class="text-gray-300">{{ $film['replacementCost'] ?? '-' }} €</span>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex justify-center space-x-4 mt-8">
                        <a href="{{ route('films.edit', ['filmId' => $film['filmId']]) }}" 
                           class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Modifier
                        </a>

                        <form action="{{ route('films.destroy', ['filmId' => $film['filmId']]) }}" method="POST"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce film ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Supprimer
                            </button>
                        </form>

                        <a href="{{ route('films.index') }}" 
                           class="px-5 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Retour
                        </a>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-center text-xl text-gray-400">Aucun film trouvé.</p>
                        <a href="{{ route('films.index') }}" class="mt-6 px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded">
                            Retour à la liste
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
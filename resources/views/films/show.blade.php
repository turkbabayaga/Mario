<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Détails du film') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg border border-gray-200 dark:border-gray-700 p-8">
                @if(isset($film) && is_array($film)) <!-- Vérifier que $film est bien un tableau -->
                    <!-- Titre du film -->
                    <h1 class="text-4xl font-bold mb-6 text-[#ff2d20] dark:text-[#ff2d20] text-center">
                        {{ $film['title'] ?? 'Titre non disponible' }}
                    </h1>

                    <!-- Affichage des détails du film -->
                    <div class="space-y-8">
                        <!-- Section Langue -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out">
                            <p class="text-xl text-gray-700 dark:text-gray-300 flex items-center">
                                <i class="fas fa-language text-[#ff2d20] mr-3"></i><strong>Langue :</strong>
                                {{ $film['languageId'] ?? 'Langue non spécifiée' }}
                            </p>
                        </div>
                        
                        <!-- Section Description -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out">
                            <p class="text-xl text-gray-700 dark:text-gray-300 flex items-center">
                                <i class="fas fa-align-left text-[#ff2d20] mr-3"></i><strong>Description :</strong>
                                {{ $film['description'] ?? 'Description non disponible' }}
                            </p>
                        </div>

                        <!-- Section Année de sortie -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out">
                            <p class="text-xl text-gray-700 dark:text-gray-300 flex items-center">
                                <i class="fas fa-calendar-alt text-[#ff2d20] mr-3"></i><strong>Année de sortie :</strong>
                                {{ $film['releaseYear'] ?? 'Année non spécifiée' }}
                            </p>
                        </div>

                        <!-- Section Tarif de location -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out">
                            <p class="text-xl text-gray-700 dark:text-gray-300 flex items-center">
                                <i class="fas fa-dollar-sign text-[#ff2d20] mr-3"></i><strong>Tarif de location :</strong>
                                {{ $film['rentalRate'] ?? 'Tarif non spécifié' }}
                            </p>
                        </div>

                        <!-- Section Durée de location -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out">
                            <p class="text-xl text-gray-700 dark:text-gray-300 flex items-center">
                                <i class="fas fa-clock text-[#ff2d20] mr-3"></i><strong>Durée location :</strong>
                                {{ $film['rentalDuration'] ?? 'Durée non spécifiée' }} jours
                            </p>
                        </div>

                        <!-- Section Note -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out">
                            <p class="text-xl text-gray-700 dark:text-gray-300 flex items-center">
                                <i class="fas fa-star text-[#ff2d20] mr-3"></i><strong>Note :</strong>
                                {{ $film['rating'] ?? 'Note non spécifiée' }}
                            </p>
                        </div>

                        <!-- Section Caractéristiques -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 ease-in-out">
                            <p class="text-xl text-gray-700 dark:text-gray-300 flex items-center">
                                <i class="fas fa-cogs text-[#ff2d20] mr-3"></i><strong>Caractéristiques :</strong>
                                {{ $film['specialFeatures'] ?? 'Caractéristiques non spécifiées' }}
                            </p>
                        </div>
                    </div>

                    <!-- Section des boutons "Modifier" et "Supprimer" -->
                    <div class="flex justify-end space-x-4 mt-8">
                        <!-- Bouton Modifier -->
                        <a href="{{ route('films.edit', ['filmId' => $film['filmId']]) }}" class="px-6 py-2 bg-blue-600 text-white rounded-full shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
                            Modifier
                        </a>
                        <!-- Bouton Supprimer -->
                        <form action="{{ route('films.destroy', ['filmId' => $film['filmId']]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce film ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-full shadow-md hover:bg-red-700 transition duration-300 ease-in-out">
                                Supprimer
                            </button>
                        </form>
                    </div>
                @else
                    <p class="text-center text-xl text-gray-700 dark:text-gray-300">Aucun film trouvé.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

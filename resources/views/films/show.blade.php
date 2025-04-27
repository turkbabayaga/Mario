<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-center text-gray-200 leading-tight">
            {{ __('Détails du Film') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-lg rounded-lg p-10">

                @if(isset($film) && is_array($film))
                    <!-- Titre du Film -->
                    <h1 class="text-3xl font-bold text-white text-center mb-10 tracking-wide uppercase">
                        {{ $film['title'] ?? 'Titre non disponible' }}
                    </h1>

                    <!-- Informations principales sous forme de cartes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                            $details = [
                                'Langue' => $film['languageId'] ?? 'Non spécifiée',
                                'Année de sortie' => $film['releaseYear'] ?? 'Non spécifiée',
                                'Durée' => ($film['length'] ?? 'Non spécifiée') . ' minutes',
                                'Note' => $film['rating'] ?? 'Non spécifiée',
                                'Tarif de location' => ($film['rentalRate'] ?? 'Non spécifié') . ' €',
                                'Durée location' => ($film['rentalDuration'] ?? 'Non spécifiée') . ' jours',
                                'Coût de remplacement' => ($film['replacementCost'] ?? 'Non spécifié') . ' €',
                                'Caractéristiques' => $film['specialFeatures'] ?? 'Non spécifiées',
                            ];
                        @endphp

                        @foreach($details as $label => $value)
                            <div class="bg-gray-700 p-6 rounded-lg shadow hover:shadow-xl transition">
                                <p class="text-lg text-gray-300"><span class="font-bold">{{ $label }} :</span> {{ $value }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Description spéciale en bas -->
                    <div class="mt-10">
                        <div class="bg-gray-700 p-6 rounded-lg shadow hover:shadow-xl transition">
                            <h3 class="text-2xl font-bold text-white mb-4">Description :</h3>
                            <p class="text-gray-300 leading-relaxed">
                                {{ $film['description'] ?? 'Description non disponible' }}
                            </p>
                        </div>
                    </div>

                    <!-- Boutons Modifier / Supprimer / Retour -->
                    <div class="flex flex-wrap justify-center gap-6 mt-10">
                        <a href="{{ route('films.edit', ['filmId' => $film['filmId']]) }}"
                           class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md border border-blue-400 transition">
                            Modifier
                        </a>

                        <form action="{{ route('films.destroy', ['filmId' => $film['filmId']]) }}" method="POST"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce film ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-md border border-red-400 transition">
                                Supprimer
                            </button>
                        </form>

                        <a href="{{ route('films.index') }}"
                           class="px-8 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-md border border-gray-400 transition">
                            Retour
                        </a>
                    </div>

                @else
                    <p class="text-center text-gray-300 text-lg">Aucun film trouvé.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="relative h-screen bg-gradient-to-b from-gray-900 to-gray-800 overflow-hidden">
        <!-- En-tête avec titre du film -->
        <div class="pt-16 pb-8 px-4">
            <h1 class="text-4xl font-bold tracking-tight text-center text-white">
                {{ $film['title'] ?? 'Détails du film' }}
            </h1>
        </div>

        <!-- Container principal -->
        <div class="max-w-5xl mx-auto px-4">
            <!-- Badges d'informations clés avec style moderne -->
            <div class="flex justify-center mb-12 gap-8">
                @if(isset($film['releaseYear']))
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-blue-500 flex items-center justify-center mb-2">
                        <span class="text-xl font-bold text-white">{{ $film['releaseYear'] }}</span>
                    </div>
                    <span class="text-gray-300 text-sm">Année</span>
                </div>
                @endif

                @if(isset($film['rating']))
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-purple-500 flex items-center justify-center mb-2">
                        <span class="text-xl font-bold text-white">{{ $film['rating'] }}</span>
                    </div>
                    <span class="text-gray-300 text-sm">Rating</span>
                </div>
                @endif

                @if(isset($film['length']))
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-green-500 flex items-center justify-center mb-2">
                        <span class="text-xl font-bold text-white">{{ $film['length'] }}</span>
                    </div>
                    <span class="text-gray-300 text-sm">Minutes</span>
                </div>
                @endif

                @if(isset($film['languageId']))
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-amber-500 flex items-center justify-center mb-2">
                        @php
                            $languages = [
                                1 => 'EN',
                                2 => 'IT',
                                3 => 'JP',
                                4 => 'CN',
                                5 => 'FR',
                                6 => 'DE',
                                7 => 'ES'
                            ];
                        @endphp
                        <span class="text-xl font-bold text-white">{{ $languages[$film['languageId'] ?? 0] ?? '' }}</span>
                    </div>
                    <span class="text-gray-300 text-sm">Langue</span>
                </div>
                @endif
            </div>

            <!-- Section contenu principal -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Colonne gauche - Synopsis -->
                <div class="md:col-span-2 bg-gray-800 bg-opacity-50 backdrop-blur-md rounded-xl p-6 shadow-lg">
                    <h2 class="text-2xl font-semibold text-white mb-4 border-b border-gray-700 pb-2">Synopsis</h2>
                    <p class="text-gray-300 leading-relaxed">
                        {{ $film['description'] ?? 'Aucune description disponible pour ce film.' }}
                    </p>
                    
                    @if(isset($film['specialFeatures']) && $film['specialFeatures'])
                    <div class="mt-6">
                        <h3 class="text-xl font-medium text-white mb-2">Caractéristiques spéciales</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $film['specialFeatures']) as $feature)
                                <span class="px-3 py-1 bg-gray-700 text-gray-300 rounded-full text-sm">{{ trim($feature) }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Colonne droite - Informations de location -->
                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-md rounded-xl p-6 shadow-lg h-fit">
                    <h2 class="text-2xl font-semibold text-white mb-4 border-b border-gray-700 pb-2">Location</h2>
                    
                    <div class="space-y-4">
                        <!-- Tarif -->
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Tarif</span>
                            <span class="text-2xl font-bold text-white">{{ $film['rentalRate'] ?? '-' }} €</span>
                        </div>
                        
                        <!-- Durée -->
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Durée</span>
                            <span class="text-white">{{ $film['rentalDuration'] ?? '-' }} jours</span>
                        </div>
                        
                        <!-- Coût de remplacement -->
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Remplacement</span>
                            <span class="text-white">{{ $film['replacementCost'] ?? '-' }} €</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-center mt-12 mb-8 gap-4">
                <a href="{{ route('films.edit', ['filmId' => $film['filmId']]) }}" 
                   class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-medium transition-all focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Modifier
                </a>
                
                <form action="{{ route('films.destroy', ['filmId' => $film['filmId']]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-6 py-3 bg-red-600 hover:bg-red-700 rounded-lg text-white font-medium transition-all focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Supprimer
                    </button>
                </form>
                
                <a href="{{ route('films.index') }}" 
                   class="px-6 py-3 bg-gray-600 hover:bg-gray-700 rounded-lg text-white font-medium transition-all focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Retour
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
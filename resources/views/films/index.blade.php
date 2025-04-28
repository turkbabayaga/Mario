<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg shadow-lg">
                <div class="p-6 text-gray-100">

                    <h2 class="text-2xl font-bold mb-6 text-center">Liste des Films</h2>

                    {{-- Messages de succès --}}
                    @if(session('success'))
                    <div class="mb-4 p-4 bg-green-800 text-green-200 rounded shadow-sm border border-green-600 text-center">
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- Messages d'erreur --}}
                    @if(session('error'))
                    <div class="mb-4 p-4 bg-red-800 text-red-200 rounded shadow-sm border border-red-600 text-center">
                        {{ session('error') }}
                    </div>
                    @endif

                    {{-- Tableau des films --}}
                    <div class="flex justify-end mb-6">
                        <a href="{{ route('films.create') }}"
                            class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md shadow transition">
                            ➕ Ajouter un Film
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-gray-800 rounded-lg border border-gray-700 text-sm text-left text-gray-300">
                            <thead class="bg-gray-700 text-xs uppercase text-gray-300">
                                <tr>
                                    <th class="px-6 py-3">Titre</th>
                                    <th class="px-6 py-3">Langue</th>
                                    <th class="px-6 py-3">Description</th>
                                    <th class="px-6 py-3">Année de sortie</th>
                                    <th class="px-6 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($films) && is_array($films) && count($films) > 0)
                                @foreach($films as $film)
                                <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                                    <td class="px-6 py-4">{{ $film['title'] ?? 'Titre non disponible' }}</td>
                                    <td class="px-6 py-4">{{ $film['languageId'] ?? 'Langue non spécifiée' }}</td>
                                    <td class="px-6 py-4">{{ $film['description'] ?? 'Description non disponible' }}</td>
                                    <td class="px-6 py-4">{{ $film['releaseYear'] ?? 'Année non spécifiée' }}</td>
                                    <td class="px-6 py-4 flex justify-center gap-2">

                                        @if(isset($film['filmId']))
                                        <a href="{{ route('films.show', ['filmId' => $film['filmId']]) }}"
                                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md transition">
                                            Voir
                                        </a>

                                        <a href="{{ route('films.edit', ['filmId' => $film['filmId']]) }}"
                                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-md transition">
                                            Modifier
                                        </a>

                                        <form action="{{ route('films.destroy', ['filmId' => $film['filmId']]) }}"
                                            method="POST" onsubmit="return confirm('Supprimer ce film ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-md transition">
                                                Supprimer
                                            </button>
                                        </form>

                                        @else
                                        <span class="text-xs italic text-gray-400">Aucune action</span>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center p-6 text-gray-400">
                                        Aucun film trouvé.
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
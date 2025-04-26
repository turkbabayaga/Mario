<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-2xl font-bold mb-6">Liste des Films</h2>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg">
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
                                @if(isset($films) && is_array($films) && count($films) > 0)
                                    @foreach($films as $film)
                                        <tr class="border-b border-gray-300 dark:border-gray-600">
                                            <td class="px-4 py-2">{{ $film['title'] ?? 'Titre non disponible' }}</td>
                                            <td class="px-4 py-2">{{ $film['languageId'] ?? 'Langue non spécifiée' }}</td>
                                            <td class="px-4 py-2">{{ $film['description'] ?? 'Description non disponible' }}</td>
                                            <td class="px-4 py-2">{{ $film['releaseYear'] ?? 'Année non spécifiée' }}</td>
                                            <td class="px-4 py-2 flex gap-2">
                                                @if(isset($film['filmId']))
                                                    <a href="{{ route('films.show', ['filmId' => $film['filmId']]) }}"
                                                       class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700 transition">
                                                        Voir
                                                    </a>
                                                    <a href="{{ route('films.edit', ['filmId' => $film['filmId']]) }}"
                                                       class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-yellow-500 rounded hover:bg-yellow-600 transition">
                                                        Modifier
                                                    </a>
                                                    <form action="{{ route('films.destroy', ['filmId' => $film['filmId']]) }}" method="POST" onsubmit="return confirm('Supprimer ce film ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700 transition">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-xs text-gray-400 italic">Aucune action</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center p-4 text-gray-500">Aucun film trouvé.</td>
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

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Gestion des Stocks</h1>

                    @if(session('success'))
                        <div class="mb-4 text-green-500">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 text-red-500">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (!empty($stocks) && is_array($stocks))
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-gray-100 dark:bg-gray-700 rounded-lg">
                                <thead class="bg-gray-200 dark:bg-gray-600">
                                    <tr>
                                        <th class="py-3 px-4 text-left">ID Film</th>
                                        <th class="py-3 px-4 text-left">Titre</th>
                                        <th class="py-3 px-4 text-left">Stock Disponible</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stocks as $stock)
                                        <tr class="border-b border-gray-300 dark:border-gray-600">
                                            <td class="py-2 px-4">{{ $stock['filmId'] ?? '-' }}</td>
                                            <td class="py-2 px-4">{{ $stock['title'] ?? 'Titre inconnu' }}</td>
                                            <td class="py-2 px-4">
                                                @if (!empty($stock['availableCopies']) && $stock['availableCopies'] > 0)
                                                    <span class="text-green-500 font-semibold">{{ $stock['availableCopies'] }}</span>
                                                @else
                                                    <span class="text-red-500 font-semibold">Rupture</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-gray-600 dark:text-gray-400">
                            Aucun stock trouvé.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

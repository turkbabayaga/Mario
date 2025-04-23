<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Stocks par Point de Vente</h1>

                    {{-- Message d’erreur de l’API, le cas échéant --}}
                    @if(!empty($error))
                        <div class="mb-4 text-red-500 font-semibold">
                            {{ $error }}
                        </div>
                    @endif

                    {{-- Message de succès/erreur de mise à jour --}}
                    @if(session('success'))
                        <div class="mb-4 text-green-500">{{ session('success') }}</div>
                    @endif
                    @if(session('error') && empty($error))
                        <div class="mb-4 text-red-500">{{ session('error') }}</div>
                    @endif

                    @if(count($stocks))
                        <table class="min-w-full bg-gray-100 dark:bg-gray-700 rounded-lg">
                            <thead class="bg-gray-200 dark:bg-gray-600">
                                <tr>
                                    <th class="py-3 px-4 text-left">Film ID</th>
                                    <th class="py-3 px-4 text-left">Magasin</th>
                                    <th class="py-3 px-4 text-left">Quantité Disponible</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stocks as $stock)
                                    <tr class="border-b border-gray-300 dark:border-gray-600">
                                        <td class="py-2 px-4">{{ $stock['film_id'] }}</td>
                                        <td class="py-2 px-4">Magasin {{ $stock['store_id'] }}</td>
                                        <td class="py-2 px-4 font-bold {{ $stock['quantity'] > 0 ? 'text-green-500' : 'text-red-500' }}">
                                            {{ $stock['quantity'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center text-gray-600 dark:text-gray-400">Aucun stock trouvé.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

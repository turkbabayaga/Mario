<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg shadow-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-2xl font-bold mb-6">Stocks par Point de Vente</h1>

                    {{-- 🔽 Filtre par magasin --}}
                    <form method="GET" class="mb-6 flex items-center gap-4 relative z-10">
                        <label for="store_id" class="text-sm font-semibold">Filtrer par magasin :</label>
                        <div class="relative w-64">
                            <select
                                name="store_id"
                                id="store_id"
                                onchange="this.form.submit()"
                                class="block w-full appearance-none bg-white dark:bg-gray-100 border border-gray-300 text-black text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 p-2.5 pr-10"
                            >
                                <option value="">Tous les magasins</option>
                                @foreach($storeList as $store)
                                    <option value="{{ $store }}" {{ $selectedStoreId == $store ? 'selected' : '' }}>
                                        Magasin {{ $store }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 011.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        @if($selectedStoreId)
                            <a href="{{ route('stocks.index') }}"
                               class="text-sm bg-gray-200 text-black px-3 py-1 rounded hover:bg-gray-300 transition">
                                Réinitialiser
                            </a>
                        @endif
                    </form>

                    {{-- Message d’erreur de l’API --}}
                    @if(!empty($error))
                        <div class="mb-4 text-red-500 font-semibold">
                            {{ $error }}
                        </div>
                    @endif

                    {{-- Messages de succès/erreur --}}
                    @if(session('success'))
                        <div class="mb-4 text-green-500">{{ session('success') }}</div>
                    @endif
                    @if(session('error') && empty($error))
                        <div class="mb-4 text-red-500">{{ session('error') }}</div>
                    @endif

                    @if(count($stocks))
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-200 dark:text-gray-100 border border-gray-700 rounded-lg overflow-hidden shadow-md">
                                <thead class="bg-gray-700 text-xs uppercase text-gray-300">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">🎬 Titre du Film</th>
                                        <th scope="col" class="px-6 py-3">🏪 Magasin</th>
                                        <th scope="col" class="px-6 py-3">📦 Quantité</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stocks as $stock)
                                        <tr class="border-b border-gray-600 hover:bg-gray-700 transition">
                                            <td class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                                {{ $stock['title'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                                    Magasin {{ $stock['store_id'] }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 font-bold">
                                                <span class="{{ $stock['quantity'] > 0 ? 'text-green-400' : 'text-red-400' }}">
                                                    {{ $stock['quantity'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-gray-600 dark:text-gray-400">Aucun stock trouvé.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

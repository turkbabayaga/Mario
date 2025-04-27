<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-100">

                    <h1 class="text-3xl font-bold mb-6 text-center">Stocks par Point de Vente</h1>

                    {{-- Filtres --}}
                    <form method="GET" class="flex flex-wrap justify-center gap-4 mb-8">
                        <label for="store_id" class="text-sm font-semibold self-center">Filtrer :</label>
                        <select name="store_id" id="store_id" onchange="this.form.submit()"
                            class="block w-64 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg p-2.5 pr-10 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Tous les magasins</option>
                            @foreach($storeList as $store)
                                <option value="{{ $store }}" {{ $selectedStoreId == $store ? 'selected' : '' }}>
                                    Magasin {{ $store }}
                                </option>
                            @endforeach
                        </select>
                        @if($selectedStoreId)
                            <a href="{{ route('stocks.index') }}"
                               class="text-sm bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded transition">
                                Réinitialiser
                            </a>
                        @endif
                    </form>

                    {{-- Messages --}}
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-600 text-white rounded text-center">
                            ✅ {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-600 text-white rounded text-center">
                            ❌ {{ session('error') }}
                        </div>
                    @endif

                    {{-- Tableau --}}
                    @if(count($stocks))
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-gray-700 text-white rounded-lg shadow">
                                <thead>
                                    <tr class="bg-gray-600 text-xs uppercase text-gray-300">
                                        <th class="px-6 py-3 text-left">🎬 Titre</th>
                                        <th class="px-6 py-3 text-left">🏪 Magasin</th>
                                        <th class="px-6 py-3 text-center">📦 Quantité</th>
                                        <th class="px-6 py-3 text-center">⚙️ Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stocks as $stock)
                                        <tr class="border-b border-gray-600 hover:bg-gray-600">
                                            <td class="px-6 py-4">{{ $stock['title'] }}</td>
                                            <td class="px-6 py-4">
                                                <span class="bg-indigo-800 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                                    Magasin {{ $stock['store_id'] }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center font-bold {{ $stock['quantity'] > 0 ? 'text-green-400' : 'text-red-400' }}">
                                                {{ $stock['quantity'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <form method="POST" action="{{ route('stocks.change') }}" class="flex justify-center items-center gap-2">
                                                    @csrf
                                                    <input type="hidden" name="film_id" value="{{ $stock['film_id'] }}">
                                                    <input type="hidden" name="store_id" value="{{ $stock['store_id'] }}">

                                                    <input type="number" name="quantity" value="1" min="1"
                                                        class="w-16 text-center bg-gray-600 text-white rounded p-1 border border-gray-500" />

                                                    <button type="submit" name="action" value="add"
                                                            class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded text-xs">
                                                        +
                                                    </button>

                                                    <button type="submit" name="action" value="delete"
                                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs">
                                                        -
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center mt-8 text-gray-400">Aucun stock trouvé.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6 text-white">Gestion des Stocks</h2>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-600 text-white">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-600 text-white">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-gray-800 rounded-lg shadow p-4">
            <table class="w-full table-auto text-white">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="p-2 text-left">ID Film</th>
                        <th class="p-2 text-left">Titre</th>
                        <th class="p-2 text-left">Point de vente</th>
                        <th class="p-2 text-left">Quantité</th>
                        <th class="p-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                        <tr class="{{ $loop->even ? 'bg-gray-700' : 'bg-gray-900' }}">
                            <td class="p-2">{{ $stock['film_id'] }}</td>
                            <td class="p-2">{{ $stock['title'] }}</td>
                            <td class="p-2">Magasin {{ $stock['store_id'] }}</td>
                            <td class="p-2 font-bold {{ $stock['total_stock'] == 0 ? 'text-red-500' : 'text-green-400' }}">
                                {{ $stock['total_stock'] }}
                            </td>
                            <td class="p-2">
                                <a href="{{ route('stocks.edit', $stock['id']) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded shadow">
                                    Modifier
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-gray-800 text-white p-6 rounded shadow-lg">
        <h2 class="text-2xl font-semibold mb-4">Modifier le stock</h2>

        <form action="{{ route('stocks.update', $inventoryId) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="new_stock" class="block font-medium text-sm">Nouvelle quantité</label>
                <input type="number" id="new_stock" name="new_stock" min="0"
                    class="mt-1 block w-full bg-gray-700 border-gray-600 rounded p-2 text-white" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded text-white">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

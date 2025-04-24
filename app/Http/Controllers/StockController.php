<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $storeId = $request->get('store_id');

        // Appel API inventaires
        $inventoryResponse = Http::get(env('API_STOCK_ALL'));
        if (!$inventoryResponse->ok()) {
            return view('stocks.index', [
                'stocks' => [],
                'error' => 'Erreur API stocks (code ' . $inventoryResponse->status() . ')'
            ]);
        }
        $inventories = $inventoryResponse->json();

        // Appel API films
        $filmsResponse = Http::get(env('API_FILMS_ALL'));
        if (!$filmsResponse->ok()) {
            return view('stocks.index', [
                'stocks' => [],
                'error' => 'Erreur API films (code ' . $filmsResponse->status() . ')'
            ]);
        }
        $films = collect($filmsResponse->json())->keyBy('filmId');

        // Construction de la liste des magasins dispo
        $storeList = collect($inventories)
            ->pluck('storeId')
            ->unique()
            ->sort()
            ->values();

        // Groupement et comptage
        $grouped = [];

        foreach ($inventories as $item) {
            $filmId = $item['filmId'] ?? null;
            $store = $item['storeId'] ?? null;

            if ($filmId === null || $store === null) continue;
            if ($storeId && $store != $storeId) continue;

            $key = $filmId . '_' . $store;

            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'film_id' => $filmId,
                    'store_id' => $store,
                    'quantity' => 0,
                    'title' => $films[$filmId]['title'] ?? 'Inconnu',
                ];
            }

            $grouped[$key]['quantity']++;
        }

        $stocks = array_values($grouped);

        // On envoie storeList et selectedStoreId à la vue
        return view('stocks.index', [
            'stocks' => $stocks,
            'error' => null,
            'storeList' => $storeList,
            'selectedStoreId' => $storeId,
        ]);
    }

    public function edit($inventoryId)
    {
        try {
            $response = Http::get(env('API_STOCK_ALL'));
            if ($response->ok()) {
                $stocks = $response->json();
                $stock = collect($stocks)->firstWhere('inventoryId', $inventoryId);

                if (!$stock) {
                    return redirect()->route('stocks.index')->with('error', 'Stock introuvable.');
                }

                return view('stocks.edit', compact('stock'));
            } else {
                return redirect()->route('stocks.index')->with('error', 'Erreur récupération stock.');
            }
        } catch (\Exception $e) {
            return redirect()->route('stocks.index')->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }

    public function update(Request $request, $inventoryId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        try {
            $response = Http::put(env('API_STOCK_UPDATE'), [
                'id' => $inventoryId,
                'quantity' => $request->input('quantity'),
            ]);

            if ($response->successful()) {
                return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }
}

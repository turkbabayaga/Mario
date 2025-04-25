<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $storeId = $request->get('store_id');

        $inventoryResponse = Http::get(env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/stock/all' );
        if (!$inventoryResponse->ok()) {
            return view('stocks.index', [
                'stocks' => [],
                'error' => 'Erreur API stocks (code ' . $inventoryResponse->status() . ')'
            ]);
        }
        $inventories = $inventoryResponse->json();

        $filmsResponse = Http::get(env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/films/all' );
        if (!$filmsResponse->ok()) {
            return view('stocks.index', [
                'stocks' => [],
                'error' => 'Erreur API films (code ' . $filmsResponse->status() . ')'
            ]);
        }
        $films = collect($filmsResponse->json())->keyBy('filmId');

        $storeList = collect($inventories)
            ->pluck('storeId')
            ->unique()
            ->sort()
            ->values();

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

        return view('stocks.index', [
            'stocks' => $stocks,
            'error' => null,
            'storeList' => $storeList,
            'selectedStoreId' => $storeId,
        ]);
    }

    public function change(Request $request)
    {
        $request->validate([
            'film_id' => 'required|integer',
            'store_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'action' => 'required|in:add,delete',
        ]);

        $filmId = $request->input('film_id');
        $storeId = $request->input('store_id');
        $quantity = $request->input('quantity');
        $action = $request->input('action');

        $successCount = 0;

        try {
            for ($i = 0; $i < $quantity; $i++) {
                if ($action === 'add') {
                    $response = Http::post(env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/stock/add' , [
                        'filmId' => $filmId,
                        'storeId' => $storeId
                    ]);
                } else {
                    $all = Http::get(env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/stock/all' )->json();
                    $match = collect($all)
                        ->where('filmId', $filmId)
                        ->where('storeId', $storeId)
                        ->first();

                    if (!$match) break;

                    $response = Http::delete(env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/stock/delete' , [
                        'id' => $match['inventoryId']
                    ]);
                }

                if ($response->successful()) {
                    $successCount++;
                }
            }

            return redirect()->route('stocks.index')->with('success', "$successCount exemplaire(s) ".($action === 'add' ? "ajouté(s)" : "supprimé(s)")." avec succès.");
        } catch (\Exception $e) {
            return redirect()->route('stocks.index')->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    private $stockApi;
    private $filmApi;

    public function __construct()
    {
        $this->stockApi = env('API_STOCK_BASE_URL') . '/inventory';
        $this->filmApi = env('API_FILMS_BASE_URL');
    }

    public function index()
    {
        try {
            $inventories = Http::get(env('API_STOCK_ALL'))->json();
            $films = Http::get($this->filmApi . '/all')->json();

            $filmTitles = collect($films)->pluck('title', 'filmId');

            $grouped = collect($inventories)->groupBy(function ($item) {
                return $item['filmId'] . '-' . $item['storeId'];
            })->map(function ($group) use ($filmTitles) {
                $first = $group->first();
                return [
                    'film_id' => $first['filmId'],
                    'store_id' => $first['storeId'],
                    'title' => $filmTitles[$first['filmId']] ?? 'Titre inconnu',
                    'total_stock' => count($group),
                    'id' => $first['inventoryId'],
                ];
            });

            return view('stocks.index', ['stocks' => $grouped]);
        } catch (\Exception $e) {
            Log::error("Erreur récupération stock : " . $e->getMessage());
            return back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }

    public function edit($inventoryId)
    {
        return view('stocks.edit', compact('inventoryId'));
    }

    public function update(Request $request, $inventoryId)
    {
        $request->validate(['new_stock' => 'required|integer|min:0']);

        try {
            $response = Http::put($this->stockApi . '/update/' . $inventoryId, [
                'quantity' => $request->input('new_stock')
            ]);

            if ($response->ok()) {
                return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès.');
            }

            return back()->with('error', 'Erreur lors de la mise à jour du stock.');
        } catch (\Exception $e) {
            Log::error("Erreur update stock : " . $e->getMessage());
            return back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }
}

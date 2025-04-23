<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $storeId = $request->get('store_id', 1);

        // Appelle le endpoint global
        $response = Http::get(env('API_STOCK_ALL'));

        if (! $response->ok()) {
            $error = 'Erreur API (code ' . $response->status() . ')';
            return view('stocks.index', [
                'stocks' => [],
                'error'  => $error,
            ]);
        }

        $json = $response->json();
        $rawStocks = $json['data'] ?? $json;

        // Filtre localement par store_id
        $filtered = array_filter($rawStocks, function ($item) use ($storeId) {
            return ($item['storeId'] ?? null) == $storeId;
        });

        $stocks = array_map(function ($item) {
            return [
                'film_id'  => $item['filmId'] ?? null,
                'store_id' => $item['storeId'] ?? null,
                'quantity' => $item['quantity'] ?? 0,
            ];
        }, $filtered);

        return view('stocks.index', [
            'stocks' => $stocks,
            'error'  => null,
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

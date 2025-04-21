<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get(env('API_STOCK_ALL'));

            if ($response->ok()) {
                $stocks = $response->json();
                return view('stocks.index', compact('stocks'));
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la récupération des stocks.');
            }
        } catch (\Exception $e) {
            Log::error('Erreur stocks.index : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }

    public function showByStore($storeId)
    {
        try {
            $response = Http::get(env('API_STOCK_BY_STORE'), [
                'storeId' => $storeId
            ]);

            if ($response->ok()) {
                $stocks = $response->json();
                return view('stocks.show', compact('stocks', 'storeId'));
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la récupération des stocks pour ce magasin.');
            }
        } catch (\Exception $e) {
            Log::error('Erreur stocks.showByStore : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }
}

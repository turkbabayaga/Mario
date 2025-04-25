<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FilmController extends Controller
{
    protected $client;
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiBaseUrl = "{ env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/film/base/url' }";
    }

    public function create()
    {
        return view('films.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'release_year' => 'required|integer',
                'language_id' => 'required|integer',
                'original_language_id' => 'nullable|integer',
                'rental_duration' => 'required|integer',
                'rental_rate' => 'required|numeric',
                'length' => 'nullable|integer',
                'replacement_cost' => 'nullable|numeric',
                'rating' => 'nullable|string|max:10',
                'special_features' => 'nullable|string',
            ]);

            $response = $this->client->post("{ env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/film/add' }", [
                'form_params' => [
                    'title' => $validatedData['title'],
                    'description' => $validatedData['description'],
                    'releaseYear' => $validatedData['release_year'],
                    'languageId' => $validatedData['language_id'],
                    'originalLanguageId' => $validatedData['original_language_id'] ?? 0,
                    'rentalDuration' => $validatedData['rental_duration'],
                    'rentalRate' => $validatedData['rental_rate'],
                    'length' => $validatedData['length'] ?? 0,
                    'replacementCost' => $validatedData['replacement_cost'] ?? 0,
                    'rating' => $validatedData['rating'] ?? 'G',
                    'specialFeatures' => $validatedData['special_features'] ?? '',
                    'lastUpdate' => now()->format('Y-m-d H:i:s'),
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                return redirect()->route('films.index')->with('success', 'Film ajouté avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de l\'ajout du film.');
            }
        } catch (\Exception $e) {
            Log::error("Erreur films.store : " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        $films = [];
        $search = $request->input('search');

        try {
            $response = $this->client->get("{ env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/film/all' }");

            if ($response->getStatusCode() == 200) {
                $films = json_decode($response->getBody()->getContents(), true);
                if ($search) {
                    $films = array_filter($films, fn($film) => stripos($film['title'], $search) !== false);
                }
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la récupération des films.');
            }
        } catch (\Exception $e) {
            Log::error('Erreur films.index : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur appel API : ' . $e->getMessage());
        }

        return view('films.index', compact('films'));
    }

    public function show($filmId)
    {
        try {
            $response = $this->client->get("{ env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/film/get/by/id' }", [
                'query' => ['id' => $filmId]
            ]);

            if ($response->getStatusCode() == 200) {
                $film = json_decode($response->getBody()->getContents(), true);
                return view('films.show', compact('film'));
            } else {
                return redirect()->back()->with('error', 'Film non trouvé.');
            }
        } catch (\Exception $e) {
            Log::error("Erreur films.show : " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }

    public function edit($filmId)
    {
        try {
            $response = $this->client->get("{ env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/film/get/by/id' }", [
                'query' => ['id' => $filmId]
            ]);

            if ($response->getStatusCode() == 200) {
                $film = json_decode($response->getBody()->getContents(), true);
                return view('films.edit', compact('film'));
            } else {
                return redirect()->back()->with('error', 'Film non trouvé.');
            }
        } catch (\Exception $e) {
            Log::error("Erreur films.edit : " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }

    public function update(Request $request, $filmId)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'release_year' => 'required|integer',
                'language_id' => 'required|integer',
                'original_language_id' => 'nullable|integer',
                'rental_duration' => 'required|integer',
                'rental_rate' => 'required|numeric',
                'length' => 'nullable|integer',
                'replacement_cost' => 'nullable|numeric',
                'rating' => 'nullable|string|max:10',
                'special_features' => 'nullable|string',
            ]);

            $response = $this->client->put("{ env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/film/update' }" . '/' . $filmId, [
                'form_params' => [
                    'title' => $validatedData['title'],
                    'description' => $validatedData['description'],
                    'releaseYear' => $validatedData['release_year'],
                    'languageId' => $validatedData['language_id'],
                    'originalLanguageId' => $validatedData['original_language_id'] ?? 0,
                    'rentalDuration' => $validatedData['rental_duration'],
                    'rentalRate' => $validatedData['rental_rate'],
                    'length' => $validatedData['length'] ?? 0,
                    'replacementCost' => $validatedData['replacement_cost'] ?? 0,
                    'rating' => $validatedData['rating'] ?? 'G',
                    'specialFeatures' => $validatedData['special_features'] ?? '',
                    'lastUpdate' => now()->format('Y-m-d H:i:s'),
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                return redirect()->route('films.index')->with('success', 'Film mis à jour avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la mise à jour du film.');
            }
        } catch (\Exception $e) {
            Log::error("Erreur films.update : " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }

    public function destroy($filmId)
    {
        try {
            $response = $this->client->delete("{ env('TOAD_SERVER') . ':' . env('TOAD_PORT') . '/toad/film/delete' }" . '/' . $filmId);

            if ($response->getStatusCode() === 200) {
                return redirect()->route('films.index')->with('success', 'Film supprimé avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la suppression du film.');
            }
        } catch (\Exception $e) {
            Log::error("Erreur films.destroy : " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }
}

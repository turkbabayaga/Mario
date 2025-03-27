<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;

class FilmController extends Controller
{
    protected $client;
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiBaseUrl = env('API_FILMS_BASE_URL');
    }

    // Formulaire de création
    public function create()
    {
        return view('films.create');
    }

    // Création d'un film
    public function store(Request $request)
    {
        try {
            // Validation des données
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
                'last_update' => 'required|date'
            ]);

            // Reformater la date au format attendu par l’API
            $validatedData['last_update'] = \Carbon\Carbon::parse($validatedData['last_update'])->format('Y-m-d H:i:s');

            // Appel à l’API Java
            $response = $this->client->post("{$this->apiBaseUrl}/add", [
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
                    'lastUpdate' => $validatedData['last_update']
                    // 'idDirector' => $validatedData['id_director'] ?? null // À activer si besoin plus tard
                ]
            ]);

            Log::info("Réponse API (Création Film) : " . $response->getBody()->getContents());

            if ($response->getStatusCode() === 200) {
                return redirect()->route('films.index')->with('success', 'Film ajouté avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de l\'ajout du film.');
            }
        } catch (\Exception $e) {
            Log::error("Erreur création film : " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }


    // Liste des films
    public function index(Request $request)
    {
        $films = [];
        $search = $request->input('search');

        try {
            $response = $this->client->get("{$this->apiBaseUrl}/all");

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

    // Affichage des détails
    public function show($filmId)
    {
        try {
            $response = $this->client->get("{$this->apiBaseUrl}/getById", [
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

    // Formulaire de modification
    public function edit($filmId)
    {
        try {
            $response = $this->client->get("{$this->apiBaseUrl}/getById", [
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

    // Mise à jour
    public function update(Request $request, $filmId)
    {
        try {
            $response = $this->client->put("{$this->apiBaseUrl}/update/{$filmId}", [
                'form_params' => $request->all()
            ]);

            if ($response->getStatusCode() === 200) {
                return redirect()->route('films.edit', $filmId)->with('success', 'Film mis à jour avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la mise à jour du film.');
            }
        } catch (\Exception $e) {
            Log::error("Erreur films.update : " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }

    // Suppression
    public function delete($filmId)
    {
        try {
            $response = $this->client->delete("{$this->apiBaseUrl}/delete/{$filmId}");

            if ($response->getStatusCode() === 200) {
                return redirect()->route('films.index')->with('success', 'Film supprimé avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la suppression.');
            }
        } catch (\Exception $e) {
            Log::error("Erreur films.delete : " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }
}

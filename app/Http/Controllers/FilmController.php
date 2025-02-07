<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FilmController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(); // Client HTTP pour appeler l'API
    }

    // Liste des films avec option de recherche
    public function index(Request $request)
    {
        $films = [];
        $search = $request->input('search');

        try {
            $response = $this->client->get('http://127.0.0.1:8080/toad/film/all');

            if ($response->getStatusCode() == 200) {
                $films = json_decode($response->getBody()->getContents(), true);
                if ($search) {
                    $films = array_filter($films, function ($film) use ($search) {
                        return stripos($film['title'], $search) !== false;
                    });
                }
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la récupération des films.');
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des films : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur appel API: ' . $e->getMessage());
        }

        return view('films.index', compact('films'));
    }

    // Afficher les détails d'un film
    public function show($filmId)
    {
        try {
            $response = $this->client->get('http://localhost:8080/toad/film/getById', [
                'query' => ['id' => $filmId]
            ]);

            if ($response->getStatusCode() == 200) {
                $film = json_decode($response->getBody()->getContents(), true);
                Log::info('Film data:', $film); // Log pour la structure de la réponse

                return view('films.show', compact('film'));
            } else {
                return redirect()->back()->with('error', 'Film non trouvé.');
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'appel API : ' . $e->getMessage());
            return redirect()->back()->with('error', ' Erreur appel API : ' . $e->getMessage());
        }
    }

    // Formulaire d'édition d'un film
    public function edit($filmId)
    {
        try {
            $response = $this->client->get('http://localhost:8080/toad/film/getById', [
                'query' => ['id' => $filmId]
            ]);

            if ($response->getStatusCode() == 200) {
                $film = json_decode($response->getBody()->getContents(), true);
                return view('films.edit', compact('film'));
            } else {
                return redirect()->back()->with('error', 'Film non trouvé.');
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'appel API : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur appel API : ' . $e->getMessage());
        }
    }

    // Mise à jour d'un film
    public function update(Request $request, $filmId)
    {
        try {
            // Appel API pour mettre à jour le film
            $response = $this->client->put('http://localhost:8080/toad/film/update', [
                'json' => $request->all()
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('films.edit', $filmId)->with('success', 'Film mis à jour avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la mise à jour du film.');
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur appel API : ' . $e->getMessage());
        }
    }

    // Suppression d'un film
    public function delete($filmId)
    {
        try {
            $response = $this->client->delete('http://localhost:8080/toad/film/delete', [
                'form_params' => ['id' => $filmId]
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('films.index')->with('success', 'Film supprimé avec succès.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de la suppression du film.');
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur appel API : ' . $e->getMessage());
        }
    }
    public function create()
    {
        // Retourner la vue avec le formulaire pour ajouter un film
        return view('films.create');
    }

}

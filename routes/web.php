<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('welcome');
});

// Route pour le dashboard (utilisateur authentifié)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Groupes de routes nécessitant une authentification
Route::middleware('auth')->group(function () {
    // Routes liées au profil de l'utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route de déconnexion
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Routes liées aux films
    Route::get('/films', [FilmController::class, 'index'])->name('films.index'); // Liste des films
    Route::get('/films/create', [FilmController::class, 'create'])->name('films.create'); // Formulaire d'ajout
    Route::post('/films', [FilmController::class, 'store'])->name('films.store'); // Traitement du formulaire d'ajout
    Route::get('/films/{filmId}', [FilmController::class, 'show'])->name('films.show'); // Détails d'un film
    Route::get('/films/{filmId}/edit', [FilmController::class, 'edit'])->name('films.edit'); // Formulaire de modification
    Route::put('/films/{filmId}', [FilmController::class, 'update'])->name('films.update'); // Traitement de la modification
    Route::delete('/films/{filmId}', [FilmController::class, 'destroy'])->name('films.destroy'); // Suppression d'un film
});

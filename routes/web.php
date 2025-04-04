<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\FilmController;
use App\Http\Middleware\IsStaffAuthenticated;

Route::get('/', function () {
    return view('welcome');
});

// Connexion via API
Route::get('/login', [AuthApiController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthApiController::class, 'login'])->name('login.api');
Route::post('/logout', [AuthApiController::class, 'logout'])->name('logout');

// Routes protégées par session staff_id
Route::middleware(IsStaffAuthenticated::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/films', [FilmController::class, 'index'])->name('films.index');
    Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
    Route::post('/films', [FilmController::class, 'store'])->name('films.store');
    Route::get('/films/{filmId}', [FilmController::class, 'show'])->name('films.show');
    Route::get('/films/{filmId}/edit', [FilmController::class, 'edit'])->name('films.edit');
    Route::put('/films/{filmId}', [FilmController::class, 'update'])->name('films.update');
    Route::delete('/films/{filmId}', [FilmController::class, 'destroy'])->name('films.destroy');
});

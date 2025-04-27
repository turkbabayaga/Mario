<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\StockController;

// Page de connexion
Route::get('/login', [AuthApiController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthApiController::class, 'login'])->name('login.api');
Route::post('/logout', [AuthApiController::class, 'logout'])->name('logout');

// Zone protégée (connexion nécessaire)
Route::middleware(['web', \App\Http\Middleware\IsStaffAuthenticated::class])->group(function () {

    Route::get('/', function () {
        return redirect()->route('films.index');
    });

    Route::get('/dashboard', function () {
        return redirect()->route('films.index');
    })->name('dashboard');

    // Films
    Route::prefix('films')->name('films.')->group(function () {
        Route::get('/', [FilmController::class, 'index'])->name('index');
        Route::get('/create', [FilmController::class, 'create'])->name('create');
        Route::post('/', [FilmController::class, 'store'])->name('store');
        Route::get('/{filmId}', [FilmController::class, 'show'])->name('show');
        Route::get('/{filmId}/edit', [FilmController::class, 'edit'])->name('edit');
        Route::put('/{filmId}', [FilmController::class, 'update'])->name('update');
        Route::delete('/{filmId}', [FilmController::class, 'destroy'])->name('destroy');
    });

    // Stocks
    Route::prefix('stocks')->name('stocks.')->group(function () {
        Route::get('/', [StockController::class, 'index'])->name('index');
        Route::post('/change', [StockController::class, 'change'])->name('change');
    });
});


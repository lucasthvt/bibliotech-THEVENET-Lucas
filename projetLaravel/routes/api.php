<?php

use App\Http\Controllers\Api\JetonController;
use App\Http\Controllers\Api\LivreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Livres (public)
Route::get('/livres', [LivreController::class, 'index'])->name('api.livres.index');
Route::get('/livres/{livre}', [LivreController::class, 'show'])->name('api.livres.show');

// Jetons
Route::post('/jetons', [JetonController::class, 'store'])
    ->middleware('throttle:5,1')->name('api.jetons.store');

// Livres (créer, protégé)
Route::post('/livres', [LivreController::class, 'store'])
    ->middleware(['auth:sanctum', 'role:bibliothecaire,admin'])->name('api.livres.store');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

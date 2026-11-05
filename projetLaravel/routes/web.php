<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuteurController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Gestion;
use App\Http\Controllers\LivreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes web de BiblioTech
|--------------------------------------------------------------------------
| Chaque ligne associe une URL (et un verbe HTTP) à une action.
| ->name('…') donne un nom à la route : dans les vues on écrit
| route('livres.index') plutôt que '/livres' — si l'URL change, rien ne casse.
*/

// Accueil
Route::get('/', [AccueilController::class, 'index'])->name('home');

// Page statique : pas besoin de contrôleur
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Catalogue public
Route::get('/livres', [LivreController::class, 'index'])->name('livres.index');
Route::get('/livre/{id}', [LivreController::class, 'show'])->whereNumber('id')->name('livres.show');
Route::get('/recherche', [LivreController::class, 'search'])->name('livres.search');

// Catégories
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategorieController::class, 'show'])->name('categories.show');

// Auteurs
Route::get('/auteurs/{auteur}', [AuteurController::class, 'show'])->name('auteurs.show');

// Démonstration : paramètre optionnel dans l'URL (séance 1)
Route::get('/demo/hello/{nom?}', function (string $nom = 'Étudiant') {
    return view('demo.hello', ['nom' => $nom]);
})->name('demo.hello');

// Espace de gestion (séance 3+)
Route::prefix('gestion')->name('gestion.')->group(function () {
    Route::resource('livres', Gestion\LivreController::class);
    Route::resource('categories', Gestion\CategorieController::class)
        ->except('show')
        ->parameters(['categories' => 'categorie']);
});

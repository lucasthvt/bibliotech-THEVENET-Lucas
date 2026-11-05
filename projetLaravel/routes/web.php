<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuteurController;
use App\Http\Controllers\Auth\ConnexionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\Gestion;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\MesEmpruntsController;
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

// Authentification
Route::get('/connexion', [ConnexionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/connexion', [ConnexionController::class, 'store'])->middleware(['guest', 'throttle:5,1'])->name('login.store');
Route::post('/deconnexion', [ConnexionController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('/inscription', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/inscription', [RegisterController::class, 'store'])->middleware('guest')->name('register.store');

// Page statique : pas besoin de contrôleur
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Catalogue public
Route::get('/livres', [LivreController::class, 'index'])->name('livres.index');
Route::get('/livre/{id}', [LivreController::class, 'show'])->whereNumber('id')->name('livres.show');
Route::get('/recherche', [LivreController::class, 'search'])->name('livres.search');
Route::post('/livres/{livre}/emprunter', [EmpruntController::class, 'store'])
    ->middleware('auth')->name('livres.emprunter');

// Catégories
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategorieController::class, 'show'])->name('categories.show');

// Auteurs
Route::get('/auteurs/{auteur}', [AuteurController::class, 'show'])->name('auteurs.show');

// Mes emprunts (utilisateur connecté)
Route::get('/mes-emprunts', [MesEmpruntsController::class, 'index'])
    ->middleware('auth')->name('emprunts.mes');

// Démonstration : paramètre optionnel dans l'URL (séance 1)
Route::get('/demo/hello/{nom?}', function (string $nom = 'Étudiant') {
    return view('demo.hello', ['nom' => $nom]);
})->name('demo.hello');

// Espace de gestion (séance 3+)
Route::prefix('gestion')->name('gestion.')
    ->middleware(['auth', 'role:bibliothecaire,admin'])
    ->group(function () {
        Route::resource('livres', Gestion\LivreController::class);
        Route::resource('categories', Gestion\CategorieController::class)
            ->except('show')
            ->parameters(['categories' => 'categorie']);
        Route::post('/emprunts/{emprunt}/retour', [Gestion\EmpruntController::class, 'retour'])
            ->name('emprunts.retour');
        Route::get('/emprunts/retards', [Gestion\EmpruntController::class, 'retards'])
            ->name('emprunts.retards');
    });

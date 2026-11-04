<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\View\View;

class CategorieController extends Controller
{
    /**
     * Liste des catégories actives avec leur nombre de livres.
     */
    public function index(): View
    {
        $categories = Categorie::actives()
            ->withCount('livres')
            ->orderBy('nom')
            ->get();

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Les livres d'une catégorie.
     */
    public function show(string $slug): View
    {
        $categorie = Categorie::where('slug', $slug)->firstOrFail();

        $livres = $categorie->livres()
            ->orderBy('titre')
            ->get();

        return view('categories.show', [
            'categorie' => $categorie,
            'livres' => $livres,
        ]);
    }
}

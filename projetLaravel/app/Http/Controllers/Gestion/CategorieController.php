<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorieRequest;
use App\Models\Categorie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategorieController extends Controller
{
    public function index(): View
    {
        $categories = Categorie::orderBy('nom')->get();

        return view('gestion.categories.index', ['categories' => $categories]);
    }

    public function create(): View
    {
        return view('gestion.categories.create', ['categorie' => new Categorie()]);
    }

    public function store(CategorieRequest $request): RedirectResponse
    {
        $donnees = $request->validated();
        $donnees['slug'] = Str::slug($donnees['nom']);

        Categorie::create($donnees);

        return redirect()->route('gestion.categories.index')
            ->with('success', "Catégorie créée.");
    }

    public function edit(Categorie $categorie): View
    {
        return view('gestion.categories.edit', ['categorie' => $categorie]);
    }

    public function update(CategorieRequest $request, Categorie $categorie): RedirectResponse
    {
        $donnees = $request->validated();
        $donnees['slug'] = Str::slug($donnees['nom']);

        $categorie->update($donnees);

        return redirect()->route('gestion.categories.index')
            ->with('success', "Catégorie modifiée.");
    }

    public function destroy(Categorie $categorie): RedirectResponse
    {
        if ($categorie->livres()->exists()) {
            return redirect()->route('gestion.categories.index')
                ->with('error', "Impossible de supprimer une catégorie qui contient des livres.");
        }

        $categorie->delete();

        return redirect()->route('gestion.categories.index')
            ->with('success', "Catégorie supprimée.");
    }
}

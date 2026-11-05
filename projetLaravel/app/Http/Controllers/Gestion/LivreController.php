<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Http\Requests\LivreRequest;
use App\Models\Auteur;
use App\Models\Categorie;
use App\Models\Livre;
use Illuminate\View\View;

class LivreController extends Controller
{
    public function index(): View
    {
        $query = Livre::with(['auteur', 'categorie']);

        if (request('categorie')) {
            $query->where('categorie_id', request('categorie'));
        }

        $livres = $query->orderBy('titre')->paginate(15)->withQueryString();

        return view('gestion.livres.index', ['livres' => $livres]);
    }

    public function create(): View
    {
        return view('gestion.livres.create', [
            'livre' => new Livre,
            'auteurs' => Auteur::orderBy('nom')->get(),
            'categories' => Categorie::orderBy('nom')->get(),
        ]);
    }

    public function store(LivreRequest $request)
    {
        $donnees = $request->validated();
        $donnees['disponible'] = $request->boolean('disponible');

        $livre = Livre::create($donnees);

        return redirect()->route('gestion.livres.index')
            ->with('success', "« {$livre->titre} » a été ajouté.");
    }

    public function show(Livre $livre): View
    {
        return view('gestion.livres.show', ['livre' => $livre]);
    }

    public function edit(Livre $livre): View
    {
        return view('gestion.livres.edit', [
            'livre' => $livre,
            'auteurs' => Auteur::orderBy('nom')->get(),
            'categories' => Categorie::orderBy('nom')->get(),
        ]);
    }

    public function update(LivreRequest $request, Livre $livre)
    {
        $donnees = $request->validated();
        $donnees['disponible'] = $request->boolean('disponible');

        $livre->update($donnees);

        return redirect()->route('gestion.livres.index')
            ->with('success', "« {$livre->titre} » a été modifié.");
    }

    public function destroy(Livre $livre)
    {
        $titre = $livre->titre;
        $livre->delete();

        return redirect()->route('gestion.livres.index')
            ->with('success', "« {$titre} » a été supprimé.");
    }
}

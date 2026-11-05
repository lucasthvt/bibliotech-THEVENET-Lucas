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
        $livres = Livre::with(['auteur', 'categorie'])->orderBy('titre')->paginate(15);

        return view('gestion.livres.index', ['livres' => $livres]);
    }

    public function create(): View
    {
        return view('gestion.livres.create', [
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livre $livre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livre $livre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livre $livre)
    {
        //
    }
}

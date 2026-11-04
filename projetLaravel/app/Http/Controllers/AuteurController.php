<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\View\View;

class AuteurController extends Controller
{
    public function show(Auteur $auteur): View
    {
        $livres = $auteur->livres()->with('categorie')->orderBy('titre')->get();

        return view('auteurs.show', [
            'auteur' => $auteur,
            'livres' => $livres,
        ]);
    }
}

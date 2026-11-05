<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Emprunt;
use App\Services\ServiceEmprunt;
use Illuminate\View\View;

class EmpruntController extends Controller
{
    public function __construct(private ServiceEmprunt $serviceEmprunt) {}

    public function retour(Emprunt $emprunt)
    {
        $this->serviceEmprunt->rendre($emprunt);

        return back()->with('success', 'Livre rendu avec succès!');
    }

    public function retards(): View
    {
        $emprunts = Emprunt::enCours()
            ->where('retour_prevu_le', '<', today())
            ->with(['user', 'livre'])
            ->orderBy('retour_prevu_le')
            ->get();

        return view('gestion.emprunts.retards', ['emprunts' => $emprunts]);
    }
}

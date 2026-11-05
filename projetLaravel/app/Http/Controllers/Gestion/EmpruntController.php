<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Emprunt;
use App\Services\ServiceEmprunt;
use Illuminate\View\View;

class EmpruntController extends Controller
{
    public function __construct(private ServiceEmprunt $service) {}

    public function retour(Emprunt $emprunt)
    {
        $this->service->retourner($emprunt);
        return back()->with('success', 'Retour enregistré.');
    }

    public function retards(): View
    {
        $emprunts = Emprunt::with(['user', 'livre'])->enRetard()->get();
        return view('gestion.emprunts.retards', ['emprunts' => $emprunts]);
    }
}

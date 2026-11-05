<?php

namespace App\Http\Controllers;

use App\Exceptions\EmpruntImpossible;
use App\Models\Livre;
use App\Services\ServiceEmprunt;
use Illuminate\Http\Request;

class EmpruntController extends Controller
{
    public function __construct(private ServiceEmprunt $service) {}

    public function store(Request $request, Livre $livre)
    {
        try {
            $this->service->emprunter($request->user(), $livre);
            return back()->with('success', 'Livre emprunté avec succès.');
        } catch (EmpruntImpossible $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

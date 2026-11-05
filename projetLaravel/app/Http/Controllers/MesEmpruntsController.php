<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MesEmpruntsController extends Controller
{
    public function index(): View
    {
        $emprunts = auth()->user()->emprunts()->enCours()->with('livre')->get();

        return view('mes-emprunts', ['emprunts' => $emprunts]);
    }
}

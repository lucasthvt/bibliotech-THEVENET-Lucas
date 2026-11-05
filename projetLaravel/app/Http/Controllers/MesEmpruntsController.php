<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MesEmpruntsController extends Controller
{
    public function index(Request $request): View
    {
        $emprunts = $request->user()->emprunts()->with(['livre', 'livre.auteur'])->enCours()->get();
        return view('emprunts.mes', ['emprunts' => $emprunts]);
    }
}

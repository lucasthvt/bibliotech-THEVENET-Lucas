<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LivreRequest;
use App\Http\Resources\LivreResource;
use App\Models\Livre;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    public function index(Request $request)
    {
        $livres = Livre::with(['auteur', 'categorie'])
            ->when($request->filled('categorie'), fn ($q) =>
                $q->whereHas('categorie', fn ($sq) => $sq->where('slug', $request->categorie))
            )
            ->when($request->filled('disponible'), fn ($q) =>
                $q->where('disponible', (bool) $request->disponible)
            )
            ->orderBy('titre')
            ->paginate(20);

        return LivreResource::collection($livres);
    }

    public function show(Livre $livre)
    {
        return new LivreResource($livre);
    }

    public function store(LivreRequest $request)
    {
        $donnees = $request->validated();
        $donnees['disponible'] = $request->boolean('disponible', true);

        $livre = Livre::create($donnees);

        return (new LivreResource($livre))->response()->setStatusCode(201);
    }
}

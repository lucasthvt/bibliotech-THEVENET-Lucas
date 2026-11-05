<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'auteur' => $this->auteur?->nom_complet,
            'categorie' => $this->categorie?->nom,
            'annee' => $this->annee,
            'isbn' => $this->isbn,
            'disponible' => $this->disponible,
        ];
    }
}

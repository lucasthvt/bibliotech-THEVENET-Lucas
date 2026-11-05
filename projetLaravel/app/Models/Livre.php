<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Livre extends Model
{
    use HasFactory;

    protected $table = 'livres';

    protected $fillable = [
        'titre',
        'auteur_id',
        'annee',
        'nb_pages',
        'isbn',
        'resume',
        'couverture',
        'disponible',
        'categorie_id',
    ];

    protected function casts(): array
    {
        return [
            'disponible' => 'boolean',
            'annee' => 'integer',
            'nb_pages' => 'integer',
        ];
    }

    /**
     * Un livre appartient à une catégorie (N → 1).
     */
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    /**
     * Un livre appartient à un auteur (N → 1).
     */
    public function auteur(): BelongsTo
    {
        return $this->belongsTo(Auteur::class, 'auteur_id');
    }

    /**
     * Les emprunts d'un livre (1 → N).
     */
    public function emprunts()
    {
        return $this->hasMany(Emprunt::class);
    }

    /**
     * Livres que l'on peut emprunter.
     */
    public function scopeDisponible(Builder $query): Builder
    {
        return $query->where('disponible', true);
    }

    /**
     * Recherche par titre ou auteur.
     * Le where(function…) produit : WHERE (titre LIKE ? OR …)
     * Les parenthèses empêchent le OR d'« avaler » les autres conditions.
     */
    public function scopeRecherche(Builder $query, string $terme): Builder
    {
        return $query->where(function (Builder $q) use ($terme) {
            $q->where('titre', 'like', '%'.$terme.'%')
                ->orWhereHas('auteur', function (Builder $subQ) use ($terme) {
                    $subQ->where('nom', 'like', '%'.$terme.'%')
                        ->orWhere('prenom', 'like', '%'.$terme.'%');
                });
        });
    }

    /**
     * Livres d'une catégorie, désignée par son slug.
     */
    public function scopeParCategorieSlug(Builder $query, string $slug): Builder
    {
        return $query->whereHas('categorie', function (Builder $q) use ($slug) {
            $q->where('slug', $slug);
        });
    }
}

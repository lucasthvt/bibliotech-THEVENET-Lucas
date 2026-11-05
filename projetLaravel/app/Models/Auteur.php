<?php

namespace App\Models;

use Database\Factories\AuteurFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auteur extends Model
{
    /** @use HasFactory<AuteurFactory> */
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'nationalite', 'date_naissance', 'biographie'];

    protected function casts(): array
    {
        return ['date_naissance' => 'date'];
    }

    protected function nomComplet(): Attribute
    {
        return Attribute::make(
            get: fn () => trim(($this->prenom ?? '').' '.$this->nom),
        );
    }

    public function livres(): HasMany
    {
        return $this->hasMany(Livre::class, 'auteur_id');
    }
}

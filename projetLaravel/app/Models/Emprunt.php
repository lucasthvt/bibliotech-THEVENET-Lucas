<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Emprunt extends Model
{
    protected $fillable = ['user_id', 'livre_id', 'emprunte_le', 'retour_prevu_le', 'rendu_le'];

    protected $casts = [
        'emprunte_le' => 'date',
        'retour_prevu_le' => 'date',
        'rendu_le' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function livre(): BelongsTo
    {
        return $this->belongsTo(Livre::class);
    }

    public function scopeEnCours(Builder $query): Builder
    {
        return $query->whereNull('rendu_le');
    }

    public function scopeEnRetard(Builder $query): Builder
    {
        return $query->enCours()->where('retour_prevu_le', '<', today());
    }
}

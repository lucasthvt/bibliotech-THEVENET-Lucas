<?php

namespace App\Services;

use App\Exceptions\EmpruntImpossible;
use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ServiceEmprunt
{
    public const DUREE_JOURS = 21;
    public const MAX_EMPRUNTS = 3;

    public function emprunter(User $adherent, Livre $livre): Emprunt
    {
        return DB::transaction(function () use ($adherent, $livre) {
            $livre = $livre->lockForUpdate()->first();

            if (!$livre->disponible) {
                throw new EmpruntImpossible('Ce livre n\'est pas disponible.');
            }

            $empruntsEnCours = $adherent->emprunts()->enCours()->count();
            if ($empruntsEnCours >= self::MAX_EMPRUNTS) {
                throw new EmpruntImpossible('Vous avez atteint le nombre maximum d\'emprunts.');
            }

            $emprunt = $adherent->emprunts()->create([
                'livre_id' => $livre->id,
                'emprunte_le' => today(),
                'retour_prevu_le' => today()->addDays(self::DUREE_JOURS),
            ]);

            $livre->update(['disponible' => false]);

            return $emprunt;
        });
    }

    public function rendre(Emprunt $emprunt): void
    {
        DB::transaction(function () use ($emprunt) {
            $emprunt->update(['rendu_le' => today()]);
            $emprunt->livre->update(['disponible' => true]);
        });
    }
}

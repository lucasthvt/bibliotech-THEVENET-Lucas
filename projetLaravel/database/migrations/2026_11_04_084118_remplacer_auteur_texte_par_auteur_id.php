<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. La nouvelle colonne, vide pour l'instant
        Schema::table('livres', function (Blueprint $table) {
            $table->foreignId('auteur_id')->nullable()->after('titre')
                ->constrained('auteurs')->nullOnDelete();
        });

        // 2. Le transfert : un auteur par nom distinct. On utilise DB et non les modèles :
        //    une migration doit encore fonctionner quand les modèles auront changé.
        $noms = DB::table('livres')->whereNotNull('auteur')->distinct()->pluck('auteur');

        foreach ($noms as $nomComplet) {
            $morceaux = preg_split('/\s+/', trim($nomComplet));
            $nom = array_pop($morceaux);               // dernier mot = nom
            $prenom = implode(' ', $morceaux) ?: null; // le reste = prénom

            $auteurId = DB::table('auteurs')->insertGetId([
                'nom' => $nom, 'prenom' => $prenom, 'created_at' => now(), 'updated_at' => now(),
            ]);

            DB::table('livres')->where('auteur', $nomComplet)->update(['auteur_id' => $auteurId]);
        }

        // 3. L'ancienne colonne. Elle fait partie d'un index : on retire l'index d'abord.
        Schema::table('livres', function (Blueprint $table) {
            $table->dropIndex(['titre', 'auteur']);
            $table->index('titre');
            $table->dropColumn('auteur');
        });
    }

    public function down(): void
    {
        Schema::table('livres', function (Blueprint $table) {
            $table->string('auteur')->nullable()->after('titre');
            $table->index(['titre', 'auteur']);
        });

        // Récupérer les auteurs et mettre à jour la colonne auteur
        $livres = DB::table('livres')->whereNotNull('auteur_id')->get();
        foreach ($livres as $livre) {
            $auteur = DB::table('auteurs')->find($livre->auteur_id);
            if ($auteur) {
                $nomComplet = trim(($auteur->prenom ?? '').' '.$auteur->nom);
                DB::table('livres')->where('id', $livre->id)->update(['auteur' => $nomComplet]);
            }
        }

        Schema::table('livres', function (Blueprint $table) {
            $table->dropForeign(['auteur_id']);
            $table->dropColumn('auteur_id');
        });
    }
};

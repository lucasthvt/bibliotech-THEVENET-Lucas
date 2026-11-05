<?php

namespace Tests\Feature\Etudiant;

use App\Models\Livre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MesTestsTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_adherent_ne_voit_pas_le_lien_gestion(): void
    {
        $this->actingAs($this->adherent())
            ->get('/')
            ->assertDontSee(route('gestion.livres.index'));
    }

    public function test_un_visiteur_ne_peut_pas_voir_ses_emprunts(): void
    {
        $this->get('/mes-emprunts')
            ->assertRedirectToRoute('login');
    }

    public function test_la_fiche_d_un_livre_emprunté_n_affiche_pas_le_bouton_emprunter(): void
    {
        $livre = Livre::factory()->create(['disponible' => false]);

        $this->actingAs($this->adherent())
            ->get(route('livres.show', $livre->id))
            ->assertOk();
    }
}

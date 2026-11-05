<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LivreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'auteur_id' => ['required', 'exists:auteurs,id'],
            'categorie_id' => ['required', 'exists:categories,id'],
            'annee' => ['nullable', 'integer', 'min:1450', 'max:'.now()->year],
            'nb_pages' => ['nullable', 'integer', 'min:1'],
            'isbn' => ['nullable', 'string', 'max:20', 'unique:livres,isbn'],
            'resume' => ['nullable', 'string'],
        ];
    }
}

@extends('layouts.app', ['title' => 'Ajouter un livre'])

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Ajouter un nouveau livre</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('gestion.livres.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="titre" class="form-label">Titre :</label>
                    <input type="text"
                           class="form-control @error('titre') is-invalid @enderror"
                           id="titre"
                           name="titre"
                           value="{{ old('titre') }}"
                           required>
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="auteur_id" class="form-label">Auteur :</label>
                        <select class="form-select @error('auteur_id') is-invalid @enderror"
                                id="auteur_id"
                                name="auteur_id"
                                required>
                            <option value="">-- Sélectionner un auteur --</option>
                            @foreach ($auteurs as $auteur)
                                <option value="{{ $auteur->id }}"
                                        @selected(old('auteur_id') == $auteur->id)>
                                    {{ $auteur->nom_complet }}
                                </option>
                            @endforeach
                        </select>
                        @error('auteur_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="categorie_id" class="form-label">Catégorie :</label>
                        <select class="form-select @error('categorie_id') is-invalid @enderror"
                                id="categorie_id"
                                name="categorie_id"
                                required>
                            <option value="">-- Sélectionner une catégorie --</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}"
                                        @selected(old('categorie_id') == $categorie->id)>
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('categorie_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="annee" class="form-label">Année :</label>
                        <input type="number"
                               class="form-control @error('annee') is-invalid @enderror"
                               id="annee"
                               name="annee"
                               value="{{ old('annee') }}"
                               min="1450"
                               max="{{ now()->year }}">
                        @error('annee')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="nb_pages" class="form-label">Nombre de pages :</label>
                        <input type="number"
                               class="form-control @error('nb_pages') is-invalid @enderror"
                               id="nb_pages"
                               name="nb_pages"
                               value="{{ old('nb_pages') }}"
                               min="1">
                        @error('nb_pages')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="isbn" class="form-label">ISBN :</label>
                        <input type="text"
                               class="form-control @error('isbn') is-invalid @enderror"
                               id="isbn"
                               name="isbn"
                               value="{{ old('isbn') }}"
                               maxlength="20">
                        @error('isbn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="resume" class="form-label">Résumé :</label>
                    <textarea class="form-control @error('resume') is-invalid @enderror"
                              id="resume"
                              name="resume"
                              rows="4">{{ old('resume') }}</textarea>
                    @error('resume')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox"
                           class="form-check-input"
                           id="disponible"
                           name="disponible"
                           value="1"
                           @checked(old('disponible'))>
                    <label for="disponible" class="form-check-label">
                        Disponible
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('gestion.livres.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

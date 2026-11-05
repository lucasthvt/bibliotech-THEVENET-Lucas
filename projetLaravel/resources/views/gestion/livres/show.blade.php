@extends('layouts.app', ['title' => $livre->titre])

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ $livre->titre }}</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('gestion.livres.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="fw-bold">Titre :</label>
                <p>{{ $livre->titre }}</p>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Auteur :</label>
                <p>{{ $livre->auteur?->nom_complet }}</p>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Catégorie :</label>
                <p>{{ $livre->categorie?->nom }}</p>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="fw-bold">Année :</label>
                    <p>{{ $livre->annee ?? 'N/A' }}</p>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="fw-bold">Pages :</label>
                    <p>{{ $livre->nb_pages ?? 'N/A' }}</p>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="fw-bold">ISBN :</label>
                    <p><code>{{ $livre->isbn ?? 'N/A' }}</code></p>
                </div>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Statut :</label>
                <p>
                    @if ($livre->disponible)
                        <span class="badge bg-success">Disponible</span>
                    @else
                        <span class="badge bg-warning text-dark">Emprunté</span>
                    @endif
                </p>
            </div>

            @if ($livre->resume)
                <div class="mb-3">
                    <label class="fw-bold">Résumé :</label>
                    <p>{{ $livre->resume }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

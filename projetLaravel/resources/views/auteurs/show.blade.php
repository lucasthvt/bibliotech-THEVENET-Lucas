@extends('layouts.app', [
    'title' => $auteur->nom_complet,
    'breadcrumbs' => [
        ['label' => 'Catalogue', 'url' => route('livres.index')],
        ['label' => $auteur->nom_complet, 'url' => null],
    ],
])

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-md-8">
            <h1 class="mb-2">{{ $auteur->nom_complet }}</h1>

            @if ($auteur->nationalite)
                <p class="text-muted mb-3">
                    <i class="fas fa-globe"></i> {{ $auteur->nationalite }}
                    @if ($auteur->date_naissance)
                        · Né(e) le {{ $auteur->date_naissance->format('d/m/Y') }}
                    @endif
                </p>
            @endif

            @if ($auteur->biographie)
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="h5 mb-3">Biographie</h2>
                        <p>{!! $auteur->biographie !!}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if ($livres->isNotEmpty())
        <h2 class="h4 mb-4">Ses livres ({{ $livres->count() }})</h2>
        <div class="row">
            @foreach ($livres as $livre)
                <div class="col-md-4 mb-3">
                    <x-livre-card :livre="$livre" />
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted text-center py-5">Aucun livre attribué à cet auteur.</p>
    @endif
</div>
@endsection

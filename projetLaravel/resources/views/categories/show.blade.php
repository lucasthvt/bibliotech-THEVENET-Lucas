@extends('layouts.app', [
    'title' => $categorie->nom,
    'breadcrumbs' => [
        ['label' => 'Catégories', 'url' => route('categories.index')],
        ['label' => $categorie->nom, 'url' => null],
    ],
])

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">{{ $categorie->nom }}</h1>

    <div class="row">
        @forelse($livres as $livre)
            <div class="col-md-6 col-lg-4 mb-4"><x-livre-card :livre="$livre" /></div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Aucun livre dans cette catégorie.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

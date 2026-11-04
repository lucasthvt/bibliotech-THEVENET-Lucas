@extends('layouts.app', [
    'title' => 'Catégories',
    'breadcrumbs' => [['label' => 'Catégories', 'url' => null]],
])

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Catégories</h1>

    <div class="row">
        @forelse($categories as $categorie)
            <div class="col-md-6 col-lg-4 mb-4">
                <a href="{{ route('categories.show', $categorie->slug) }}" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $categorie->nom }}</h5>
                            <p class="card-text text-muted">{{ $categorie->livres_count }} livre(s)</p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Aucune catégorie pour le moment.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

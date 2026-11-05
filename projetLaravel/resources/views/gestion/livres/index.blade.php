@extends('layouts.app', ['title' => 'Gestion des livres'])

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Liste des livres</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('gestion.livres.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter un livre
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($livres as $livre)
                    <tr>
                        <td>
                            <a href="{{ route('gestion.livres.show', $livre) }}">{{ $livre->titre }}</a>
                        </td>
                        <td>{{ $livre->auteur?->nom_complet }}</td>
                        <td>{{ $livre->categorie?->nom }}</td>
                        <td>
                            @if ($livre->disponible)
                                <span class="badge bg-success">Disponible</span>
                            @else
                                <span class="badge bg-warning text-dark">Emprunté</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('gestion.livres.show', $livre) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('gestion.livres.edit', $livre) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('gestion.livres.destroy', $livre) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Retirer ce livre du catalogue ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Aucun livre à afficher
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $livres->links() }}
    </div>
</div>
@endsection

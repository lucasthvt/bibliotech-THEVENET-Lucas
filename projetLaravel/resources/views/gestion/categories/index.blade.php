@extends('layouts.app', ['title' => 'Gestion des catégories'])

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Catégories</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('gestion.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nouvelle catégorie
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Couleur</th>
                    <th>Slug</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->nom }}</td>
                        <td>
                            <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $categorie->couleur }}; border: 1px solid #ddd; border-radius: 3px;"></span>
                            {{ $categorie->couleur }}
                        </td>
                        <td><code>{{ $categorie->slug }}</code></td>
                        <td class="text-end">
                            <a href="{{ route('gestion.categories.edit', $categorie) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('gestion.categories.destroy', $categorie) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Supprimer cette catégorie ?')">
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
                        <td colspan="4" class="text-center text-muted">
                            Aucune catégorie
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

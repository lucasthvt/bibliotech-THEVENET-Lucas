@extends('layouts.app', ['title' => 'Mes emprunts'])

@section('content')
<div class="container mt-4">
    <h1>Mes emprunts en cours</h1>

    @if($emprunts->isEmpty())
        <p class="text-muted">Vous n'avez pas d'emprunt en cours.</p>
    @else
        <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Emprunté le</th>
                        <th>Retour prévu</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emprunts as $emprunt)
                        <tr>
                            <td>{{ $emprunt->livre->titre }}</td>
                            <td>{{ $emprunt->livre->auteur?->nom_complet }}</td>
                            <td>{{ $emprunt->emprunte_le->format('d/m/Y') }}</td>
                            <td>
                                {{ $emprunt->retour_prevu_le->format('d/m/Y') }}
                                @if($emprunt->retour_prevu_le < today())
                                    <span class="badge bg-danger">En retard</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('livres.show', $emprunt->livre->id) }}" class="btn btn-sm btn-info">
                                    Voir
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

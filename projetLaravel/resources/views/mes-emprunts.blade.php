@extends('layouts.app', ['title' => 'Mes emprunts'])

@section('content')
<div class="container mt-4">
    <h1>Mes emprunts en cours</h1>

    @if($emprunts->isEmpty())
        <div class="alert alert-info">Vous n'avez aucun emprunt en cours.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Livre</th>
                        <th>Emprunté le</th>
                        <th>Retour prévu</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emprunts as $emprunt)
                        <tr>
                            <td><a href="{{ route('livres.show', $emprunt->livre->id) }}">{{ $emprunt->livre->titre }}</a></td>
                            <td>{{ $emprunt->emprunte_le->format('d/m/Y') }}</td>
                            <td>{{ $emprunt->retour_prevu_le->format('d/m/Y') }}</td>
                            <td>
                                @if($emprunt->retour_prevu_le->isPast())
                                    <span class="badge bg-danger">En retard</span>
                                @else
                                    <span class="badge bg-success">À temps</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

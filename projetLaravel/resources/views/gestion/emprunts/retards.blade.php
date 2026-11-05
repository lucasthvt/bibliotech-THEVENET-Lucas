@extends('layouts.app', ['title' => 'Emprunts en retard'])

@section('content')
<div class="container mt-4">
    <h1>Emprunts en retard</h1>

    @if($emprunts->isEmpty())
        <p class="text-muted">Aucun emprunt en retard.</p>
    @else
        <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Adhérent</th>
                        <th>Titre</th>
                        <th>Retour prévu</th>
                        <th>Jours de retard</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emprunts as $emprunt)
                        <tr>
                            <td>{{ $emprunt->user->name }}</td>
                            <td>{{ $emprunt->livre->titre }}</td>
                            <td>{{ $emprunt->retour_prevu_le->format('d/m/Y') }}</td>
                            <td>{{ today()->diffInDays($emprunt->retour_prevu_le) }}</td>
                            <td>
                                <form action="{{ route('gestion.emprunts.retour', $emprunt) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Enregistrer retour
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

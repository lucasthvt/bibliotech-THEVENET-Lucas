@extends('layouts.app', ['title' => 'Emprunts en retard'])

@section('content')
<div class="container mt-4">
    <h1>Emprunts en retard</h1>

    @if($emprunts->isEmpty())
        <div class="alert alert-success">Aucun emprunt en retard.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-danger">
                <thead>
                    <tr>
                        <th>Adhérent</th>
                        <th>Livre</th>
                        <th>Retour prévu</th>
                        <th>Jours de retard</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emprunts as $emprunt)
                        <tr>
                            <td>{{ $emprunt->user->name }}</td>
                            <td>{{ $emprunt->livre->titre }}</td>
                            <td>{{ $emprunt->retour_prevu_le->format('d/m/Y') }}</td>
                            <td>{{ $emprunt->retour_prevu_le->diffInDays(today()) }} jour(s)</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

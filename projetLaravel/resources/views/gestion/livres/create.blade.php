@extends('layouts.app', ['title' => 'Ajouter un livre'])

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Ajouter un nouveau livre</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('gestion.livres.store') }}" method="POST">
                @csrf

                @include('gestion.livres._formulaire')

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('gestion.livres.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

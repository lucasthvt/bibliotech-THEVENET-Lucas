@extends('layouts.app', ['title' => 'Nouvelle catégorie'])

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Nouvelle catégorie</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('gestion.categories.store') }}" method="POST">
                @csrf

                @include('gestion.categories._formulaire')

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('gestion.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

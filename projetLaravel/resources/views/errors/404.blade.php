@extends('layouts.app', ['title' => 'Page introuvable'])

@section('content')
<div class="container">
    <div class="text-center py-5">
        <h1 class="display-1 mb-4">404</h1>
        <h2 class="h3 mb-3">Page introuvable</h2>
        <p class="lead mb-4">Désolé, la page que vous cherchez n'existe pas ou a été déplacée.</p>
        <a href="{{ route('livres.index') }}" class="btn btn-primary">
            <i class="fas fa-book"></i> Retour au catalogue
        </a>
    </div>
</div>
@endsection

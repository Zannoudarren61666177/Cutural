@extends('layouts.admin')

@section('title', 'Ajouter un Type de Contenu')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Nouveau Type de Contenu</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.type_contenus.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="libelle_type">Nom</label>
                <input type="text" class="form-control" name="libelle_type" id="libelle_type" value="{{ old('libelle_type') }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
            <a href="{{ route('admin.type_contenus.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form>
    </div>
</div>
@endsection

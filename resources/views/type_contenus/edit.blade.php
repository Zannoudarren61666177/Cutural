@extends('layouts.admin')

@section('title', 'Modifier Type de Contenu')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Modifier : {{ $type_contenus->libelle_type }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.type_contenus.update', $type_contenus->id_type_contenu) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="libelle_type">Nom</label>
                <input type="text" class="form-control" name="libelle_type" id="libelle_type" value="{{ old('libelle_type', $type_contenus->libelle_type) }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
            <a href="{{ route('admin.type_contenus.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form>
    </div>
</div>
@endsection

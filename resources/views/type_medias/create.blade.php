@extends('layouts.admin')

@section('title', 'Ajouter un Type de Média')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nouveau Type de Média</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.type_medias.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom_media">Nom du média</label>
                <input type="text" class="form-control" name="nom_media" id="nom_media" value="{{ old('nom_media') }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
            <a href="{{ route('admin.type_medias.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Modifier Type de Média')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Modifier : {{ $type_media->nom_media }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.type_medias.update', $type_media->id_type_media) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nom_media">Nom du média</label>
                <input type="text" class="form-control" name="nom_media" id="nom_media" value="{{ old('nom_media', $type_media->nom_media) }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
            <a href="{{ route('admin.type_medias.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form>
    </div>
</div>
@endsection

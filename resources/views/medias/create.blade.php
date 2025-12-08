@extends('layouts.admin')

@section('title', 'Ajouter un Média')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nouveau Média</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.medias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="chemin">Fichier</label>
                <input type="file" name="chemin" id="chemin" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="id_type_media">Type de Média</label>
                <select name="id_type_media" id="id_type_media" class="form-control">
                    @foreach($type_medias as $type)
                        <option value="{{ $type->id_type_media }}" {{ old('id_type_media') == $type->id_type_media ? 'selected' : '' }}>
                            {{ $type->nom_media }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_contenu">Contenu associé</label>
                <select name="id_contenu" id="id_contenu" class="form-control">
                    @foreach($contenus as $contenu)
                        <option value="{{ $contenu->id_contenu }}" {{ old('id_contenu') == $contenu->id_contenu ? 'selected' : '' }}>
                            {{ $contenu->titre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
            <a href="{{ route('admin.medias.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form>
    </div>
</div>
@endsection

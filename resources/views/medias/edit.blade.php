@extends('layouts.admin')

@section('title', 'Modifier Média')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Modifier : {{ $media->chemin }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.medias.update', $media->id_media) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- FICHIER --}}
            <div class="form-group">
                <label for="file">Fichier (laisser vide pour garder l'ancien)</label>
                <input type="file" name="file" id="file" class="form-control">

                @if($media->chemin)
                    <small>Fichier actuel : {{ $media->chemin }}</small>
                @endif
            </div>

            {{-- DESCRIPTION --}}
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">
                    {{ old('description', $media->description) }}
                </textarea>
            </div>

            {{-- TYPE MEDIA --}}
            <div class="form-group">
                <label for="type_media_id">Type de Média</label>
                <select name="type_media_id" id="type_media_id" class="form-control">
                    @foreach($type_medias as $type)
                        <option value="{{ $type->id_type_media }}"
                            {{ old('type_media_id', $media->id_type_media) == $type->id_type_media ? 'selected' : '' }}>
                            {{ $type->nom_media }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- CONTENU --}}
            <div class="form-group">
                <label for="contenu_id">Contenu associé</label>
                <select name="contenu_id" id="contenu_id" class="form-control">
                    @foreach($contenus as $contenu)
                        <option value="{{ $contenu->id_contenu }}"
                            {{ old('contenu_id', $media->id_contenu) == $contenu->id_contenu ? 'selected' : '' }}>
                            {{ $contenu->titre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
            <a href="{{ route('admin.medias.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form>
    </div>
</div>
@endsection

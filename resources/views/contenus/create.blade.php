@extends('layouts.admin')

@section('title', 'Ajouter un Contenu')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nouveau Contenu</h3>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.contenus.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
            </div>

            <div class="form-group">
                <label for="texte">Texte</label>
                <textarea name="texte" id="texte" class="form-control" rows="5" required>{{ old('texte') }}</textarea>
            </div>

            <div class="form-group">
                <label for="id_langue">Langue</label>
                <select name="id_langue" id="id_langue" class="form-control" required>
                    <option value="">-- Sélectionner une langue --</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->id_langue }}" {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                            {{ $langue->libelle }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_region">Région</label>
                <select name="id_region" id="id_region" class="form-control" required>
                    <option value="">-- Sélectionner une région --</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id_region }}" {{ old('id_region') == $region->id_region ? 'selected' : '' }}>
                            {{ $region->nom_region }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_type_contenu">Type de Contenu</label>
                <select name="id_type_contenu" id="id_type_contenu" class="form-control" required>
                    <option value="">-- Sélectionner un type --</option>
                    @foreach($type_contenus as $type)
                        <option value="{{ $type->id_type_contenu }}" {{ old('id_type_contenu') == $type->id_type_contenu ? 'selected' : '' }}>
                            {{ $type->libelle_type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="id_auteur">Auteur</label>
                <select name="id_auteur" id="id_auteur" class="form-control" required>
                    <option value="">-- Sélectionner un auteur --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id_user }}" {{ old('id_auteur') == $user->id_user ? 'selected' : '' }}>
                            {{ $user->nom }} {{ $user->prenom ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
            <a href="{{ route('admin.contenus.index') }}" class="btn btn-secondary mt-3">Annuler</a>
        </form>
    </div>
</div>
@endsection

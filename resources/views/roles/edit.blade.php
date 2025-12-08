@extends('layouts.admin')

@section('title', 'Modifier un rôle')

@section('content')

<div class="container-fluid">
    <h1 class="mb-4">Modifier le rôle</h1>

<form action="{{ route('admin.roles.update', $role->id_role) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nom_role" class="form-label">Nom du rôle</label>
        <input type="text" class="form-control" id="nom_role" name="nom_role" value="{{ old('nom_role', $role->nom_role) }}" required>
        @error('nom_role')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-success">Mettre à jour</button>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Annuler</a>
</form>

</div>
@endsection

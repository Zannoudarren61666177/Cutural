@extends('layouts.admin')

@section('title', 'Créer un rôle')

@section('content')

<div class="container-fluid">
    <h1 class="mb-4">Créer un rôle</h1>

<form action="{{ route('admin.roles.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nom_role" class="form-label">Nom du rôle</label>
        <input type="text" class="form-control" id="nom_role" name="nom_role" value="{{ old('nom_role') }}" required>
        @error('nom_role')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-success">Créer</button>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Annuler</a>
</form>

</div>
@endsection

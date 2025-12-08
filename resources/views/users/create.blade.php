@extends('layouts.admin')

@section('title', 'Ajouter un utilisateur')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ajouter un utilisateur</h3>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary float-right">Retour</a>
    </div>

<div class="card-body">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.store') }}" method="POST" autocomplete="off">
    @csrf

    <div class="form-group mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
    </div>

    <div class="form-group mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="off">
    </div>

    <div class="form-group mb-3">
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control" required autocomplete="new-password">
    </div>

    <div class="form-group mb-3">
        <label>Confirmez le mot de passe</label>
        <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
    </div>

    <div class="form-group mb-3">
        <label>Rôle</label>
        <select name="role_id" class="form-control" required>
            <option value="">-- Sélectionnez un rôle --</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id_role }}" {{ old('role_id') == $role->id_role ? 'selected' : '' }}>
                    {{ $role->nom_role }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>

</form>

</div>
</div>
@endsection 
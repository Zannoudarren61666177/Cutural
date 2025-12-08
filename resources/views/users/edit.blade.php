@extends('layouts.admin')

@section('title', 'Modifier un utilisateur')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Modifier un utilisateur</h3>
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

<form action="{{ route('admin.users.update', $user->id_user) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label>Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $user->nom) }}" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Nouveau mot de passe (facultatif)</label>
        <input type="password" name="password" class="form-control">
        <small class="text-muted">Laissez vide pour conserver l’ancien mot de passe.</small>
    </div>

    <div class="form-group mb-3">
        <label>Rôle</label>
        <select name="role_id" class="form-control" required>
            @foreach ($roles as $role)
                <option value="{{ $role->id_role }}"
                    {{ old('role_id', $user->role_id) == $role->id_role ? 'selected' : '' }}>
                    {{ $role->nom_role }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-warning mt-2">Mettre à jour</button>
</form>

</div>

</div>
@endsection

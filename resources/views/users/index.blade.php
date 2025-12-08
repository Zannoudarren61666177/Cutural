@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des Utilisateurs</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-right">Ajouter un utilisateur</a>
    </div>

<div class="card-body">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="usersTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id_user }}</td>
                <td>{{ $user->nom }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->nom_role ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id_user) }}" class="btn btn-sm btn-warning">
                        Modifier
                    </a>

                    <form action="{{ route('admin.users.destroy', $user->id_user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>

@endsection

@extends('layouts.admin')

@section('title', 'Rôles')

@section('content')

<div class="container-fluid">
    <h1 class="mb-4">Liste des rôles</h1>

<a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">Ajouter un rôle</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id_role }}</td>
                    <td>{{ $role->nom_role }}</td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $role->id_role) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('admin.roles.destroy', $role->id_role) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Voulez-vous vraiment supprimer ce rôle ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>
@endsection

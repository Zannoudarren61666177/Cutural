@extends('layouts.admin')

@section('title', 'Types de Contenus')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des Types de Contenus</h3>
        <a href="{{ route('admin.type_contenus.create') }}" class="btn btn-primary float-right">Ajouter un type</a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="typeContenusTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($type_contenus as $type)
                <tr>
                    <td>{{ $type->id_type_contenu }}</td>
                    <td>{{ $type->libelle_type }}</td>
                    <td>
                        <a href="{{ route('admin.type_contenus.edit', $type->id_type_contenu) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('admin.type_contenus.destroy', $type->id_type_contenu) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce type ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

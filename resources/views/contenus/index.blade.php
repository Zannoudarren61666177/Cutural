@extends('layouts.admin')

@section('title', 'Contenus')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des Contenus</h3>
        <a href="{{ route('admin.contenus.create') }}" class="btn btn-primary float-right">Ajouter un contenu</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="contenusTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Langue</th>
                    <th>Région</th>
                    <th>Type</th>
                    <th>Auteur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contenus as $contenu)
                <tr>
                    <td>{{ $contenu->id_contenu }}</td>
                    <td>{{ $contenu->titre }}</td>
                    <td>{{ $contenu->langue->libelle ?? '—' }}</td>
                    <td>{{ $contenu->region->nom_region ?? '—' }}</td>
                    <td>{{ $contenu->typeContenu->libelle_type ?? '—' }}</td>
                    <td>{{ $contenu->auteur->nom ?? '—' }} {{ $contenu->auteur->prenom ?? '' }}</td>
                    <td>
                        <a href="{{ route('admin.contenus.edit', $contenu->id_contenu) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('admin.contenus.destroy', $contenu->id_contenu) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce contenu ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

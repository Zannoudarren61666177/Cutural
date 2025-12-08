@extends('layouts.admin')

@section('title', 'Médias')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des Médias</h3>
        <a href="{{ route('admin.medias.create') }}" class="btn btn-primary float-right">Ajouter un Média</a>
    </div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="mediasTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fichier</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Contenu associé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medias as $media)
                <tr>
                    <td>{{ $media->id_media }}</td>

                    {{-- Afficher un lien pour télécharger / consulter --}}
                    <td>
                        @if($media->chemin)
                            <a href="{{ asset('storage/' . $media->chemin) }}" target="_blank">
                                {{ basename($media->chemin) }}
                            </a>
                        @else
                            -
                        @endif
                    </td>

                    <td>{{ $media->description ?? '-' }}</td>
                    <td>{{ $media->typeMedia->nom_media ?? '-' }}</td>
                    <td>{{ $media->contenu->titre ?? '-' }}</td>

                    <td>
                        <a href="{{ route('admin.medias.edit', $media->id_media) }}"
                           class="btn btn-sm btn-warning">Modifier</a>

                        <form action="{{ route('admin.medias.destroy', $media->id_media) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce média ?')">
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

@push('scripts')
<script>
$(document).ready(function () {
    $('#mediasTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container()
      .appendTo('#mediasTable_wrapper .col-md-6:eq(0)');
});
</script>
@endpush

@endsection

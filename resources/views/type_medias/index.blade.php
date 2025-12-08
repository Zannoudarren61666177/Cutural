@extends('layouts.admin')

@section('title', 'Types de Médias')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Liste des Types de Médias</h3>
        <a href="{{ route('admin.type_medias.create') }}" class="btn btn-primary">Ajouter un type</a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="typeMediasTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du média</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($type_medias as $type)
                <tr>
                    <td>{{ $type->id_type_media }}</td>
                    <td>{{ $type->nom_media }}</td>
                    <td>
                        <a href="{{ route('admin.type_medias.edit', $type->id_type_media) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('admin.type_medias.destroy', $type->id_type_media) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce type ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#typeMediasTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false
    });
});
</script>
@endpush

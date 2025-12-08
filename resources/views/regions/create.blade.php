@extends('layouts.admin')

@section('title', 'Ajouter une région')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Ajouter une région</h1>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Formulaire de création</h3>
        </div>

        <form action="{{ route('admin.regions.store') }}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group mb-3">
                    <label for="nom_region">Nom de la région <span class="text-danger">*</span></label>
                    <input type="text" name="nom_region" id="nom_region" class="form-control @error('nom_region') is-invalid @enderror" 
                           value="{{ old('nom_region') }}" required>
                    @error('nom_region')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="population">Population</label>
                    <input type="number" name="population" id="population" class="form-control" value="{{ old('population') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="superficie">Superficie</label>
                    <input type="number" step="0.01" name="superficie" id="superficie" class="form-control" value="{{ old('superficie') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="localisation">Localisation</label>
                    <input type="text" name="localisation" id="localisation" class="form-control" value="{{ old('localisation') }}">
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Ajouter</button>
                <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection

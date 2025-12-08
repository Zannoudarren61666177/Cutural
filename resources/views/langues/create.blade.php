@extends('layouts.admin')

@section('title', 'Ajouter une langue')

@section('content')

<div class="container-fluid">
    <h1 class="mb-4">Ajouter une langue</h1>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Formulaire de création</h3>
    </div>

    <!-- Form start -->
    <form action="{{ route('admin.langues.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <!-- Nom de la langue -->
            <div class="form-group">
                <label for="libelle">Nom de la langue <span class="text-danger">*</span></label>
                <input type="text" name="libelle" 
                       class="form-control @error('libelle') is-invalid @enderror" 
                       id="libelle" value="{{ old('libelle') }}" 
                       placeholder="Entrez le nom de la langue" required>
                @error('libelle')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Code de la langue -->
            <div class="form-group">
                <label for="code_langue">Code <span class="text-danger">*</span></label>
                <input type="text" name="code_langue" 
                       class="form-control @error('code_langue') is-invalid @enderror" 
                       id="code_langue" value="{{ old('code_langue') }}" 
                       placeholder="Ex: FR, EN, GN" required>
                @error('code_langue')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" 
                          class="form-control @error('description') is-invalid @enderror" 
                          placeholder="Description de la langue">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Card footer -->
        <div class="card-footer">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Ajouter
            </button>
            <a href="{{ route('admin.langues.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-lg"></i> Annuler
            </a>
        </div>
    </form>
</div>

</div>
@endsection

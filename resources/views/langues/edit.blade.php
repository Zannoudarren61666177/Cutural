@extends('layouts.admin')

@section('title', 'Modifier une langue')

@section('content')

<div class="container-fluid">
    <h1 class="mb-4">Modifier la langue : {{ $langue->libelle }}</h1>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Formulaire de modification</h3>
        </div>

        <!-- Form start -->
        <form action="{{ route('admin.langues.update', $langue->id_langue) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                <!-- Nom de la langue -->
                <div class="form-group mb-3">
                    <label for="libelle">Nom de la langue <span class="text-danger">*</span></label>
                    <input type="text" name="libelle" 
                           class="form-control @error('libelle') is-invalid @enderror" 
                           id="libelle" value="{{ old('libelle', $langue->libelle) }}" 
                           placeholder="Entrez le nom de la langue" required>
                    @error('libelle')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Code de la langue -->
                <div class="form-group mb-3">
                    <label for="code_langue">Code <span class="text-danger">*</span></label>
                    <input type="text" name="code_langue" 
                           class="form-control @error('code_langue') is-invalid @enderror" 
                           id="code_langue" value="{{ old('code_langue', $langue->code_langue) }}" 
                           placeholder="Ex: FR, EN, GN" required>
                    @error('code_langue')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" 
                              class="form-control @error('description') is-invalid @enderror" 
                              placeholder="Description de la langue">{{ old('description', $langue->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Card footer -->
            <div class="card-footer">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Mettre à jour
                </button>
                <a href="{{ route('admin.langues.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

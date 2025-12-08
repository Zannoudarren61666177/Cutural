@extends('layouts.admin')

@section('title', $contenu->titre)

@section('content')
<div class="container mt-4">

    {{-- ====== TITRE ET TEXTE DU CONTENU ====== --}}
    <div class="card mb-4">
        <div class="card-header">
            <h3>{{ $contenu->titre }}</h3>
        </div>
        <div class="card-body">
            <p>{{ $contenu->texte }}</p>

            <p class="text-muted">
                Langue : {{ $contenu->langue->libelle ?? 'N/A' }} |
                Région : {{ $contenu->region->nom_region ?? 'N/A' }} |
                Type : {{ $contenu->typeContenu->libelle_type ?? 'N/A' }} |
                Auteur : {{ $contenu->auteur->nom ?? 'N/A' }} {{ $contenu->auteur->prenom ?? '' }}
            </p>
        </div>
    </div>

    {{-- ====== LISTE DES COMMENTAIRES ====== --}}
    <div class="card mb-4">
        <div class="card-header">
            <h4>Commentaires ({{ $contenu->commentaires->count() }})</h4>
        </div>

        <div class="card-body">
            @forelse($contenu->commentaires as $commentaire)
                <div class="border rounded p-3 mb-3">
                    <p class="mb-1">{{ $commentaire->texte }}</p>

                    @if($commentaire->note !== null)
                        <small class="text-warning fw-bold">
                            ⭐ Note : {{ $commentaire->note }}/5
                        </small><br>
                    @endif

                    <small class="text-muted">
                        Posté le : {{ $commentaire->created_at->format('d/m/Y H:i') }}
                    </small>

                    {{-- Suppression --}}
                    <form action="{{ route('admin.commentaires.destroy', $commentaire->id) }}" method="POST" class="mt-2" onsubmit="return confirm('Voulez-vous vraiment supprimer ce commentaire ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Supprimer</button>
                    </form>
                </div>
            @empty
                <p class="text-muted">Aucun commentaire pour ce contenu.</p>
            @endforelse
        </div>
    </div>

    {{-- ====== FORMULAIRE D'AJOUT DE COMMENTAIRE ====== --}}
    <div class="card">
        <div class="card-header">
            <h4>Laisser un commentaire</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.commentaires.store', $contenu->id_contenu) }}" method="POST">
                @csrf

                {{-- Texte du commentaire --}}
                <div class="mb-3">
                    <label class="form-label">Commentaire :</label>
                    <textarea name="texte" class="form-control" rows="3" required>{{ old('texte') }}</textarea>
                </div>

                {{-- Note --}}
                <div class="mb-3">
                    <label class="form-label">Note (optionnel) :</label>
                    <input type="number" name="note" class="form-control"
                           min="0" max="5" placeholder="0 à 5" value="{{ old('note') }}">
                </div>

                <button type="submit" class="btn btn-primary">
                    Envoyer le commentaire
                </button>
            </form>
        </div>
    </div>

</div>
@endsection

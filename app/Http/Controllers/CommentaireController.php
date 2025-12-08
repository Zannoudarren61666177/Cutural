<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Contenu;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    // Ajouter un commentaire pour un contenu spécifique
    public function store(Request $request, Contenu $contenu)
    {
        $validated = $request->validate([
            'texte' => 'required|string',
            'note' => 'nullable|integer|min:0|max:5',
        ]);

        $validated['id_contenu'] = $contenu->id_contenu;
        $validated['id_utilisateur'] = null; // pas de login pour l'instant

        Commentaire::create($validated);

        return redirect()->back()->with('success', 'Commentaire ajouté !');
    }

    // Supprimer un commentaire
    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();
        return redirect()->back()->with('success', 'Commentaire supprimé !');
    }
}

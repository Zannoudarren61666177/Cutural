<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Region;
use App\Models\Langues;
use App\Models\TypeContenu;
use App\Models\User;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
    // Liste des contenus
    public function index()
    {
        $contenus = Contenu::with(['auteur', 'moderateur', 'region', 'langue', 'typeContenu'])->get();
        return view('contenus.index', compact('contenus'));
    }

    // Formulaire de création
    public function create()
    {
        $regions = Region::all();
        $langues = Langues::all();
        $type_contenus = TypeContenu::all();
        $users = User::all();

        return view('contenus.create', compact('regions', 'langues', 'type_contenus', 'users'));
    }

    // Enregistrement d’un nouveau contenu
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'id_auteur' => 'required|exists:users,id_user',
        ]);

        $validated['id_moderateur'] = null;

        Contenu::create($validated);

        return redirect()->route('admin.contenus.index')->with('success', 'Contenu créé avec succès !');
    }

    // Afficher un contenu spécifique
    public function show(Contenu $contenu)
    {
        $contenu->load(['medias', 'commentaires']);
        return view('contenus.show', compact('contenu'));
    }

    // Formulaire d’édition
    public function edit(Contenu $contenu)
    {
        $regions = Region::all();
        $langues = Langues::all();
        $types = TypeContenu::all();
        $users = User::all();

        return view('contenus.edit', compact('contenu', 'regions', 'langues', 'types', 'users'));
    }

    // Mise à jour d’un contenu
    public function update(Request $request, Contenu $contenu)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'id_auteur' => 'required|exists:users,id_user',
        ]);

        $contenu->update($validated);

        return redirect()->route('admin.contenus.index')->with('success', 'Contenu mis à jour !');
    }

    // Suppression d’un contenu
    public function destroy(Contenu $contenu)
    {
        $contenu->delete();
        return redirect()->route('admin.contenus.index')->with('success', 'Contenu supprimé !');
    }
}

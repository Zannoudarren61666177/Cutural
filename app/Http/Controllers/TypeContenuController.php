<?php

namespace App\Http\Controllers;

use App\Models\TypeContenu;
use Illuminate\Http\Request;

class TypeContenuController extends Controller
{
    public function index()
    {
        $type_contenus = TypeContenu::all();
        return view('type_contenus.index', compact('type_contenus'));
    }

    public function create()
    {
        return view('type_contenus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle_type' => 'required|string|max:255',
        ]);

        TypeContenu::create($validated);

        // Route corrigée avec le préfixe admin
        return redirect()->route('admin.type_contenus.index')
                         ->with('success', 'Type de contenu créé !');
    }

    public function edit(TypeContenu $typeContenu)
    {
        return view('type_contenus.edit', compact('typeContenu'));
    }

    public function update(Request $request, TypeContenu $typeContenu)
    {
        $validated = $request->validate([
            'libelle_type' => 'required|string|max:255',
        ]);

        $typeContenu->update($validated);

        // Route corrigée avec le préfixe admin
        return redirect()->route('admin.type_contenus.index')
                         ->with('success', 'Type de contenu mis à jour !');
    }

    public function destroy(TypeContenu $typeContenu)
    {
        $typeContenu->delete();

        // Route corrigée avec le préfixe admin
        return redirect()->route('admin.type_contenus.index')
                         ->with('success', 'Type de contenu supprimé !');
    }
}

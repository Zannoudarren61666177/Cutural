<?php
namespace App\Http\Controllers;

use App\Models\Langues; 
use Illuminate\Http\Request;

class LanguesController extends Controller
{
    // Liste toutes les langues
    public function index()
    {
        $langues = Langues::all();
        return view('langues.index', compact('langues'));
    }

    // Formulaire de création
    public function create()
    {
        return view('langues.create');
    }

    // Enregistrement d'une nouvelle langue
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'code_langue' => 'required|string|max:10',
            'description' => 'nullable|string',
        ]);

        Langues::create($validated);

        return redirect()->route('admin.langues.index')->with('success', 'Langue créée avec succès !');
    }

    // Formulaire d'édition
    public function edit(Langues $langue)
    {
        return view('langues.edit', compact('langue'));
    }

    // Mise à jour de la langue
    public function update(Request $request, Langues $langue)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'code_langue' => 'required|string|max:10',
            'description' => 'nullable|string',
        ]);

        $langue->update($validated);

        return redirect()->route('admin.langues.index')->with('success', 'Langue mise à jour avec succès !');
    }

    // Suppression d'une langue
    public function destroy(Langues $langue)
    {
        $langue->delete();

        return redirect()->route('admin.langues.index')->with('success', 'Langue supprimée avec succès !');
    }
}

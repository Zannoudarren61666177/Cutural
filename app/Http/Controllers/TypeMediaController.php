<?php

namespace App\Http\Controllers;

use App\Models\TypeMedia;
use Illuminate\Http\Request;

class TypeMediaController extends Controller
{
    public function index()
    {
        $type_medias = TypeMedia::all();
        return view('type_medias.index', compact('type_medias'));
    }

    public function create()
    {
        return view('type_medias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_media' => 'required|string|max:255',
        ]);

        TypeMedia::create($validated);

        return redirect()->route('admin.type_medias.index')
                         ->with('success', 'Type de média créé !');
    }

    public function edit(TypeMedia $typeMedia)
    {
        return view('type_medias.edit', compact('typeMedia'));
    }

    public function update(Request $request, TypeMedia $typeMedia)
    {
        $validated = $request->validate([
            'nom_media' => 'required|string|max:255',
        ]);

        $typeMedia->update($validated);

        return redirect()->route('admin.type_medias.index')
                         ->with('success', 'Type de média mis à jour !');
    }

    public function destroy(TypeMedia $typeMedia)
    {
        $typeMedia->delete();

        return redirect()->route('admin.type_medias.index')
                         ->with('success', 'Type de média supprimé !');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Contenu;
use App\Models\TypeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $medias = Media::with(['contenu', 'typeMedia'])->get();
        return view('medias.index', compact('medias'));
    }

    public function create()
    {
        $contenus = Contenu::all();
        $type_medias = TypeMedia::all();
        return view('medias.create', compact('contenus', 'type_medias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'chemin' => 'required|file|max:10240', // 10MB
            'description' => 'nullable|string',
            'id_type_media' => 'required|exists:type_medias,id_type_media',
            'id_contenu' => 'required|exists:contenus,id_contenu',
        ]);

        // Upload fichier
        $file = $request->file('chemin');
        $validated['chemin'] = $file->store('medias', 'public');

        Media::create($validated);

        return redirect()->route('admin.medias.index')
            ->with('success', 'Média ajouté !');
    }

    public function edit(Media $media)
    {
        $contenus = Contenu::all();
        $type_medias = TypeMedia::all();
        return view('medias.edit', compact('media', 'contenus', 'type_medias'));
    }

    public function update(Request $request, Media $media)
    {
        $validated = $request->validate([
            'chemin' => 'nullable|file|max:10240',
            'description' => 'nullable|string',
            'id_type_media' => 'required|exists:type_medias,id_type_media',
            'id_contenu' => 'required|exists:contenus,id_contenu',
        ]);

        // Nouveau fichier ?
        if ($request->hasFile('chemin')) {

            if ($media->chemin && Storage::disk('public')->exists($media->chemin)) {
                Storage::disk('public')->delete($media->chemin);
            }

            $validated['chemin'] = $request->file('chemin')
                ->store('medias', 'public');
        }

        $media->update($validated);

        return redirect()->route('admin.medias.index')
            ->with('success', 'Média mis à jour !');
    }

    public function destroy(Media $media)
    {
        if ($media->chemin && Storage::disk('public')->exists($media->chemin)) {
            Storage::disk('public')->delete($media->chemin);
        }

        $media->delete();

        return redirect()->route('admin.medias.index')
            ->with('success', 'Média supprimé !');
    }
}

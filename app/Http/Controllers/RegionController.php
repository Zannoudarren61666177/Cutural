<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_region'   => 'required|string|max:255',
            'population'   => 'nullable|integer',
            'superficie'   => 'nullable|numeric',
            'localisation' => 'nullable|string|max:255',
        ]);

        Region::create($validated);

        return redirect()->route('admin.regions.index')
                         ->with('success', 'Région créée avec succès !');
    }

    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $validated = $request->validate([
            'nom_region'   => 'required|string|max:255',
            'population'   => 'nullable|integer',
            'superficie'   => 'nullable|numeric',
            'localisation' => 'nullable|string|max:255',
        ]);

        $region->update($validated);

        return redirect()->route('admin.regions.index')
                         ->with('success', 'Région mise à jour avec succès !');
    }

    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('admin.regions.index')
                         ->with('success', 'Région supprimée avec succès !');
    }
}

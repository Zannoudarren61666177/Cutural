<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenu;
use App\Models\Media;
use App\Models\Region;
use App\Models\Langues;
use App\Models\TypeContenu;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    // ------------------- ACCUEIL -------------------
    public function accueil()
    {
        $contenus = Contenu::latest()->take(6)->get();
        $medias = Media::latest()->take(6)->get();
        $regions = Region::all();
        $langues = Langues::all();

        $typeEvenement = TypeContenu::where('libelle_type', 'Événement')->first();

        $evenements = $typeEvenement
            ? Contenu::where('id_type_contenu', $typeEvenement->id_type_contenu)
                ->latest()
                ->take(6)
                ->get()
            : collect();

        return view('frontend.accueil', compact('contenus', 'medias', 'regions', 'langues', 'evenements'));
    }

    // ------------------- CONTENUS -------------------
    public function contenus()
    {
        $contenus = Contenu::latest()->paginate(12);
        return view('frontend.contenus.index', compact('contenus'));
    }

    public function contenusShow(Contenu $contenu)
    {
        return view('frontend.contenus.show', compact('contenu'));
    }

    // ------------------- MEDIAS -------------------
    public function medias()
    {
        $medias = Media::latest()->paginate(12);
        return view('frontend.medias.index', compact('medias'));
    }

    public function mediasShow(Media $media)
    {
        return view('frontend.medias.show', compact('media'));
    }

    // ------------------- REGIONS -------------------
    public function regions()
    {
        $regions = Region::all();
        return view('frontend.regions.index', compact('regions'));
    }

    public function regionsShow(Region $region)
    {
        $region->load('langues');
        return view('frontend.regions.show', compact('region'));
    }

    // ------------------- LANGUES -------------------
    public function langues()
    {
        $langues = Langues::all();
        return view('frontend.langues.index', compact('langues'));
    }

    public function languesShow(Langues $langue)
    {
        return view('frontend.langues.show', compact('langue'));
    }

    // ------------------- EVENEMENTS -------------------
    public function evenements()
    {
        $typeEvenement = TypeContenu::where('libelle_type', 'Événement')->first();

        $evenements = $typeEvenement
            ? Contenu::where('id_type_contenu', $typeEvenement->id_type_contenu)
                ->latest()
                ->paginate(12)
            : collect();

        return view('frontend.evenements.index', compact('evenements'));
    }

    public function evenementsShow(Contenu $evenement)
    {
        return view('frontend.evenements.show', compact('evenement'));
    }

    // ------------------- CONTRIBUTEURS -------------------
    public function devenirContributeur(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'contributeur') {
            $user->role = 'contributeur';
            $user->save();
        }

        return redirect()->back()->with('success', 'Vous êtes désormais contributeur !');
    }

    public function contributeursIndex()
    {
        $user = Auth::user();
        $contributions = Contenu::where('id_auteur', $user->id_user)->latest()->get();

        return view('frontend.contributeurs.index', compact('contributions'));
    }

    public function contributeursAjouter()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'contributeur') {
            return redirect()->route('dashboard')
                ->with('error', 'Vous devez être contributeur pour ajouter du contenu.');
        }

        $typesContenus = TypeContenu::all();
        $regions = Region::all();
        $langues = Langues::all();

        return view('frontend.contributeurs.ajouter', compact('typesContenus', 'regions', 'langues'));
    }

    public function contributeursStore(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'contributeur') {
            return redirect()->route('dashboard')
                ->with('error', 'Vous devez être contributeur pour ajouter du contenu.');
        }

        $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'type_contenu_id' => 'required|exists:type_contenus,id_type_contenu',
            'region_id' => 'required|exists:regions,id_region',
            'langue_id' => 'required|exists:langues,id_langue',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov|max:10240',
        ]);

        $mediaPath = $request->hasFile('media')
            ? $request->file('media')->store('medias', 'public')
            : null;

        Contenu::create([
            'titre' => $request->titre,
            'texte' => $request->texte,
            'id_type_contenu' => $request->type_contenu_id,
            'id_region' => $request->region_id,
            'id_langue' => $request->langue_id,
            'id_auteur' => $user->id_user,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('contributeurs.index')
            ->with('success', 'Votre contribution a été soumise et est en attente de validation.');
    }

    public function contributeursShow(Contenu $contenu)
    {
        return view('frontend.contributeurs.show', compact('contenu'));
    }
}

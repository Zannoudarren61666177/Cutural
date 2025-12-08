<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Langues;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ---- Derniers contenus ----
        $lastContenus = Contenu::latest()->take(5)->get();

        // ---- Graphique : contenus ajoutés par mois (sur l'année actuelle) ----
        $chartDataRaw = Contenu::select(
                DB::raw("MONTH(created_at) as mois"),
                DB::raw("COUNT(*) as total")
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // Labels (mois en texte)
        $chartLabels = $chartDataRaw->map(fn ($item) =>
            Carbon::create()->month($item->mois)->format('F')
        );

        // Données (totaux)
        $chartData = $chartDataRaw->pluck('total');

        return view('welcome', [
            'totalContenus' => Contenu::count(),
            'totalLangues'  => Langues::count(),
            'totalRegions'  => Region::count(),
            'totalUsers'    => User::count(),

            // Dashboard data
            'lastContenus' => $lastContenus,
            'chartLabels'  => $chartLabels,
            'chartData'    => $chartData,
        ]);
    }
}

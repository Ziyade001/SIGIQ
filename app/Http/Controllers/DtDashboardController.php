<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Inspection;
use App\Models\Amende;
use Carbon\Carbon;

class DtDashboardController extends Controller
{
    public function index()
    {
        $debutMois = Carbon::now()->startOfMonth();
        $finMois = Carbon::now()->endOfMonth();

        /*
        |--------------------------------------------------------------------------
        | KPI DU MOIS
        |--------------------------------------------------------------------------
        */

        $missionsEnCours = Mission::where('statut', 'en_cours')
            ->count();

        $missionsTerminees = Mission::whereIn('statut', [
        'terminee',
        'validee'
    ])
            ->count();

        $inspectionsMois = Inspection::whereBetween(
            'created_at',
            [$debutMois, $finMois]
        )->count();

        $montantAmendesMois = Amende::whereBetween(
            'created_at',
            [$debutMois, $finMois]
        )->sum('montant_total');

        /*
|--------------------------------------------------------------------------
| Evolution des amendes sur les 6 derniers mois
|--------------------------------------------------------------------------
*/

$chartData = [];

for ($i = 5; $i >= 0; $i--) {

    $date = Carbon::now()->subMonths($i);

    $montant = Amende::whereYear( 'created_at', $date->year ) ->whereMonth( 'created_at', $date->month ) ->sum('montant_total');

    $chartData[] = [
        'mois'     => $date->translatedFormat('M'),
        'montant'  => $montant,
    ];
}

$maxMontant = collect($chartData)->max('montant');

foreach ($chartData as &$item) {

    $item['hauteur'] = $maxMontant > 0
        ? max(
            round(
                ($item['montant'] / $maxMontant) * 100
            ),
            8
        )
        : 8;
}

        /*
        |--------------------------------------------------------------------------
        | SITUATION DES AMENDES
        |--------------------------------------------------------------------------
        */

        $nombreAmendes = Amende::whereBetween(
            'created_at',
            [$debutMois, $finMois]
        )->count();

        $totalAmendes = Amende::whereBetween(
            'created_at',
            [$debutMois, $finMois]
        )->sum('montant_total');

        $totalPaye = Amende::whereBetween(
            'created_at',
            [$debutMois, $finMois]
        )->sum('montant_paye');

        $totalImpaye = Amende::whereBetween(
            'created_at',
            [$debutMois, $finMois]
        )->sum('montant_impaye');

        /*
        |--------------------------------------------------------------------------
        | CONTROLES
        |--------------------------------------------------------------------------
        */

        $missionsValideesMois = Mission::where(
        'statut',
        'validee'
    )
    ->whereBetween(
        'updated_at',
        [$debutMois, $finMois]
    )
    ->get();

$instrumentsControles = $missionsValideesMois->sum(
    'nb_instruments_controles'
);

$preemballesControles = $missionsValideesMois->sum(
    'nb_preemballes_controles'
);

$boutiquesControlees = $missionsValideesMois->sum(
    'nb_boutiques_controlees'
);

$boutiquesNonConformes = $missionsValideesMois->sum(
    'nb_boutiques_non_conformes'
);
        /*
        |--------------------------------------------------------------------------
        | DERNIERES MISSIONS
        |--------------------------------------------------------------------------
        */

        $dernieresMissions = Mission::withCount('inspections')
            ->latest()
            ->take(5)
            ->get();

        return view(
            'dashboards.dt',
            compact(
                'missionsEnCours',
                'missionsTerminees',
                'inspectionsMois',
                'montantAmendesMois',
                'nombreAmendes',
                'chartData',
                'totalAmendes',
                'totalPaye',
                'totalImpaye',
                'instrumentsControles',
                'preemballesControles',
                'boutiquesControlees',
                'boutiquesNonConformes',
                'dernieresMissions'
            )
        );
    }
}
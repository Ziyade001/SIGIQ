<?php

namespace App\Http\Controllers;

use App\Models\Amende;
use App\Models\Inspection;
use App\Models\Mission;
use Carbon\Carbon;

class DgDashboardController extends Controller
{
    public function index()
    {
        $debutMois = Carbon::now()->startOfMonth();
        $finMois   = Carbon::now()->endOfMonth();

        /*
        |--------------------------------------------------------------------------
        | KPI DU MOIS
        |--------------------------------------------------------------------------
        */

        $missionsEnCours = Mission::where('statut', 'en_cours')
            ->whereBetween('created_at', [$debutMois, $finMois])
            ->count();

        $missionsTerminees = Mission::whereIn(
                'statut',
                ['terminee', 'validee']
            )
            ->whereBetween('created_at', [$debutMois, $finMois])
            ->count();

        $inspectionsTotal = Inspection::whereBetween(
            'date',
            [$debutMois, $finMois]
        )->count();

        $montantAmendes = Amende::whereHas(
            'inspection',
            function ($query) use ($debutMois, $finMois) {

                $query->whereBetween(
                    'date',
                    [$debutMois, $finMois]
                );
            }
        )->sum('montant_total');

        /*
        |--------------------------------------------------------------------------
        | SITUATION DES AMENDES DU MOIS
        |--------------------------------------------------------------------------
        */

        $nombreAmendes = Amende::whereHas(
            'inspection',
            function ($query) use ($debutMois, $finMois) {

                $query->whereBetween(
                    'date',
                    [$debutMois, $finMois]
                );
            }
        )->count();

        $montantTotalAmendes = Amende::whereHas(
            'inspection',
            function ($query) use ($debutMois, $finMois) {

                $query->whereBetween(
                    'date',
                    [$debutMois, $finMois]
                );
            }
        )->sum('montant_total');

        $montantPaye = Amende::whereHas(
            'inspection',
            function ($query) use ($debutMois, $finMois) {

                $query->whereBetween(
                    'date',
                    [$debutMois, $finMois]
                );
            }
        )->sum('montant_paye');

        $montantImpaye = Amende::whereHas(
            'inspection',
            function ($query) use ($debutMois, $finMois) {

                $query->whereBetween(
                    'date',
                    [$debutMois, $finMois]
                );
            }
        )->sum('montant_impaye');

        /*
        |--------------------------------------------------------------------------
        | CONTRÔLES DU MOIS
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
        | GRAPHIQUE - 6 DERNIERS MOIS
        |--------------------------------------------------------------------------
        */

        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {

            $date = Carbon::now()->subMonths($i);

            $montant = Amende::whereHas(
                'inspection',
                function ($query) use ($date) {

                    $query->whereYear(
                        'date',
                        $date->year
                    )
                    ->whereMonth(
                        'date',
                        $date->month
                    );
                }
            )->sum('montant_total');

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
        | RAPPORTS RÉCENTS
        |--------------------------------------------------------------------------
        */

        $rapports = Mission::where(
                'statut',
                'validee'
            )
            ->latest()
            ->take(5)
            ->get();

        return view(
            'dashboards.dg',
            compact(
                'missionsEnCours',
                'missionsTerminees',
                'inspectionsTotal',
                'montantAmendes',

                'nombreAmendes',
                'montantTotalAmendes',
                'montantPaye',
                'montantImpaye',

                'boutiquesControlees',
                'boutiquesNonConformes',
                'instrumentsControles',
                'preemballesControles',

                'chartData',

                'rapports'
            )
        );
    }
}
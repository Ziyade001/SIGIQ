<?php

namespace App\Http\Controllers;

use App\Models\Amende;
use App\Models\Inspection;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardInspecteurController extends Controller
{
    public function index()
    {
        $moisActuel = Carbon::now()->month;
        $anneeActuelle = Carbon::now()->year;

        $user = User::findOrFail(Auth::id());

        $inspectionsCount = Inspection::where(
        'inspecteur_id',
        $user->id
    )
    ->whereYear('date', $anneeActuelle)
    ->whereMonth('date', $moisActuel)
    ->count();

        $preemballesCount = Inspection::where(
        'inspecteur_id',
        $user->id
    )
    ->where('type_inspection', 'preemballe')
    ->whereYear('date', $anneeActuelle)
    ->whereMonth('date', $moisActuel)
    ->count();

        $mesuresCount = Inspection::where(
        'inspecteur_id',
        $user->id
    )
    ->whereIn('type_inspection', [
        'pesage',
        'volume'
    ])
    ->whereYear('date', $anneeActuelle)
    ->whereMonth('date', $moisActuel)
    ->count();

        $totalAmendes = Amende::whereHas(
    'inspection',
    function ($q) use (
        $user,
        $anneeActuelle,
        $moisActuel
    ) {
        $q->where('inspecteur_id', $user->id)
          ->whereYear('date', $anneeActuelle)
          ->whereMonth('date', $moisActuel);
    }
)->sum('montant_total');

        $totalPaye = Amende::whereHas(
    'inspection',
    function ($q) use (
        $user,
        $anneeActuelle,
        $moisActuel
    ) {
        $q->where('inspecteur_id', $user->id)
          ->whereYear('date', $anneeActuelle)
          ->whereMonth('date', $moisActuel);
    }
)->sum('montant_paye');

        $totalImpaye = Amende::whereHas(
    'inspection',
    function ($q) use (
        $user,
        $anneeActuelle,
        $moisActuel
    ) {
        $q->where('inspecteur_id', $user->id)
          ->whereYear('date', $anneeActuelle)
          ->whereMonth('date', $moisActuel);
    }
)->sum('montant_impaye');

        $nombreAmendes = Amende::whereHas(
    'inspection',
    function ($q) use (
        $user,
        $anneeActuelle,
        $moisActuel
    ) {
        $q->where('inspecteur_id', $user->id)
          ->whereYear('date', $anneeActuelle)
          ->whereMonth('date', $moisActuel);
    }
)->count();

$tauxRecouvrement = $totalAmendes > 0
    ? round(($totalPaye / $totalAmendes) * 100, 1)
    : 0;

        $inspections = Inspection::with('mission')
    ->where('inspecteur_id', $user->id)
    ->whereYear('date', $anneeActuelle)
    ->whereMonth('date', $moisActuel)
    ->latest()
    ->take(5)
    ->get();

        $missions = $user->missions()
    ->whereYear('periode_debut', $anneeActuelle)
    ->whereMonth('periode_debut', $moisActuel)
    ->latest()
    ->take(5)
    ->get();

        return view(
            'dashboards.inspecteur',
            compact(
                'mesuresCount',
                'inspectionsCount',
                'preemballesCount',
                'nombreAmendes',
                'tauxRecouvrement',
                'totalAmendes',
                'totalPaye',
                'totalImpaye',
                'inspections',
                'missions'
            )
        );
    }
}
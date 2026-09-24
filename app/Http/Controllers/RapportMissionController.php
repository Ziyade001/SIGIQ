<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RapportMissionController extends Controller
{
    /**
     * Liste des rapports.
     */
    public function index()
{
    $user = Auth::user();

    $query = Mission::whereIn('statut', [
        'terminee',
        'validee'
    ]);

    // Filtre mois / année
$mois = request('mois', now()->month);
$annee = request('annee', now()->year);

$query->whereYear('created_at', $annee)
      ->whereMonth('created_at', $mois);



    // Recherche
    if (request()->filled('search')) {

        $search = request('search');

        $query->where(function ($q) use ($search) {

            $q->where('reference', 'like', "%{$search}%")
              ->orWhere('localites', 'like', "%{$search}%")
              ->orWhere('categorie', 'like', "%{$search}%")
              ->orWhere('statut', 'like', "%{$search}%");

        });
    }

    // Restriction inspecteur
    if ($user->role === 'inspecteur') {

        $query->whereHas('participants', function ($q) use ($user) {

            $q->where('users.id', $user->id);

        });

    }

    $missions = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view(
        'rapports.index',
        compact('missions', 'mois',
        'annee')
    );
}

    /**
     * Affichage d'un rapport.
     */
    public function show(Mission $mission)
    {
        $mission->load([
            'participants',
            'inspections'
        ]);

        return view(
            'rapports.show',
            compact('mission')
        );
    }

    /**
     * Formulaire d'édition du rapport.
     */
    public function edit(Mission $mission)
    {
        if ($mission->statut !== 'terminee') {

            return redirect()
                ->route('rapports.index')
                ->with(
                    'error',
                    'La mission doit être terminée avant la rédaction du rapport.'
                );
        }

        return view(
            'rapports.edit',
            compact('mission')
        );
    }

    /**
     * Enregistrement des informations du rapport.
     */
    public function update(
        Request $request,
        Mission $mission
    ) {

        $validated = $request->validate([

            'fiche_signee_par' => [
                'required',
                'string',
                'max:255'
            ],

            'compte_rendu' => [
                'required',
                'string'
            ],

            'nb_boutiques_controlees' => [
                'required',
                'integer',
                'min:0'
            ],

            'nb_instruments_controles' => [
                'required',
                'integer',
                'min:0'
            ],

            'nb_preemballes_controles' => [
                'required',
                'integer',
                'min:0'
            ],

            'montant_frais_verification' => [
                'required',
                'numeric',
                'min:0'
            ],

            'nb_instruments_mis_conformite' => [
                'required',
                'integer',
                'min:0'
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Calcul automatique des statistiques
        |--------------------------------------------------------------------------
        */

        $nbBoutiquesNonConformes = $mission->inspections()
            ->whereNotNull('ifu')
            ->distinct()
            ->count('ifu');

        $nbInstrumentsNonConformes = $mission->inspections()
            ->whereIn(
                'type_inspection',
                ['pesage', 'volume']
            )
            ->count();

        $nbPreemballesNonConformes = $mission->inspections()
            ->where(
                'type_inspection',
                'preemballe'
            )
            ->count();

        $nbAmendes = $mission->inspections()
            ->where('amendes', '>', 0)
            ->count();

        $montantAmendes = $mission->inspections()
            ->whereNotNull('amendes')
            ->sum('amendes');

        /*
        |--------------------------------------------------------------------------
        | Mise à jour du rapport
        |--------------------------------------------------------------------------
        */

        $mission->update([

            ...$validated,

            'nb_boutiques_non_conformes'
                => $nbBoutiquesNonConformes,

            'nb_instruments_non_conformes'
                => $nbInstrumentsNonConformes,

            'nb_preemballes_non_conformes'
                => $nbPreemballesNonConformes,

            'nb_amendes'
                => $nbAmendes,

            'montant_amendes'
                => $montantAmendes,

            'statut' => 'validee',
        ]);

        return redirect()
            ->route(
                'rapports.show',
                $mission
            )
            ->with(
                'success',
                'Rapport de mission enregistré avec succès.'
            );
    }
}
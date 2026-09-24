<?php

namespace App\Http\Controllers;

use App\Models\Convocation;
use App\Models\Inspection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ConvocationController extends Controller
{
    /**
     * Liste des convocations.
     */
    public function index()
{

    $user = Auth::user();

    $query = Convocation::with([
        'inspection',
        'inspection.inspecteur'
    ]);

    $mois = request('mois', now()->month);
    $annee = request('annee', now()->year);

    $query->whereYear('created_at', $annee)
      ->whereMonth('created_at', $mois);

    // Recherche
    if (request()->filled('search')) {

        $search = request('search');

        $query->where(function ($q) use ($search) {

            $q->where('reference', 'like', "%{$search}%")

              ->orWhereHas('inspection', function ($inspection) use ($search) {

                  $inspection->where(
                      'reference',
                      'like',
                      "%{$search}%"
                  );

              })

              ->orWhereHas('inspection.inspecteur', function ($inspecteur) use ($search) {

                  $inspecteur->where(
                      'name',
                      'like',
                      "%{$search}%"
                  );

              });

        });
    }

    // L'inspecteur ne voit que ses convocations
    if ($user->role === 'inspecteur') {

        $query->whereHas('inspection', function ($q) use ($user) {

            $q->where(
                'inspecteur_id',
                $user->id
            );

        });

    }

    $convocations = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view(
    'convocations.index',
    compact(
        'convocations',
        'mois',
        'annee'
    )
);
}

    /**
     * Affichage d'une convocation.
     */
    public function show(Convocation $convocation)
    {
        $convocation->load([
            'inspection',
            'inspection.inspecteur',
            'inspection.mission',
            'inspection.amende'
        ]);

        return view(
            'convocations.show',
            compact('convocation')
        );
    }

    /**
     * Formulaire de modification.
     */
    public function edit(Convocation $convocation)
    {
        return view(
            'convocations.edit',
            compact('convocation')
        );
    }

    /**
     * Mise à jour.
     */
    public function update(
        Request $request,
        Convocation $convocation
    ) {

        $validated = $request->validate([

            'date_convocation' => [
                'required',
                'date'
            ],

            'heure_convocation' => [
                'required'
            ],

            'infraction' => [
                'required',
                'string'
            ],

            'remise' => [
                'nullable',
                'boolean'
            ],
        ]);

        $convocation->update([

            'date_convocation' =>
                $validated['date_convocation'],

            'heure_convocation' =>
                $validated['heure_convocation'],

            'infraction' =>
                $validated['infraction'],

            'remise' =>
                $request->has('remise'),
        ]);

        return redirect()
            ->route(
                'convocations.show',
                $convocation
            )
            ->with(
                'success',
                'Convocation mise à jour avec succès.'
            );
    }

    /**
     * Suppression.
     */
    public function destroy(
        Convocation $convocation
    ) {

        $convocation->delete();

        return redirect()
            ->route('convocations.index')
            ->with(
                'success',
                'Convocation supprimée avec succès.'
            );
    }

    /**
     * Génération automatique depuis une inspection.
     */
    public function generer(
        Inspection $inspection
    ) {

        if ($inspection->convocation) {

            return redirect()
                ->route(
                    'convocations.show',
                    $inspection->convocation
                );
        }

        $convocation = Convocation::create([

    'inspection_id' => $inspection->id,

    'reference' => 'CONV-' . $inspection->reference,

    'date_convocation' => now()->addDays(7)->toDateString(),

    'heure_convocation' => '09:00',

    'infraction' => $inspection->anomalies,
]);

        return redirect()
            ->route(
                'convocations.show',
                $convocation
            )
            ->with(
                'success',
                'Convocation générée avec succès.'
            );
    }
}
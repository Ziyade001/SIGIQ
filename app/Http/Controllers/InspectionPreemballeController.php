<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\InspectionPreemballe;
use Illuminate\Http\Request;

class InspectionPreemballeController extends Controller
{
    /**
     * Formulaire de création.
     */
    public function create(Inspection $inspection)
    {
        return view(
            'inspections.preemballes.create',
            compact('inspection')
        );
    }

    /**
     * Enregistrement.
     */
    public function store(Request $request, Inspection $inspection)
    {
        $validated = $request->validate([

            // Informations générales
            'produit' => ['required', 'string', 'max:255'],
            'quantite_nominale' => ['required', 'numeric'],
            'effectif_lot' => ['required', 'integer'],
            'effectif_echantillon' => ['required', 'integer'],
            'marque' => ['nullable', 'string', 'max:255'],

            // Emballages vides
            'emballages_vides' => ['nullable', 'array'],
            'emballages_vides.*' => ['numeric'],

            // Échantillons
            'echantillons' => ['nullable', 'array'],
            'echantillons.*.numero' => ['required', 'integer'],
            'echantillons.*.poids_brut' => ['required', 'numeric'],
            'echantillons.*.poids_net' => ['required', 'numeric'],
        ]);

        $preemballe = InspectionPreemballe::create([
            'inspection_id' => $inspection->id,

            'produit' => $validated['produit'],
            'quantite_nominale' => $validated['quantite_nominale'],
            'effectif_lot' => $validated['effectif_lot'],
            'effectif_echantillon' => $validated['effectif_echantillon'],
            'marque' => $validated['marque'] ?? null,
        ]);

        /**
         * Emballages vides
         */
        if ($request->filled('emballages_vides')) {

            foreach ($request->emballages_vides as $poids) {

                $preemballe->emballagesVides()->create([
                    'poids' => $poids,
                ]);
            }
        }

        /**
         * Échantillons
         */
        if ($request->filled('echantillons')) {

            foreach ($request->echantillons as $echantillon) {

                $preemballe->echantillons()->create([
                    'numero' => $echantillon['numero'],
                    'poids_brut' => $echantillon['poids_brut'],
                    'poids_net' => $echantillon['poids_net'],
                ]);
            }
        }

        return redirect()
            ->route('inspections.show', $inspection)
            ->with(
                'success',
                'Inspection préemballée enregistrée avec succès.'
            );
    }

    /**
     * Affichage.
     */
    public function show(Inspection $inspection)
    {
    $preemballe = $inspection->preemballe;

    $preemballe->load([
        'emballagesVides',
        'echantillons'
    ]);

    return view(
        'inspections.preemballes.show',
        compact('inspection', 'preemballe')
    );
    }

    /**
     * Formulaire de modification.
     */
    public function edit(Inspection $inspection)
    {
    $preemballe = $inspection->preemballe;

    $preemballe->load([
        'emballagesVides',
        'echantillons'
    ]);

    return view(
        'inspections.preemballes.edit',
        compact('inspection', 'preemballe')
    );
    }

    /**
     * Mise à jour.
     */
    public function update(
    Request $request,
    Inspection $inspection
)
{
    $preemballe = $inspection->preemballe;

    $validated = $request->validate([
        'produit' => ['required', 'string', 'max:255'],
        'quantite_nominale' => ['required', 'numeric'],
        'effectif_lot' => ['required', 'integer'],
        'effectif_echantillon' => ['required', 'integer'],
        'marque' => ['nullable', 'string', 'max:255'],

        // Résultats du contrôle
    'moyenne_emballage_vide' => ['nullable', 'numeric'],
    'ecart_type_emballage_vide' => ['nullable', 'numeric'],
    'emt' => ['nullable', 'numeric'],
    'emt_sur_5' => ['nullable', 'numeric'],
    'eave' => ['nullable', 'numeric'],
    'ecart_type' => ['nullable', 'numeric'],
    'fce' => ['nullable', 'numeric'],
    'quantite_corrigee' => ['nullable', 'numeric'],
    't1' => ['nullable', 'numeric'],
    't2' => ['nullable', 'numeric'],

    'resultat_moyenne' => ['nullable', 'string', 'max:255'],
    'resultat_t1' => ['nullable', 'string', 'max:255'],
    'resultat_t2' => ['nullable', 'string', 'max:255'],

    ]);

    $preemballe->update($validated);

    return redirect()
        ->route('inspections.show', $inspection)
        ->with(
            'success',
            'Inspection préemballée mise à jour avec succès.'
        );
}

    /**
     * Suppression.
     */
    public function destroy(Inspection $inspection)
{
    $inspection->preemballe?->delete();

    return redirect()
        ->route('inspections.show', $inspection)
        ->with(
            'success',
            'Inspection préemballée supprimée avec succès.'
        );
}
}
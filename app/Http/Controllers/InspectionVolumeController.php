<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\InspectionVolume;
use Illuminate\Http\Request;

class InspectionVolumeController extends Controller
{
    /**
     * Formulaire de création.
     */
    public function create(Inspection $inspection)
    {
        return view(
            'inspections.volumes.create',
            compact('inspection')
        );
    }

    /**
     * Enregistrement.
     */
    public function store(Request $request, Inspection $inspection)
    {
        $validated = $request->validate([
         
            'nom_commercial' => ['nullable', 'string'],

            'identification_distributeur' => ['required', 'string'],

            'prix_unitaire_affiche' => ['nullable', 'numeric'],

            'lecture_totalisateur_fin' => ['nullable', 'numeric'],

            'lecture_totalisateur_debut' => ['nullable', 'numeric'],

            'retour_cuve' => ['nullable', 'numeric'],

            'produit' => ['required', 'string'],

            'marque_cabine' => ['nullable', 'string'],

            'numero_serie_cabine' => ['nullable', 'string'],

            'marque_mesureur' => ['nullable', 'string'],

            'numero_serie_mesureur' => ['nullable', 'string'],

            'verification_dispositifs_indicateurs' => ['nullable', 'boolean'],

            'mise_a_zero' => ['nullable', 'boolean'],

            'calcul_prix' => ['nullable', 'boolean'],

            'coupure_flexible_pistolet' => ['nullable', 'boolean'],

            'conformite' => ['nullable', 'boolean'],

            'numero_vignette' => ['nullable', 'string'],

            'numero_scelle' => ['nullable', 'string'],

            'representant_utilisateur' => ['nullable', 'string'],

            'technicien_reparateur' => ['nullable', 'string'],

            /*
            |--------------------------------------------------------------------------
            | Essais
            |--------------------------------------------------------------------------
            */

            'essais' => ['required', 'array'],

            'essais.*.numero_essai' => ['required', 'integer'],

            'essais.*.volume_nominal' => ['required', 'numeric'],

            'essais.*.vdr' => ['nullable', 'numeric'],

            'essais.*.vref' => ['nullable', 'numeric'],

            'essais.*.edr' => ['nullable', 'numeric'],

            'essais.*.emt' => ['nullable', 'numeric'],
        ]);

        $volume = InspectionVolume::create([

            'inspection_id' => $inspection->id,

            'nom_commercial' => $validated['nom_commercial'] ?? null,

            'identification_distributeur'
                => $validated['identification_distributeur'],

            'prix_unitaire_affiche'
                => $validated['prix_unitaire_affiche'] ?? null,

            'lecture_totalisateur_fin'
                => $validated['lecture_totalisateur_fin'] ?? null,

            'lecture_totalisateur_debut'
                => $validated['lecture_totalisateur_debut'] ?? null,

            'retour_cuve'
                => $validated['retour_cuve'] ?? null,

            'produit'
                => $validated['produit'],

            'marque_cabine'
                => $validated['marque_cabine'] ?? null,

            'numero_serie_cabine'
                => $validated['numero_serie_cabine'] ?? null,

            'marque_mesureur'
                => $validated['marque_mesureur'] ?? null,

            'numero_serie_mesureur'
                => $validated['numero_serie_mesureur'] ?? null,

            'verification_dispositifs_indicateurs'
                => $request->boolean('verification_dispositifs_indicateurs'),

            'mise_a_zero'
                => $request->boolean('mise_a_zero'),

            'calcul_prix'
                => $request->boolean('calcul_prix'),

            'coupure_flexible_pistolet'
                => $request->boolean('coupure_flexible_pistolet'),

            'conformite'
                => $request->boolean('conformite'),

            'numero_vignette'
                => $validated['numero_vignette'] ?? null,

            'numero_scelle'
                => $validated['numero_scelle'] ?? null,

            'representant_utilisateur'
                => $validated['representant_utilisateur'] ?? null,

            'technicien_reparateur'
                => $validated['technicien_reparateur'] ?? null,
        ]);

        foreach ($validated['essais'] as $essai) {

    $volume->essais()->create([
        'numero_essai' => $essai['numero_essai'],
        'volume_nominal' => $essai['volume_nominal'] ?? null,
        'vdr' => $essai['vdr'] ?? null,
        'vref' => $essai['vref'] ?? null,
        'edr' => $essai['edr'] ?? null,
        'emt' => $essai['emt'] ?? null,
    ]);
}

        return redirect()
            ->route('inspections.show', $inspection)
            ->with(
                'success',
                'Inspection de volume enregistrée avec succès.'
            );
    }

    /**
     * Affichage.
     */
    public function show(Inspection $inspection)
{
    $inspection->load([
        'volume.essais'
    ]);

    return view(
        'inspections.volumes.show',
        compact('inspection')
    );
}

    /**
     * Formulaire de modification.
     */
    public function edit(Inspection $inspection)
{
    $inspection->load([
        'volume.essais'
    ]);

    return view(
        'inspections.volumes.edit',
        compact('inspection')
    );
}

    /**
     * Mise à jour.
     */
    public function update(
    Request $request,
    Inspection $inspection
) {
    $volume = $inspection->volume;

    $validated = $request->validate([

        'nom_commercial' => ['nullable', 'string'],
        'identification_distributeur' => ['required', 'string'],
        'prix_unitaire_affiche' => ['nullable', 'numeric'],
        'lecture_totalisateur_fin' => ['nullable', 'numeric'],
        'lecture_totalisateur_debut' => ['nullable', 'numeric'],
        'retour_cuve' => ['nullable', 'numeric'],
        'produit' => ['required', 'string'],
        'marque_cabine' => ['nullable', 'string'],
        'numero_serie_cabine' => ['nullable', 'string'],
        'marque_mesureur' => ['nullable', 'string'],
        'numero_serie_mesureur' => ['nullable', 'string'],
    ]);

    $volume->update($validated);

    return redirect()
        ->route('inspections.show', $inspection)
        ->with(
            'success',
            'Inspection mise à jour avec succès.'
        );
}

    /**
     * Suppression.
     */
    public function destroy(Inspection $inspection)
{
    $inspection->volume?->delete();

    return redirect()
        ->route('inspections.show', $inspection)
        ->with(
            'success',
            'Inspection supprimée avec succès.'
        );
}
}
<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\InspectionPesage;
use Illuminate\Http\Request;

class InspectionPesageController extends Controller
{
    /**
     * Afficher le formulaire de création
     */
    public function create(Inspection $inspection)
    {
        return view('inspections.pesages.create', compact('inspection'));
    }

    /**
     * Enregistrer une inspection de pesage
     */
    public function store(Request $request, Inspection $inspection)
    {
        $validated = $request->validate([

            'instrument' => 'required|string|max:255',
            'marque' => 'nullable|string|max:255',
            'numero_serie' => 'nullable|string|max:255',

            'portee_max' => 'nullable|numeric',
            'portee_min' => 'nullable|numeric',

            'echelon_verification' => 'nullable|string|max:255',
            'echelon_affichage' => 'nullable|string|max:255',

            'annee_fabrication' => 'nullable|integer|min:1900|max:' . date('Y'),

            'numero_approbation_modele' => 'nullable|string|max:255',

            'infractions_constatees' => 'nullable|string',

        ]);

        $inspection->pesage()->create($validated);

        return redirect()
            ->route('inspections.show', $inspection->id)
            ->with('success', 'Inspection de pesage enregistrée avec succès.');
    }

    /**
     * Afficher une inspection de pesage
     */
    public function show(Inspection $inspection)
    {
        $pesage = $inspection->pesage;

        return view('inspections.pesages.show', compact('inspection', 'pesage'));
    }

    /**
     * Formulaire d'édition
     */
    public function edit(Inspection $inspection)
    {
        $pesage = $inspection->pesage;

        return view('inspections.pesages.edit', compact('inspection', 'pesage'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, Inspection $inspection)
    {
        $validated = $request->validate([

            'instrument' => 'required|string|max:255',
            'marque' => 'nullable|string|max:255',
            'numero_serie' => 'nullable|string|max:255',

            'portee_max' => 'nullable|numeric',
            'portee_min' => 'nullable|numeric',

            'echelon_verification' => 'nullable|string|max:255',
            'echelon_affichage' => 'nullable|string|max:255',

            'annee_fabrication' => 'nullable|integer|min:1900|max:' . date('Y'),

            'numero_approbation_modele' => 'nullable|string|max:255',

            'infractions_constatees' => 'nullable|string',

        ]);

        $pesage = $inspection->pesage;

        if (!$pesage) {
            $pesage = new InspectionPesage();
            $pesage->inspection_id = $inspection->id;
        }

        $pesage->update($validated);

        return redirect()
            ->route('inspections.show', $inspection->id)
            ->with('success', 'Inspection de pesage mise à jour avec succès.');
    }

    /**
     * Suppression
     */
    public function destroy(Inspection $inspection)
    {
        if ($inspection->pesage) {
            $inspection->pesage->delete();
        }

        return redirect()
            ->route('inspections.show', $inspection->id)
            ->with('success', 'Inspection de pesage supprimée.');
    }
}
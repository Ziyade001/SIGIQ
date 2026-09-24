<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Mission;
use App\Models\Amende;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InspectionController extends Controller
{
    /**
     * Liste des inspections.
     */
    public function index()
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $query = Inspection::with([
        'mission',
        'inspecteur'
    ])->latest();

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
              ->orWhere('etablissement', 'like', "%{$search}%")
              ->orWhere('ifu', 'like', "%{$search}%")
              ->orWhere('type_inspection', 'like', "%{$search}%");

        });
    }

    // Si ce n'est PAS un DT/Admin/DG
    if (!in_array($user->role, ['dt', 'admin', 'dg'])) {

        $query->where(
            'inspecteur_id',
            $user->id
        );
    }

    $inspections = $query->paginate(10)
                         ->withQueryString();

    return view(
    'inspections.index',
    compact(
        'inspections',
        'mois',
        'annee'
    )
);
}

    /**
     * Formulaire de création.
     */
    public function create()
    {
        /** @var \App\Models\User $user */
     $user = Auth::user();

     if (in_array($user->role, ['admin', 'dt'])) {

        $missions = Mission::latest()->get();

     } else {

        $missions = $user->missions()
            ->latest('missions.created_at')
            ->get();
     }

       return view('inspections.create', compact('missions'));
    }

    /**
     * Enregistrement.
     */
    public function store(Request $request)
{
    $validated = $request->validate([

        'mission_id' => ['required', 'exists:missions,id'],

        'type_inspection' => [
            'required',
            'in:preemballe,pesage,volume'
        ],

        'type_essai' => [
            'required',
            'in:verification_primitive,verification_periodique'
        ],

        'etablissement' => ['required', 'string', 'max:255'],
        'ifu' => ['nullable', 'string', 'max:30'],
        'adresse' => ['required', 'string'],
        'telephone' => ['nullable', 'string', 'max:50'],
        'date' => ['required', 'date'],
        'heure' => ['required'],
        'nom_proprietaire' => ['required', 'string', 'max:255'],
        'activite' => ['required', 'string'],
        'anomalies' => ['nullable', 'string'],
        'amendes' => ['nullable', 'string'],
        'commentaires' => ['nullable', 'string'],
    ]);

    $mission = Mission::findOrFail($validated['mission_id']);

    $inspection = Inspection::create([

        ...$validated,

        'inspecteur_id' => Auth::id(),
    ]);

    $derniereInspection = Inspection::where(
        'mission_id',
        $mission->id
    )
    ->whereNotNull('reference')
    ->orderByDesc('id')
    ->first();

$ordre = 1;

if ($derniereInspection) {

    preg_match(
        '/(\d+)$/',
        $derniereInspection->reference,
        $matches
    );

    if (isset($matches[1])) {
        $ordre = ((int) $matches[1]) + 1;
    }
}

$inspection->update([
    'reference' => sprintf(
        'INS-%s-%03d',
        $mission->reference,
        $ordre
    )
]);

    if (!empty($validated['amendes'])) {

    Amende::create([

        'inspection_id'       => $inspection->id,

        'etablissement'       => $inspection->etablissement,

        'ifu'                 => $inspection->ifu,

        'reference_inspection'=> $inspection->reference,

        'montant_total'       => $validated['amendes'],

        'montant_paye'        => 0,

        'montant_impaye'      => $validated['amendes'],
      ]);
    }

    return match ($inspection->type_inspection) {

        'preemballe' => redirect()->route(
            'inspections.preemballes.create',
            $inspection
        ),

        'pesage' => redirect()->route(
            'inspections.pesages.create',
            $inspection
        ),

        'volume' => redirect()->route(
            'inspections.volumes.create',
            $inspection
        ),

        default => redirect()->route('inspections.index')
    };
}

    /**
     * Détails.
     */
    public function show(Inspection $inspection)
    {
        $inspection->load([
            'mission',
            'inspecteur',
            'preemballe.emballagesVides',
            'preemballe.echantillons',
            'pesage',
            'volume.essais',
        ]);

        return view('inspections.show', compact('inspection'));
    }

    /**
     * Formulaire modification.
     */
    public function edit(Inspection $inspection)
    {
        $missions = Mission::all();

        return view(
            'inspections.edit',
            compact('inspection', 'missions')
        );
    }

    /**
     * Mise à jour.
     */
    public function update(
        Request $request,
        Inspection $inspection
    ) {
        $validated = $request->validate([

            'type_inspection' => [
                'required',
                'in:preemballe,pesage,volume'
            ],

            'type_essai' => [
                'required',
                'in:verification_primitive,verification_periodique'
            ],

            'etablissement' => ['required', 'string', 'max:255'],

            'adresse' => ['required', 'string'],

            'ifu' => ['nullable', 'string'],

            'telephone' => ['nullable', 'string'],

            'date' => ['required', 'date'],

            'heure' => ['required'],

            'nom_proprietaire' => [
                'required',
                'string',
                'max:255'
            ],

            'activite' => ['required', 'string'],

            'anomalies' => ['nullable', 'string'],

            'amendes' => ['nullable', 'string'],

            'commentaires' => ['nullable', 'string'],
        ]);

        $inspection->update($validated);

        return redirect()
            ->route('inspections.show', $inspection)
            ->with(
                'success',
                'Inspection modifiée avec succès.'
            );
    }

    /**
     * Suppression.
     */
    public function destroy(Inspection $inspection)
    {
        $inspection->delete();

        return redirect()
            ->route('inspections.index')
            ->with(
                'success',
                'Inspection supprimée avec succès.'
            );
    }

}
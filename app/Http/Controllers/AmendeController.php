<?php

namespace App\Http\Controllers;

use App\Models\Amende;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmendeController extends Controller
{
    /**
     * Liste des amendes regroupées par établissement.
     */
    public function index()
{
    $user = Auth::user();

    $query = Amende::query();


    // Recherche
    if (request()->filled('search')) {

        $search = request('search');

        $query->where(function ($q) use ($search) {

            $q->where('ifu', 'like', "%{$search}%")
              ->orWhere('etablissement', 'like', "%{$search}%");

        });
    }

    // Si ce n'est pas DT/Admin/DG
    if (!in_array($user->role, ['dt', 'admin', 'dg'])) {

        $query->whereHas('inspection', function ($q) use ($user) {

            $q->where(
                'inspecteur_id',
                $user->id
            );

        });
    }

    // Totaux

$mois = request('mois', now()->month);
$annee = request('annee', now()->year);

$query->whereYear('created_at', $annee)
      ->whereMonth('created_at', $mois);

$totalMois = (clone $query)->sum('montant_total');

$totalPayeMois = (clone $query)->sum('montant_paye');

// Liste des établissements
$amendes = $query
    ->selectRaw('
        ifu,
        MAX(etablissement) as etablissement,
        COUNT(*) as nombre_amendes,
        SUM(montant_total) as total_amendes,
        SUM(montant_paye) as total_paye,
        SUM(montant_impaye) as total_impaye
    ')
    ->groupBy('ifu')
    ->orderBy('ifu')
    ->paginate(10)
    ->appends(request()->query());

    return view(
    'amendes.index',
    compact(
        'amendes',
        'totalMois',
        'totalPayeMois',
        'mois',
        'annee'
    )
);
}

    /**
     * Détail des amendes d'un établissement.
     */
    public function show(string $ifu)
{
    $amendes = Amende::where('ifu', $ifu)
        ->latest()
        ->get();

    if ($amendes->isEmpty()) {
        abort(404);
    }

    return view(
        'amendes.show',
        [
            'ifu' => $ifu,
            'etablissement' => $amendes->first()->etablissement,
            'amendes' => $amendes
        ]
    );
}

    /**
     * Formulaire de modification.
     */
    public function edit(Amende $amende)
    {
        return view(
            'amendes.edit',
            compact('amende')
        );
    }

    /**
     * Mise à jour du montant payé.
     */
    public function update(
        Request $request,
        Amende $amende
    ) {
        $request->validate([
            'montant_paye' => [
                'required',
                'numeric',
                'min:0'
            ]
        ]);

        if ($request->montant_paye > $amende->montant_total) {
            return back()
                ->withErrors([
                    'montant_paye' =>
                    'Le montant payé ne peut pas dépasser le montant total.'
                ])
                ->withInput();
        }

        $amende->update([
            'montant_paye' => $request->montant_paye,
            'montant_impaye' =>
                $amende->montant_total
                - $request->montant_paye,
        ]);

        return redirect()
            ->route('amendes.index')
            ->with(
                'success',
                'Paiement mis à jour avec succès.'
            );
    }
}
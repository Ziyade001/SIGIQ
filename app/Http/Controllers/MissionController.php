<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Liste des missions.
     */
    public function index()
{
    $user = Auth::user();


    $query = Mission::with('participants')->latest();

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
              ->orWhere('categorie', 'like', "%{$search}%")
              ->orWhere('type_mission', 'like', "%{$search}%")
              ->orWhere('localites', 'like', "%{$search}%")
              ->orWhere('statut', 'like', "%{$search}%");

        });
    }

    // Si ce n'est pas DT, Admin ou DG
    if (!in_array($user->role, ['dt', 'admin', 'dg'])) {

        $query->whereHas('participants', function ($q) use ($user) {

            $q->where('users.id', $user->id);

        });
    }

    $missions = $query->paginate(10)
                      ->withQueryString();

    return view(
        'missions.index',
        compact('missions', 'mois',
        'annee')
    );
}

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $inspecteurs = User::where('role', 'inspecteur')
            ->orderBy('name')
            ->get();

        return view('missions.create', compact('inspecteurs'));
    }

    /**
     * Enregistrement d'une mission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'periode_debut' => ['required', 'date'],
            'periode_fin' => ['required', 'date', 'after_or_equal:periode_debut'],
            'categorie' => ['required', 'string', 'max:255'],
            'type_mission' => ['required', 'string', 'max:255'],
            'activites' => ['required', 'string'],
            'localites' => ['required', 'string'],
            'conducteur_cva' => ['required', 'string', 'max:255'],
            'vehicule' => ['required', 'string', 'max:255'],

            'participants' => ['required', 'array'],
            'participants.*' => ['exists:users,id'],

            'chef_equipe' => ['required', 'exists:users,id'],
        ]);

        $mission = Mission::create([
            'periode_debut' => $validated['periode_debut'],
            'periode_fin' => $validated['periode_fin'],
            'categorie' => $validated['categorie'],
            'type_mission' => $validated['type_mission'],
            'activites' => $validated['activites'],
            'localites' => $validated['localites'],
            'conducteur_cva' => $validated['conducteur_cva'],
            'vehicule' => $validated['vehicule'],

            'created_by' => Auth::id(),
        ]);

        $lastMission = Mission::latest('id')->first();

$numero = $lastMission
    ? $lastMission->id
    : 1;

$mission->reference = sprintf(
    'M-%03d-%s',
    $mission->id,
    now()->year
);

$mission->save();

        $participants = [];

        foreach ($validated['participants'] as $userId) {
            $participants[$userId] = [
                'chef_equipe' => $userId == $validated['chef_equipe'],
            ];
        }

        $mission->participants()->attach($participants);

        return redirect()
            ->route('missions.index')
            ->with('success', 'Mission créée avec succès.');
    }

    /**
     * Détails d'une mission.
     */
    public function show(Mission $mission)
    {
        $mission->load('participants');

        return view('missions.show', compact('mission'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit(Mission $mission)
    {
        $inspecteurs = User::where('role', 'inspecteur')
            ->orderBy('name')
            ->get();

        return view('missions.edit', compact(
            'mission',
            'inspecteurs'
        ));
    }

    /**
     * Mise à jour.
     */
    public function update(Request $request, Mission $mission)
    {
        $validated = $request->validate([
            'periode_debut' => ['required', 'date'],
            'periode_fin' => ['required', 'date', 'after_or_equal:periode_debut'],
            'categorie' => ['required', 'string', 'max:255'],
            'type_mission' => ['required', 'string', 'max:255'],
            'activites' => ['required', 'string'],
            'localites' => ['required', 'string'],
            'conducteur_cva' => ['required', 'string', 'max:255'],
            'vehicule' => ['required', 'string', 'max:255'],

            'participants' => ['required', 'array'],
            'participants.*' => ['exists:users,id'],

            'chef_equipe' => ['required', 'exists:users,id'],
        ]);

        $mission->update([
            'periode_debut' => $validated['periode_debut'],
            'periode_fin' => $validated['periode_fin'],
            'categorie' => $validated['categorie'],
            'type_mission' => $validated['type_mission'],
            'activites' => $validated['activites'],
            'localites' => $validated['localites'],
            'conducteur_cva' => $validated['conducteur_cva'],
            'vehicule' => $validated['vehicule'],
        ]);

        $participants = [];

        foreach ($validated['participants'] as $userId) {
            $participants[$userId] = [
                'chef_equipe' => $userId == $validated['chef_equipe'],
            ];
        }

        $mission->participants()->sync($participants);

        return redirect()
            ->route('missions.index')
            ->with('success', 'Mission modifiée avec succès.');
    }


    public function cloture(Mission $mission)
{
    if ($mission->statut === 'en_cours') {

        $mission->update([
            'statut' => 'terminee'
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'La mission a été clôturée avec succès.'
            );
    }

    return redirect()
        ->back()
        ->with(
            'error',
            'Cette mission ne peut pas être clôturée.'
        );
}


public function rapport(Mission $mission)
{
    $mission->load([
        'participants',
        'inspections'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Calculs automatiques
    |--------------------------------------------------------------------------
    */

    $nbBoutiquesNonConformes =
        $mission->inspections()
            ->distinct('ifu')
            ->count('ifu');

    $nbInstrumentsNonConformes =
        $mission->inspections()
            ->whereIn(
                'type_inspection',
                ['pesage', 'volume']
            )
            ->count();

    $nbPreemballesNonConformes =
        $mission->inspections()
            ->where(
                'type_inspection',
                'preemballe'
            )
            ->count();

    $nbAmendes =
        $mission->inspections()
            ->whereNotNull('amendes')
            ->count();

    $montantAmendes =
        $mission->inspections()
            ->sum('amendes');

    return view(
        'missions.rapport',
        compact(
            'mission',
            'nbBoutiquesNonConformes',
            'nbInstrumentsNonConformes',
            'nbPreemballesNonConformes',
            'nbAmendes',
            'montantAmendes'
        )
    );
}

    /**
     * Suppression.
     */
    public function destroy(Mission $mission)
    {
        $mission->delete();

        return redirect()
            ->route('missions.index')
            ->with('success', 'Mission supprimée avec succès.');
    }
}

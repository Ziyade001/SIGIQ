<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Liste des utilisateurs.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
            ->latest()
            ->paginate(10);

        return view(
            'users.index',
            compact('users')
        );
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Enregistrement.
     */
    public function store(Request $request)
{
    $validated = $request->validate([

        'name' => 'required|string|max:255',

        'email' => 'required|email|unique:users,email',

        'telephone' => 'nullable|string|max:50',

        'fonction' => 'nullable|string|max:255',

        'role' => 'required|in:admin,dg,dt,inspecteur',

        'sexe' => 'nullable|in:Homme,Femme',

        'date_naissance' => 'nullable|date',

        'adresse' => 'nullable|string',

        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'password' => 'required|string|min:8|confirmed',
    ]);

    // Génération automatique du matricule
    $lastId = (User::max('id') ?? 0) + 1;

    $matricule = 'ANM-' . str_pad(
        $lastId,
        4,
        '0',
        STR_PAD_LEFT
    );

    if ($request->hasFile('photo')) {

        $validated['photo'] = $request
            ->file('photo')
            ->store('users', 'public');
    }

    $validated['matricule'] = $matricule;

    $validated['password'] = Hash::make(
        $validated['password']
    );

    $validated['created_by'] = Auth::id();

    User::create($validated);

    return redirect()
        ->route('users.index')
        ->with(
            'success',
            'Utilisateur créé avec succès.'
        );
}

    /**
     * Détail utilisateur.
     */
    public function show(User $user)
    {
        return view(
            'users.show',
            compact('user')
        );
    }

    /**
     * Formulaire modification.
     */
    public function edit(User $user)
    {
        return view(
            'users.edit',
            compact('user')
        );
    }

    /**
     * Mise à jour.
     */
    public function update(Request $request, User $user)
{
    $validated = $request->validate([

        'name'             => 'required|string|max:255',

        'email'            => 'required|email|unique:users,email,' . $user->id,

        'telephone'        => 'nullable|string|max:50',

        'fonction'         => 'nullable|string|max:255',

        'sexe'             => 'nullable|in:Homme,Femme',

        'date_naissance'   => 'nullable|date',

        'adresse'          => 'nullable|string',

        'role'             => 'required|in:admin,dg,dt,inspecteur',

        'photo'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'password'         => 'nullable|confirmed|min:6',
    ]);

    if ($request->hasFile('photo')) {

        $validated['photo'] = $request
            ->file('photo')
            ->store('users', 'public');
    }

    if (!empty($validated['password'])) {

        $validated['password'] = bcrypt(
            $validated['password']
        );

    } else {

        unset($validated['password']);
    }

    $user->update($validated);

    return redirect()
        ->route('users.index')
        ->with(
            'success',
            'Utilisateur modifié avec succès.'
        );
}

public function resetPassword(User $user)
{
    // Empêcher de réinitialiser son propre mot de passe
    if ($user->id === Auth::id()) {

        return back()->with(
            'error',
            'Vous ne pouvez pas réinitialiser votre propre mot de passe.'
        );

    }

    // Génération d'un mot de passe sécurisé
    $password = 'ANM@' . Str::random(6);

    $user->update([

        'password' => Hash::make($password),
        'must_change_password' => true,

    ]);

    return redirect()
        ->route('users.index')
        ->with([
            'success' => 'Mot de passe réinitialisé avec succès.',
            'generated_password' => $password,
        ]);
}

    /**
     * Suppression.
     */
    public function destroy(User $user)
{
    if ($user->id === Auth::user()->id) {

        return redirect()
            ->route('users.index')
            ->with(
                'error',
                'Vous ne pouvez pas supprimer votre propre compte.'
            );
    }

    if ($user->photo) {

        Storage::disk('public')->delete($user->photo);
    }

    $user->delete();

    return redirect()
        ->route('users.index')
        ->with(
            'success',
            'Utilisateur supprimé avec succès.'
        );
}

}
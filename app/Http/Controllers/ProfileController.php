<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Affichage du profil.
     */
    public function show()
    {
        return view('profile.show', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Formulaire de modification.
     */
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Mise à jour du profil.
     */
    
    public function update(Request $request)
    {
        
        $user = Auth::user();

        if ($user->must_change_password) {

    return back()->with(
        'error',
        'Vous devez d\'abord modifier votre mot de passe avant de pouvoir modifier votre profil.'
    );

}

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                Rule::unique('users')
                    ->ignore($user->id)
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:30'
            ],

            'fonction' => [
                'nullable',
                'string',
                'max:255'
            ],

            'sexe' => [
                'nullable',
                Rule::in([
                    'Homme',
                    'Femme'
                ])
            ],

            'date_naissance' => [
                'nullable',
                'date'
            ],

            'adresse' => [
                'nullable',
                'string'
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            if (
                $user->photo &&
                Storage::disk('public')->exists($user->photo)
            ) {
                Storage::disk('public')->delete(
                    $user->photo
                );
            }

            $validated['photo'] = $request
                ->file('photo')
                ->store(
                    'users',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Réinitialisation vérification email
        |--------------------------------------------------------------------------
        */

        if ($validated['email'] !== $user->email) {

            $validated['email_verified_at'] = null;
        }

        $user = User::findOrFail(Auth::id());

        $user->update($validated);

        return redirect()
            ->route('profile.show')
            ->with(
                'success',
                'Profil mis à jour avec succès.'
            );
    }

    /**
     * Modification du mot de passe.
     */
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => [
            'required'
        ],
        'password' => [
            'required',
            'confirmed',
            'min:8'
        ]
    ]);

    $user = Auth::user();

    if (! Hash::check(
        $request->current_password,
        $user->password
    )) {

        return back()->withErrors([
            'current_password' =>
            'Mot de passe actuel incorrect.'
        ]);
    }
    
    $user = User::findOrFail(Auth::id());

$user->update([
    'password' => Hash::make($request->password),
    'must_change_password' => false,
]);
    return back()->with(
        'success',
        'Mot de passe modifié avec succès.'
    );
}

    /**
     * Suppression de la photo.
     */
    public function removePhoto()
    {
        $user = Auth::user();

        if (
            $user->photo &&
            Storage::disk('public')->exists($user->photo)
        ) {
            Storage::disk('public')->delete(
                $user->photo
            );
        }
        
        $user = User::findOrFail(Auth::id());
        $user->update([
            'photo' => null
        ]);

        return back()->with(
            'success',
            'Photo supprimée avec succès.'
        );
    }
}
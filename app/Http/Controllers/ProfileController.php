<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Retourne la vue avec l'utilisateur connecté
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Met à jour les données de l'utilisateur
        $request->user()->fill($request->validated());

        // Si l'email a été modifié, on réinitialise la date de vérification
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Sauvegarde les données
        $request->user()->save();

        // Redirige vers la page de modification du profil avec un message de succès
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Vérifie que le mot de passe est correct
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Récupère l'utilisateur connecté
        $user = $request->user();

        // Déconnecte l'utilisateur
        Auth::logout();

        // Supprime l'utilisateur
        $user->delete();

        // Réinitialise la session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirige vers la page d'accueil
        return Redirect::to('/');
    }
}

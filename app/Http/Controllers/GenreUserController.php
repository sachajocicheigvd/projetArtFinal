<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GenreUserController extends Controller
{
 public function saveGenre(Request $request)
    {

        $user = $request->user();
        $genres = $request->input('genres');

        // efface toute les lignes avant de les recréer
        $user->genres()->detach();

        if ($genres == null) {
            return "Compte créé avec succès sans genres";
        }

        foreach ($genres as $genreId) {
            $user->genres()->attach($genreId, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return 'Compte créé avec succès et vos genres ont été enregistrés';
    }   
}

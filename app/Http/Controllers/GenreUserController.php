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
            return "Vous n'avez pas choisi de genre, on prend note de votre choix";
        }

        foreach ($genres as $genreId) {
            $user->genres()->attach($genreId, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return 'Test si cela a bien fonctionné $request->genre_id : ' . $genreId . ' $user->id : ' . $user->id;
    }   
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class GenreUserController extends Controller
{

    public function showForm()
    {
        return view('registerbis')->with('genres', Genre::all())->with('user', Auth::user());
    }

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
        return redirect()->route('accueil');
    }   
}

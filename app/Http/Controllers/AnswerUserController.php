<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswerUserController extends Controller
{
    public function saveAnswer(Request $request)
    {

        // $user = $request->user();
        // $genres = $request->input('genres');

        // // efface toute les lignes avant de les recréer
        // $user->genres()->detach();

        // if ($genres == null) {
        //     return "Vous n'avez pas choisi de genre, on prend note de votre choix";
        // }

        // foreach ($genres as $genreId) {
        //     $user->genres()->attach($genreId, [
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
        // return 'Test si cela a bien fonctionné $request->genre_id : ' . $genreId . ' $user->id : ' . $user->id;

        return "Bonjour";
    }   
}

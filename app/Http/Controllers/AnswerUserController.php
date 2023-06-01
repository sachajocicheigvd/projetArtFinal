<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerUserController extends Controller
{
    public function saveAnswer(Request $request)
    {

        /*
         * Récupérer les données du formulaire 
         * Enregistrer dans la table answers
         * Enregistrer dans la table answer_user
         * Enregistrer dans la table survey
         * */

        $user = Auth::user()->id;

        $answers = $request->input('answers');

        // efface toute les lignes avant de les recréer
        $user->answers()->detach();

        if ($answers == null) {
            return "Vous n'avez pas choisi de genre, on prend note de votre choix";
        }

        foreach ($answers as $answerId) {
            $user->answers()->attach($answerId, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        // return 'Test si cela a bien fonctionné $request->genre_id : ' . $genreId . ' $user->id : ' . $user->id;

        return "Votre choix a bien été enregistré";
    }   
}

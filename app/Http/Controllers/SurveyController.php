<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function saveSurvey(Request $request)
    {

        /*
         * Récupérer les données du formulaire 
         * Enregistrer dans la table answers
         * Enregistrer dans la table answer_user
         * Enregistrer dans la table survey
         * */

         $user = Auth::user();

        $duration = $request->input('duration');

        $type = $request->input('type') ?: 'text' ;

        $title = $request->input('title');

        $answers = $request->input('answers');

        // $answers->validate([
        //     'title' => ['required', 'text', 'max:255'],
        // ]);

        $picture = '';

        Survey::create([
            'user_id' => $user->id,
            'title' => $title,
            'type' => $type,
            'duration' => $duration,
            'picture' => $picture,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Récupère le dernier id de la table survey pour l'insérer dans la table answer pour survey_id
        $result = DB::table('surveys')->orderBy('id', 'desc')->first();
        $lastId = $result->id;

        foreach ($answers as $answer) {
            Answer::create([
                'survey_id' => $lastId,
                'answer' => $answer,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

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

        // Return des variable actuelles
        return "$duration <br> $type <br> $title";
    }   
}

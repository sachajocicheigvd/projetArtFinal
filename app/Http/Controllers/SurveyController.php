<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyRequest;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\Storage;

class SurveyController extends Controller
{
    public function saveSurvey(SurveyRequest $request)
    {

        /*
         * Récupérer les données du formulaire 
         * Enregistrer dans la table answers
         * Enregistrer dans la table answer_user
         * Enregistrer dans la table survey
         * */

         $user = Auth::user();

        $duration = $request->input('duration');

        $type = $request->input('type');

        $title = $request->input('title');

        $answers = $request->input('answers');

        $artists = $request->input('artists');

        // $answers->validate([
        //     'title' => ['required', 'text', 'max:255'],
        // ]);

        $pictures = $request->input('files');

        // Enregistre la photo comme un lien dans la BD

        $pictures = $request->file('files')->store('public/images');


/* vieille méthode ChatGPT, Laravel propose une fonction addMinutes() qui fait la même chose
$delai = new DateTime(); // Obtenir la date et l'heure actuelles
$delai->add(new DateInterval('PT' . $duration . 'M')); // Ajouter la durée spécifiée en minutes
$delai->format('Y-m-d H:i:s'); // Afficher la date modifiée
*/


        Survey::create([
            'user_id' => $user->id,
            'title' => $title,
            'type' => $type,
            'duration' => now()->addMinutes($duration),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Récupère le dernier id de la table survey pour l'insérer dans la table answer pour survey_id
        $result = DB::table('surveys')->orderBy('id', 'desc')->first();
        $lastId = $result->id;

        for($i = 1; $i <= count($answers); $i++) {
            Answer::create([
                'survey_id' => $lastId,
                'answer' => $answers[$i-1],
                'artist' => $artists[$i-1],
                'picture' => $pictures,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // foreach ($answers as $answer) {
        //     Answer::create([
        //         'survey_id' => $lastId,
        //         'answer' => $answer,
        //         'artist' => $artist,
        //         'picture' => $picture,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

        // Return des variable actuelles
        // return "$duration <br> $type <br> $title";
        return $pictures;
    }   
}

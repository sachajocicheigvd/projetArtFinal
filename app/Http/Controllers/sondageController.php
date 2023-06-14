<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Survey;

//use App\Models\Answer_User;

class sondageController extends Controller
{
    public function afficheSondage()
    {
        // Récupération des sondages et des réponses
        $surveys = Survey::all();
        $answers = Answer::all();

        // Récupération du dernier sondage
        $latestSurvey = Survey::latest()->first();

        // Récupération des réponses du dernier sondage
        $answerUserCount = $latestSurvey->answers()->sum('id');

        return redirect()->route('stats', compact('surveys', 'answers','answerUserCount'));    }

        public function refreshSondage()
        {
            // Récupération du dernier sondage
            $latestSurvey = Survey::latest()->first();

            // Récupération des réponses du dernier sondage
            $answers = $latestSurvey->answers()->with('users')->get();

            // Calcul du nombre total de votes
            $totalResponses = $answers->sum('users_count');
    
            // Enregistrement pour le calcul du pourcentage de chaque réponse dans la vue correspondante
            $results = $answers->map(function ($answer) use ($totalResponses) {
                return [
                    'users_count' => $answer->users_count,
                    'total_responses' => $totalResponses,
                ];
            });
    
            return response()->json($results);
        }
}

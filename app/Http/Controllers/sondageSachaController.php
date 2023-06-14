<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Survey;
use Illuminate\Http\Request;

class sondageSachaController extends Controller
{
    public function afficheSondage()
    {
        // $surveys = Survey::all();
        // $answers = Answer::all();

        // Récupération du dernier sondage
        $latestSurvey = Survey::latest()->first();

        // Récupération des réponses du dernier sondage
        $answerUserCount = $latestSurvey->answers()->sum('id');

        // Redirection vers la page des stats si l'utilisateur a déjà répondu au sondage
        return redirect()->route('stats')->with(compact('surveys', 'answers','answerUserCount'));
    
    }

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
    
            return response()->json($results);    }
}
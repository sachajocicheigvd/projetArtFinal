<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Models\Answer;


class controlleurApi extends Controller
{
    public function getSurveyResults(Request $request)
    {
        // Récupèration du dernier sondage
        $latestSurvey = Survey::latest()->first();

        // Récupèration des réponses du dernier sondage
        $answers = $latestSurvey->answers()->with('users')->get();

        // Calcul du nombre total de votes
        $totalVotes = $answers->sum('users_count');

        $data = [
            'answers' => $answers,
            'totalVotes' => $totalVotes
        ];

        return response()->json($data);
    }
}

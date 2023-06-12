<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyControllerSacha extends Controller
{
    public function getSurveyResults()
    {
        // Récupérer le dernier sondage
        $latestSurvey = Survey::latest()->first();

        // Récupérer les réponses du sondage avec le nombre total de votes pour chaque réponse
        $surveyResults = $latestSurvey->answers()->withCount('users')->get();

        // Formater les données pour la réponse de l'API
        $responseData = [];
        foreach ($surveyResults as $result) {
            $responseData[] = [
                'answer' => $result->answer,
                'artist' => $result->artist,
                'totalVotes' => $result->users_count,
                'image' => $result->picture,
            ];
        }

        // Retourner les résultats du sondage en tant que réponse JSON
        return response()->json($responseData);
    }
}

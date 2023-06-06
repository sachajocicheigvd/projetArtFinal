<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Survey;
use Illuminate\Http\Request;

class sondageSachaController extends Controller
{
    public function afficheSondage()
    {
        $surveys = Survey::all();
        $answers = Answer::all();

        $latestSurvey = Survey::latest()->first();
        $answerUserCount = $latestSurvey->answers()->sum('id');

        
        //$answer_users = Answer_User::all();
        return view('sondageSacha', compact('surveys', 'answers','answerUserCount'));    }

        public function refreshSondage()
        {
            $latestSurvey = Survey::latest()->first();
            $answers = $latestSurvey->answers()->with('users')->get();
            $totalResponses = $answers->sum('users_count');
    
            $results = $answers->map(function ($answer) use ($totalResponses) {
                return [
                    'users_count' => $answer->users_count,
                    'total_responses' => $totalResponses,
                ];
            });
    
            return response()->json($results);    }
}

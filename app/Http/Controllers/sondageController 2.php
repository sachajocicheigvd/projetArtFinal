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
        $surveys = Survey::all();
        $answers = Answer::all();

        $latestSurvey = Survey::latest()->first();
        $answerUserCount = $latestSurvey->answers()->sum('id');

        
        //$answer_users = Answer_User::all();
        return view('sondage', compact('surveys', 'answers','answerUserCount'));    }

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
    
            return response()->json($results);
        }
}

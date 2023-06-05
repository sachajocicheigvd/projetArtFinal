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
}

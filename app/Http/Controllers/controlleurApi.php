<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Models\Answer;


class controlleurApi extends Controller
{
    public function getSurveyResults(Request $request)
    {
        $latestSurvey = Survey::latest()->first();
        $answers = $latestSurvey->answers()->with('users')->get();
        $totalVotes = $answers->sum('users_count');

        $data = [
            'answers' => $answers,
            'totalVotes' => $totalVotes
        ];

        return response()->json($data);
    }
}

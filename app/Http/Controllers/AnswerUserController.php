<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnswerUserController extends Controller

{
    public function showForm()
    {

        // Récupère le dernier id de la table survey pour l'insérer dans la table answer pour survey_id
        $dernierSondage = DB::table('surveys')->orderBy('id', 'desc')->first();
        $sondageId = $dernierSondage->id;

        // Récupère les réponses du dernier sondage
        $reponses = DB::table('answers')->where('survey_id', $sondageId)->get();

        $reponseTab = [];

        // Met les réponses dans un tableau
        foreach ($reponses as $reponse) {
            $reponseTab[] = $reponse;
        }

        // Récupère le délai du dernier sondage
        $delai = $dernierSondage->duration;

        // Convertir la date actuelle en timestamp
        $nowTimestamp = now()->timestamp;

        // Convertir le délai en timestamp
        $delaiTimestamp = strtotime($delai);

        // Vérifier si la date actuelle est supérieure au délai
        if ($nowTimestamp > $delaiTimestamp) {
            $delai = 0;
        }

        // Si l'utilisateur a déjà répondu au dernier sondage, on le redirige vers la page des stats
        $user = Auth::user();

        $userAnswers = $user->answers()->where('survey_id', $sondageId)->get();

        $dejaRepondu = false;

        if($userAnswers->count() > 0) {
            $dejaRepondu = true;
        }

        // Si le délai est inférieur ou égal à 0 ou si l'utilisateur a déjà répondu au sondage ou si le sondage est de type text, on le redirige vers la page des stats
        if($delai <= 0 || $dejaRepondu || $dernierSondage->type == "text"){
            return redirect()->route('stats');
        }

        // affiches toute les questions
        return view('vote')->with('question', $dernierSondage->title)->with('duree', $delai)
            ->with('reponses', $reponseTab);
        // }
    }

    public function storevote(Request $request)
    {
        // Récupérez les données du vote à partir de la requête
        $answerid = $request->input('answer');

        $user = Auth::user();

        // Enregistrer les données dans la table answer_user
        DB::table('answer_user')->insert([
            'answer_id' => $answerid,
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Répondez avec la confirmation du vote ou toute autre donnée nécessaire (plus utilisé)
        return response()->json(['message' => 'Vote enregistré avec succès']);
    }
    
    public function saveAnswer(Request $request)
    {

        $user = Auth::user();

        // Récupère les données du formulaire
        $answers = $request->input('answers');

        // Enregistrer dans la table answer_user
        // intvval sert à convertir en int (afin de régler un bug)
        foreach ($answers as $answerId) {
            $user->answers()->attach(intval($answerId), [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('stats');
    }  
}
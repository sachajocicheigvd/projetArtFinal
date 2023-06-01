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

        $reponses = DB::table('answers')->where('survey_id', $sondageId)->get();

        $reponseTab = [];

        foreach ($reponses as $reponse) {
            $reponseTab[] = $reponse;
        }

        // affiches toute les questions
        return view('vote')->with('question', $dernierSondage->title)->with('duree', $dernierSondage->duration)
            ->with('reponses', $reponseTab);
    }
    
    public function saveAnswer(Request $request)
    {

        /*
         * Récupérer les données du formulaire 
         * Enregistrer dans la table answers
         * Enregistrer dans la table answer_user
         * Enregistrer dans la table survey
         * */

        $user = Auth::user();

        $answers = $request->input('answers');

        // efface toute les lignes avant de les recréer
        // $user->answers()->detach();

        if ($answers == null) {
            return "Vous n'avez pas choisi de genre, on prend note de votre choix";
        }

        $var = 0;
        // intvval sert à convertir en int
        foreach ($answers as $answerId) {
            $user->answers()->attach(intval($answerId), [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return "Votre vote a bien été pris en compte";
    }   
}

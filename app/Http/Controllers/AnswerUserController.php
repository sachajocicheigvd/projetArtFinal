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
        if(Auth::check()==false){
            // return view('vote');
            $lienExterne = "Vous devez être connecté pour accéder au vote";
            return redirect()->route('login')->with('lienExterne', $lienExterne);
        }
        else{
        $dernierSondage = DB::table('surveys')->orderBy('id', 'desc')->first();
        $sondageId = $dernierSondage->id;

        $reponses = DB::table('answers')->where('survey_id', $sondageId)->get();

        $reponseTab = [];

        foreach ($reponses as $reponse) {
            $reponseTab[] = $reponse;
        }

        $delai = $dernierSondage->duration;


        /*
        BONUS - Vérification du délai du sondage pour ne pas l'afficher
        si jamais il est dépassé par rapport à l'heure actuelle
        au moment du chargement de la page et que l'utilisateur
        a désactivé JavaScript.
        */


        // Convertir la date actuelle en timestamp
        $nowTimestamp = now()->timestamp;

        // Convertir le délai en timestamp
        $delaiTimestamp = strtotime($delai);

        // Vérifier si la date actuelle est supérieure au délai
        if ($nowTimestamp > $delaiTimestamp) {
            $delai = 0;
        }

        // Si l'utilisateur a déjà répondu au dernier sondage, la variable délai sera a 0
        // et le sondage ne s'affichera plus
        $user = Auth::user();
        $userAnswers = $user->answers()->where('survey_id', $sondageId)->get();
        if($userAnswers->count() > 0) {
            $delai = 0;
        }

        //
        // FIN BONUS
        //

        // affiches toute les questions
        return view('vote')->with('question', $dernierSondage->title)->with('duree', $delai)
            ->with('reponses', $reponseTab);
        }
    }

    public function storevote(Request $request)
    {
        // Récupérez les données du vote à partir de la requête
        $answerid = $request->input('answer');

        $user = Auth::user();

        //store answerid and user id to answer_user table
        DB::table('answer_user')->insert([
            'answer_id' => $answerid,
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Répondez avec la confirmation du vote ou toute autre donnée nécessaire
        return response()->json(['message' => 'Vote enregistré avec succès']);
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

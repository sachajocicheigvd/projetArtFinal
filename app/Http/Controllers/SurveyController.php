<?php

namespace App\Http\Controllers;

use App\Events\ChatPopup;
use App\Http\Requests\SurveyRequest;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\Storage;
use App\Events\PopupEvent;

class SurveyController extends Controller
{

    public function showForm()
    {
        return view('creationsondage')->with('user', Auth::user());
    }


    public function storevote(Request $request)
    {
        // Récupérez les données du vote à partir de la requête
        $answerid = $request->input('answer');

        // Récupérez l'utilisateur connecté
        $user = Auth::user();

        //Enregistrez le vote dans la table answer_user sans la méthode attach()
        DB::table('answer_user')->insert([
            'answer_id' => $answerid,
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Réponse JSON (plus utilisé actuellement)
        return response()->json(['message' => 'Vote enregistré avec succès']);
    }
    public function saveSurvey(SurveyRequest $request)
    {

        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Récupère les données du formulaire
        $duration = $request->input('duration');
        $type = $request->input('type');
        $title = $request->input('title');
        $answers = $request->input('answers');
        $artists = $request->input('artists');

        // Enregistre la photo comme un lien dans la BD

        // Obligé de mettre un if contrairement à l'input artist
        if ($request->hasFile('files')) {
            $pictures = [];

            // Boucle sur chaque fichier pour les stocker dans le dossier public/images
            foreach ($request->file('files') as $file) {
                $path = $file->storePublicly('public/images');
                $pictures[] = Storage::url($path);
            }
        }

        // Enregistre le sondage dans la table survey
        Survey::create([
            'user_id' => $user->id,
            'title' => $title,
            'type' => $type,
            // Méthode addMinutes() pour ajouter la durée du sondage à l'heure actuelle
            'duration' => now()->addMinutes($duration),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Récupère le dernier id de la table survey pour l'insérer dans la table answer pour survey_id
        $result = DB::table('surveys')->orderBy('id', 'desc')->first();
        $lastId = $result->id;

        // Enregistre les réponses dans la table answer si le sondage est de type music
        if ($type == "music") {
            for ($i = 0; $i < count($answers); $i++) {
                Answer::create([
                    'survey_id' => $lastId,
                    'answer' => $answers[$i],
                    'artist' => $artists[$i],
                    'picture' => $pictures[$i],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Enregistre les réponses dans la table answer si le sondage est de type text
        if ($type == "text") {
            foreach ($answers as $answer) {
                Answer::create([
                    'survey_id' => $lastId,
                    'answer' => $answer,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Créer un événement pour afficher un popup de vote sur tout le site et la progression du dernier sondage sur le chat
        // pour les utilisateurs connectés uniquement si le sondage est de type text
        if ($type == "text") {
            event(new PopupEvent("nouveau sondage"));
            event(new ChatPopup("CHATPOPUP"));
        }

        // Redirection vers la page des stats vu que l'animateur n'a pas besoin de voter
        return redirect()->route('stats');
    }
    // create function to return the last survey
    public function lastSurvey()
    {
        // Récupère le dernier sondage
        $lastSurvey = DB::table('surveys')->orderBy('id', 'desc')->first();

        // Récupère l'id du dernier sondage
        $lastSurveyId = $lastSurvey->id;

        // Récupère les réponses du dernier sondage
        $lastSurveyAnswers = DB::table('answers')->where('survey_id', $lastSurveyId)->get();

        // Récupère le nombre total de votes du dernier sondagedg le mets dans l'objet $lastSurvey
        $lastSurvey->answers = $lastSurveyAnswers;

        // Envoie le dernier sondage en JSON pour utiliser les données plus loin
        return response()->json($lastSurvey);
    }
}

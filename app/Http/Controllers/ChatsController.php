<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Models\Message as MessageModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\ChatPopup;
use App\Models\Genre;


class ChatsController extends Controller
{

    public function enregistrement(Request $request)
    {
        // Creation d'un message et attribution des valeurs
        $message = new MessageModel();
        $message->content = $request->input('message');
        $message->user_id = Auth::user()->id;

        //les genres du $message->user->genres
        // $message->genres = Auth::user()->genres;

        // $message->username = Auth::user()->username;
        //get the user username


        $message->save();
        $pseudo = Auth::user()->username;

        //add pseudo to the message
        event(new Message($request->username, $request->message, $pseudo),);

        return ['success' => true];
    }


    public function afficheMessage()
    {

        // User connecté
        $users = Auth::user();

        // Récupération des messages
        $messages = MessageModel::with('user')->get();

        // Affichage de la vue
        return view('chat', compact('messages'), compact('users'))->with('genres', Genre::all())->with('user', Auth::user());
    }
}

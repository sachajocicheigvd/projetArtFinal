<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Models\Message as MessageModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ChatsController extends Controller
{

    public function enregistrement(Request $request)
    {
        $message = new MessageModel();
        $message->content = $request->input('message');
        $message->user_id = Auth::user()->id;

        $message->save();

        event(new Message($request->username, $request->message));



        return ['success' => true];
    }


    public function afficheMessage()
    {


    if (Auth::check() == false) {
        $lienExterne = "Vous devez être connecté pour accéder au chat";
        return redirect()->route('login')->with('lienExterne', $lienExterne);
    } else {
        $messages = MessageModel::with('user')->get();
        $genres = Auth::user()->genres;
        return view('chat', compact('messages', 'genres'));
    
}

        }
    }
// }

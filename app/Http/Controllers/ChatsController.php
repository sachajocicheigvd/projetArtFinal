<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Models\Message as MessageModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\ChatPopup;


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

        // // $messages = MessageModel::with('user')->get();
        // // return view('chat', compact('messages'));
        // if (Auth::check() == false) {
        //     // return view('vote');
        //     $lienExterne = "Vous devez être connecté pour accéder au chat";
        //     return redirect()->route('login')->with('lienExterne', $lienExterne);
        // } else {
        // avec les genres lié à l'utilisateur


<<<<<<< HEAD
            $messages = MessageModel::with('user')->get();
 
            $genres = User::find(Auth::user()->id)->genres()->pluck('name')->toArray();



            return view('chat', compact('messages', 'genres'));
        }
=======
        $messages = MessageModel::with('user')->get();


        return view('chat', compact('messages'));
>>>>>>> d2346febb5329390a5fd91c940c39ca8800441ee
    }
}
// }

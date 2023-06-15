<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Genre;
use App\Http\Requests\UpdateProfile;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct()
    // {
    //     // $this->middleware('auth', ['except'=>'index']);

    //     // Seul les admins peuvent voir la liste des utilisateurs
    //     // $this->middleware('admin', ['only' => 'index']);

    //     // Seul les utilisateurs authentifiés peuvent voir la liste des utilisateurs
    //     $this->middleware('auth', ['only' => 'index']);
    // }
    public function index()
    {
        // Récupération de l'utilisateur connecté
        $users = Auth::user();

        return view('moncompte', compact('users'))->with('genres', Genre::all())->with('user', Auth::user())->with('messageModification', null);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfile $request)
    {
        // Récupération de l'utilisateur connecté
        $user = User::find(Auth::user()->id);

        // Récupération des données du formulaire
        $email = $request->input('email');
        $password = $request->input('password');
        $genres = $request->input('genres');

        // Si l'email a été modifié avec le même email, on rafraichit la page avec un message sinon on continue
        if($email != null){
            if($email == Auth::user()->email) {
                return view('moncompte')->with('messageModification', "Email inchangé")->with('users', Auth::user())->with('genres', Genre::all())->with('user', Auth::user());
            } else {
                $user = User::find(Auth::user()->id);
                $user->email = $email;
                $user->save();
            }
        }
        
        // On vérifie que le mot de passe n'est pas vide et on le modifie
        if($password != null){
            $user = User::find(Auth::user()->id);
            $user->password = $password;
            $user->save();
        }

        // On supprime les genres de l'utilisateur et on les ajoute
        $user->genres()->detach();
        if($genres != null){
            foreach ($genres as $genreId) {
                $user->genres()->attach($genreId, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        $messageModification = "Vos modifications ont bien été prises en compte.";

        return view('moncompte')->with('messageModification', $messageModification)->with('users', Auth::user())->with('genres', Genre::all())->with('user', Auth::user());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

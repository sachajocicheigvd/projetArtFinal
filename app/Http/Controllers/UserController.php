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
        $users = Auth::user();   // permet de voir quatre utilisateurs à la fois

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
        $user = User::find(Auth::user()->id);
        $email = $request->input('email');
        $password = $request->input('password');
        $genres = $request->input('genres');

        if($email != null){
            if($email == Auth::user()->email) {
                return "email inchangé";
            } else {
                $user = User::find(Auth::user()->id);
                $user->email = $email;
                $user->save();
            }
        }
        
        if($password != null){
            $user = User::find(Auth::user()->id);
            $user->password = $password;
            $user->save();
        }

        $user->genres()->detach();

        foreach ($genres as $genreId) {
            $user->genres()->attach($genreId, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
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

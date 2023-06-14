<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateAdminRequest;

class CreateAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function store(CreateAdminRequest $request)
    {
        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'username' => $request->username,
            'role_id' => 2,
            'password' => Hash::make($request->password),
        ]);

        $user = $request->username;
        $messageValidation = "L'administrateur $user a été créé";

        return redirect()->route('accueil')->with('messageValidation', $messageValidation);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

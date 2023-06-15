@extends('template')

@section('title')
<title>Crée Admin</title>
@endsection

@section('header')
<h1 class="page-header">Crée Admin</h1>
@endsection

@section('contenu')
    <form method="POST" action="{{ route('createadmin') }}">
        @csrf
        <div>
            <x-text-input id="last_name" class="secondaire creeadmin premierInput" type="text" name="last_name" :value="old('last_name')" placeholder="Nom de Famille" required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- first_name -->
        <div>
            <x-text-input id="first_name" class="secondaire creeadmin" type="text" name="first_name" :value="old('first_name')" placeholder="Prénom" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-text-input id="email" class="secondaire creeadmin" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- first_name -->
        <div>
            <x-text-input id="username" class="secondaire creeadmin" type="text" name="username" :value="old('username')" placeholder="Username" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">

            <x-text-input id="password" class="secondaire creeadmin"
                            type="password"
                            name="password"
                            placeholder="Mot de passe"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">

            <x-text-input id="password_confirmation" class="secondaire creeadmin"
                            type="password"
                            name="password_confirmation" 
                            placeholder="Confirmer mot de passe"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="primaire">
                Créer compte admin
            </x-primary-button>
        </div>
    </form>
@endsection
 
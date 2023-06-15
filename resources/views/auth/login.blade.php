@extends('template')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head>

@section('contenu')
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>

                <!--icon retour-->
                <a href="{{ route('loginChoice')}}">
                <svg class="iconRetour" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M20.25 12a.75.75 0 01-.75.75H6.31l5.47 5.47a.75.75 0 11-1.06 1.06l-6.75-6.75a.75.75 0 010-1.06l6.75-6.75a.75.75 0 111.06 1.06l-5.47 5.47H19.5a.75.75 0 01.75.75z" clip-rule="evenodd" />
                </svg>
                </a>


                <!--logo-->
                <div id="pageMilieu">
                    <img src="{{ asset('/images/logoCouleur3.svg') }}" style="width: 95px; 
    height: 147px" alt="logoCouleur3" class="logoCouleur3">


                    <!-- pseudo -->
                    <div>
                        <x-text-input id="username" class="block mt-1 w-full input-box" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="Pseudo" />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="mt-4">

                        <x-text-input id="password" class="block mt-1 w-full input-box" type="password" name="password" required autocomplete="current-password" placeholder="Mot de passe" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Mot de passe oublié -->

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                        <!-- suppression du lien mot de passe oublié étant donné que nous avons pas mis en place un service d'emailing-->
                     <!--   <a class="lien" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a> -->
                        @endif
                        <br>
                        <br>

                        <x-primary-button class="button-action">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
        </form>
        <br>

        <br>
                </div>   
             </div>

@endsection
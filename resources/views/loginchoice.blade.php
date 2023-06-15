@extends('template')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head>

@section('title')

<script src="{{ asset('public/js/sondage.js') }}"></script>
@endsection

@section('contenu')
      <!--bouton retour--><a href="{{ url('/') }}">
                <svg class="iconRetour" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M20.25 12a.75.75 0 01-.75.75H6.31l5.47 5.47a.75.75 0 11-1.06 1.06l-6.75-6.75a.75.75 0 010-1.06l6.75-6.75a.75.75 0 111.06 1.06l-5.47 5.47H19.5a.75.75 0 01.75.75z" clip-rule="evenodd" />
                </svg>
                </a>


<!--logo--> 
<div class="containerCreerConnecter">
 
  <img src="{{ asset('storage/images/logoCouleur3.svg') }}" style="width: 95px; 
    height: 147px" alt="logoCouleur3" class="logoCouleur3">

<!--boutons--> 
<a href="{{ url('login') }}">
<button class="secondaire buttonSecondairePageLoginChoice">
        Se connecter 
</button>
</a>

<a href="{{ route('register') }}">
<button class="secondaire buttonSecondairePageLoginChoice">
    Créer un compte 
</button>
</a>
</div>
    
@endsection
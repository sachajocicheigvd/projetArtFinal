@extends('template')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head>

@section('title')
@vite('resources/js/sondage.js')
@endsection

@section('header')

@endsection

@section('contenu')
<!--logo--> 
<div class="containerCreerConnecter">
 
  <img src="{{ asset('storage/images/logoCouleur3.svg') }}" style="width: 95px; 
    height: 147px" alt="logoCouleur3" class="logoCouleur3">

<!--boutons--> 
<button class="secondaire">
    <a href="{{ url('login') }}">
        Se connecter 
    </a>
</button>

<button class="secondaire">
    <a href="{{ route('register') }}">
    Créer un compte 
    </a>
</button>
</div>
    
@endsection
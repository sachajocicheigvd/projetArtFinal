@extends('template')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head>

@section('title')

<script src="{{ asset('public/js/sondage.js') }}"></script>
@endsection

@section('header')

@endsection

@section('contenu')
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
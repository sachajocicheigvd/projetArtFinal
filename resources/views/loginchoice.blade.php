

@extends('template')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
</head>

@section('title')
<title>Création sondage</title>
@vite('resources/js/sondage.js')
@endsection

@section('header')
<h1 class="page-header"><a href="">Création sondage</a></h1>
@endsection

@section('contenu')

<a href="{{ url('login') }}"><x-secondary-button class="ml-3">
    Se connecter 
    </x-secondary-button></a><br>
    <a href="{{ route('register') }}"><x-secondary-button class="ml-3">
        Créer un compte
    </x-secondary-button></a>
    
@endsection

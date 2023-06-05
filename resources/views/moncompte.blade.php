@extends('template')


@section('title')
<title>Mon compte</title>
@endsection

@section('header')
<h1 class="page-header"><a href="">Mon compte</a></h1>
@endsection

@section('contenu')
        <example-component :x={{$users}}>Ceci est un essai</example-component>

        <p>Bonjour {{ $users->first_name }} {{ $users->last_name }}, vous avez l'id numéro {{ $users->id }} et votre pseudo est {{ $users->username }}.
        </p>
    
@endsection


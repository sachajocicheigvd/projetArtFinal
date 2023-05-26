@extends('template')


@section('title')
<title>Mon Compte</title>
@endsection

@section('header')
<h1 class="page-header"><a href="">Mon compte</a></h1>
@endsection

@section('contenu')
        <example-component :x={{$users}}>Ceci est un essai</example-component>

        @foreach ($users as $user)
        <p>Bonjour {{ $user->first_name }} {{ $user->last_name }}, vous avez l'id numéro {{ $user->id }}.
        </p>
    @endforeach
@endsection


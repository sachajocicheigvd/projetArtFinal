

@extends('template')

@section('title')
<title>Accueil</title>
@endsection

@section('header')
<h1 class="page-header"><a href="">Accueil</a></h1>
<a href="createadmin"><button class="primaire">Créer Admin</button></a>
@if ($messageValidation)
                <div class="alert alert-modification">
                        {{ $messageValidation }}
                </div>
@endif
@endsection

@section('contenu')
        <p>Vous êtes à l'accueil du site</p>
        <button type="button" class="btn btnjorane">Primary</button>

@endsection
 
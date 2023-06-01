@extends('template')


@section('title')
<title>Création sondage</title>

@vite('resources/js/sondage.js')
@endsection

@section('header')
<h1 class="page-header"><a href="">Création sondage</a></h1>
@endsection

@section('contenu')


<h1>Création d'un sondage</h1>

<form method="post" action="{{route('creationsondage')}}" accept-charset="UTF-8">
        @csrf
<!-- Réalisation de 3 champs de formulaires écrit -->
<!-- Question sur une durée type number -->
<label for="duration">Durée du sondage</label>
<input type="number" name="duration" id="duration" value="" placeholder="(en min)">
<br>
<!-- Type de sondage, bouton radio -->
<label for="type">Type de sondage</label>
<input type="radio" name="type" id="type" value="text" checked>Texte
<input type="radio" name="type" id="type" value="music">Musique
<br>
<label for="question">Votre question</label>
<input type="text" name="title" id="title" value="" placeholder="Votre question">
<br>
<label for="answer1">Réponse 1</label>
<input type="text" name="answers[]" id="answer1" value="" placeholder="Réponse 1">
<br>
<label for="answer2">Réponse 2</label>
<input type="text" name="answers[]" id="answer2" value="" placeholder="Réponse 2">
<br>

<div id="dynamicFields">
    <!-- Les champs de réponse ajoutés dynamiquement seront insérés ici -->
  </div>

  <button type="button" id="addAnswer">Ajouter une réponse</button>
  <br>

<input type="submit" value="Valider">
</form>

@endsection


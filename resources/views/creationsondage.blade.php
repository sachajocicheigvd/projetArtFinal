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

<form method="post" action="{{ route('creationsondage') }}" accept-charset="UTF-8">
    @csrf
    <!-- Réalisation de 3 champs de formulaires écrit -->
    <!-- Question sur une durée type number -->
    <label for="duration">Durée du sondage</label>
    <input type="number" name="duration" id="duration" value="{{ old('duration') }}" placeholder="(en min)">
    @error('duration')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <!-- Type de sondage, bouton radio -->
    <label for="type">Type de sondage</label>
    <input type="radio" name="type" id="type" value="text" {{ old('type') == 'text' ? 'checked' : '' }}>Texte
    <input type="radio" name="type" id="type" value="music" {{ old('type') == 'music' ? 'checked' : '' }}>Musique
    @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <label for="question">Votre question</label>
    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Votre question">
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <label for="answer1">Réponse 1</label>
    <input type="text" name="answers[]" id="answer1" value="{{ old('answers.0') }}" placeholder="Réponse 1">
    @error('answers.0')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <label for="answer2">Réponse 2</label>
    <input type="text" name="answers[]" id="answer2" value="{{ old('answers.1') }}" placeholder="Réponse 2">
    @error('answers.1')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <div id="dynamicFields">
        <!-- Les champs de réponse ajoutés dynamiquement seront insérés ici -->
    </div>
    
    <button type="button" id="addAnswer">Ajouter une réponse</button>
    <br>
    
    <input type="submit" value="Valider">
</form>
@endsection

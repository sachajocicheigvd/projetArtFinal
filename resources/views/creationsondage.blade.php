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

<!-- Création d'un formulaire texte-->

<!-- Type de sondage, bouton radio -->
    <label for="type">Type de sondage</label>
    <input type="radio" name="type" id="type-text" value="text" {{ old('type') == 'text' ? 'checked' : '' }}>Texte
    <input type="radio" name="type" id="type-music" value="music" {{ old('type') == 'music' ? 'checked' : '' }}>Musique
    @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

<form id="formulaire-texte" style="display:none;" method="post" action="{{ route('creationsondage') }}" accept-charset="UTF-8">

<input type="radio" name="type" id="type-text" value="text" checked style="display:none;">
    @csrf
    <!-- Réalisation de 3 champs de formulaires écrit -->
    <!-- Question sur une durée type number -->
    <label for="duration">Durée du sondage</label>
    <input type="number" name="duration" id="duration" value="{{ old('duration') }}" placeholder="(en min)">
    @error('duration')
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
    
    <div id="dynamicFieldsText">
        <!-- Les champs de réponse ajoutés dynamiquement seront insérés ici -->
    </div>
    
    <button type="button" id="addAnswerText">Ajouter une réponse</button>
    <br>

    <input type="submit" value="Valider">

</form>

<form id="formulaire-music" style="display:none;" method="post" action="{{ route('creationsondage') }}" accept-charset="UTF-8" enctype="multipart/form-data">
<input type="radio" name="type" id="type-text" value="music" checked style="display:none;">
    @csrf
    <!-- Réalisation de 3 champs de formulaires écrit -->
    <!-- Question sur une durée type number -->
    <label for="duration">Durée du sondage</label>
    <input type="number" name="duration" id="duration" value="{{ old('duration') }}" placeholder="(en min)" required>
    @error('duration')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    
    <label for="question">Votre question</label>
    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Votre question" required>
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <label for="answer1">Réponse 1</label>
    <input type="text" name="answers[]" id="answer1" value="{{ old('answers.0') }}" placeholder="Réponse 1" required>
    @error('answers.0')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input type="text" name="artists[]" id="artist1" value="{{ old('artists.0') }}" placeholder="Artiste 1" required>
    @error('artists.0')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input type="file" name="files[]" required>
    @error('files.0')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <label for="answer2">Réponse 2</label>
    <input type="text" name="answers[]" id="answer2" value="{{ old('answers.1') }}" placeholder="Réponse 2" required>
    @error('answers.1')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input type="text" name="artists[]" id="artist2" value="{{ old('artists.1') }}" placeholder="Artiste 2" required>
    @error('artists.1')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <input type="file" name="files[]" id="file2" required>
    @error('files.1')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <div id="dynamicFieldsMusic">
        <!-- Les champs de réponse ajoutés dynamiquement seront insérés ici -->
    </div>
    
    <button type="button" id="addAnswerMusic">Ajouter une réponse</button>
    <br>


    <input type="submit" value="Valider">

</form>
@endsection

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
    <input type="radio" name="type" id="type-text" class="radioButton" value="text" {{ old('type') == 'text' ? 'checked' : '' }}/><label for="type-text" class="choixType typeText">Texte</label>
    <input type="radio" name="type" id="type-music" class="radioButton" value="music" {{ old('type') == 'music' ? 'checked' : '' }}/><label for="type-music" class="choixType">Musique</label><br/>
    <svg width="400" height="40">
    <rect width="120" height="3" fill="#767676" id="barreTexte" x="90"/>
    <rect width="120" height="3" fill="#767676" id="barreMusique" x="210"/>
    </svg>

<form id="formulaire-texte" style="display:none;" method="post" action="{{ route('creationsondage') }}" accept-charset="UTF-8">

<input type="radio" name="type" id="type-text" value="text" checked style="display:none;">
    @csrf
    <!-- Réalisation de 3 champs de formulaires écrit -->
    <!-- Question sur une durée type number -->
    <input type="text" name="title" id="title" class="secondaire reponseTexte" value="{{ old('title') }}" placeholder="Votre question">
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <input type="number" name="duration" id="duration" class="secondaire nombre" value="{{ old('duration') }}" placeholder="(en min)">
    @error('duration')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <input type="text" name="answers[]" id="answer1" class="secondaire reponseTexte" value="{{ old('answers.0') }}" placeholder="Réponse 1">
    @error('answers.0')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <input type="text" name="answers[]" id="answer2" class="secondaire reponseTexte" value="{{ old('answers.1') }}" placeholder="Réponse 2">
    @error('answers.1')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <div id="dynamicFieldsText">
        <!-- Les champs de réponse ajoutés dynamiquement seront insérés ici -->
    </div>
    
    <button type="button" id="addAnswerText" class="secondaire add"><svg id="ajoute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#767676" class="w-6 h-6" width="24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg></button>
    <br>

    <input type="submit" value="Envoyer" class="primaire marge-fictive">

</form>

<form id="formulaire-music" style="display:none;" method="post" action="{{ route('creationsondage') }}" accept-charset="UTF-8" enctype="multipart/form-data">
<input type="radio" name="type" id="type-text" value="music" checked style="display:none;">
    @csrf
    <!-- Réalisation de 3 champs de formulaires écrit -->
    <!-- Question sur une durée type number -->
    <input type="text" name="title" id="title" class="secondaire reponseTexte" value="{{ old('title') }}" placeholder="Votre question" required>
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <input type="number" name="duration" id="duration" class="secondaire nombre" value="{{ old('duration') }}" placeholder="(en min)" required>
    @error('duration')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <input type="text" name="answers[]" id="answer1" class="secondaire reponseMusique" value="{{ old('answers.0') }}" placeholder="Titre 1" required>
    @error('answers.0')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input type="text" name="artists[]" id="artist1" class="secondaire reponseMusique" value="{{ old('artists.0') }}" placeholder="Artiste 1" required>
    @error('artists.0')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br/>
    <label for="files1" class="custom-file secondaire">
    Cover 1
    </label>
    <input type="file" name="files[]" id="files1" class="upload" required>
    @error('files.0')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <input type="text" name="answers[]" id="answer2" class="secondaire reponseMusique" value="{{ old('answers.1') }}" placeholder="Titre 2" required>
    @error('answers.1')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input type="text" name="artists[]" id="artist2" class="secondaire reponseMusique" value="{{ old('artists.1') }}" placeholder="Artiste 2" required>
    @error('artists.1')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br/>
    <label for="files2" class="custom-file secondaire">
    Cover 2
    </label>
    <input type="file" name="files[]" id="files2" class="upload" required>
    @error('files.1')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <div id="dynamicFieldsMusic">
        <!-- Les champs de réponse ajoutés dynamiquement seront insérés ici -->
    </div>
    
    <button type="button" id="addAnswerMusic" class="secondaire add"><svg id="ajoute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#767676" class="w-6 h-6" width="24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg></button>
    <br>


    <input type="submit" value="Envoyer" class="primaire marge-fictive">

</form>
<script>
    const boutonsRadio = document.querySelectorAll('input[type="radio"]');
    const barreTexte = document.getElementById('barreTexte');
    const barreMusique = document.getElementById('barreMusique');

// Ajoutez un écouteur d'événements "click" à chaque bouton radio
boutonsRadio.forEach(bouton => {
  bouton.addEventListener('click', () => {
    if(bouton.id == "type-text"){
    document.querySelector(`[for="type-text"]`).style.color = "#27eb42";
    document.querySelector(`[for="type-music"]`).style.color = "#767676";
    barreTexte.style.fill = "#27eb42";
    barreMusique.style.fill = "#767676";
    } else if(bouton.id == "type-music"){
    document.querySelector(`[for="type-text"]`).style.color = "#767676";
    document.querySelector(`[for="type-music"]`).style.color = "#27eb42";
    barreTexte.style.fill = "#767676";
    barreMusique.style.fill = "#27eb42";
    }
    
    
    const idBoutonCliqué = bouton.id;
    
    // // Utilisez l'ID de l'élément pour effectuer les opérations nécessaires
    console.log('Bouton radio cliqué:', idBoutonCliqué);
    // // const labelRadio = document.querySelector(`[for="${idBoutonCliqué}"]`);

    // labelRadio.style.color = "#27eb42";
  });
});

// queryselector d'un label en fonction de l'attribut for

</script>
@endsection

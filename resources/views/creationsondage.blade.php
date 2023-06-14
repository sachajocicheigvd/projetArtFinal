@extends('template')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js'></script>
</head>

@section('title')
<title>Création sondage</title>
@endsection

@section('header')
<h1 class="page-header">Création sondage</h1>
@endsection

@section('contenu')

<!-- Création d'un formulaire texte-->

<!-- Type de sondage, bouton radio -->
<div class="containerSondage">
    <input type="radio" name="type" id="type-text" class="radioButton" value="text" {{ old('type') == 'text' ? 'checked' : '' }}/><label for="type-text" class="choixType typeText">Texte</label>
    <input type="radio" name="type" id="type-music" class="radioButton" value="music" {{ old('type') == 'music' ? 'checked' : '' }}/><label for="type-music" class="choixType">Musique</label><br/>
    <svg width="400" height="25">
    <rect width="120" height="3" fill="#767676" id="barreTexte" x="90"/>
    <rect width="120" height="3" fill="#767676" id="barreMusique" x="210"/>
    </svg>
</div>

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
    "use strict";

// Rajout de question dans le formulaire texte

let dynamicFieldsTextContainer = document.getElementById("dynamicFieldsText");
let addAnswerButtonText = document.getElementById("addAnswerText");
let answerCounterText = 3;

addAnswerButtonText.addEventListener("click", function () {
    let newAnswerInput = document.createElement("input");
    newAnswerInput.setAttribute("type", "text");
    newAnswerInput.setAttribute("name", "answers[]");
    newAnswerInput.setAttribute("placeholder", "Réponse " + answerCounterText);
    newAnswerInput.setAttribute("id", "answer" + answerCounterText);
    newAnswerInput.setAttribute("class", "secondaire reponseTexte");
    // put required attribute on the newAnswerInput
    newAnswerInput.setAttribute("required", "required");

    dynamicFieldsTextContainer.appendChild(newAnswerInput);
    dynamicFieldsTextContainer.appendChild(document.createElement("br"));
    answerCounterText++;
});

// Rajout de question dans le formulaire musique

let dynamicFieldsMusicContainer = document.getElementById("dynamicFieldsMusic");
let addAnswerButtonMusic = document.getElementById("addAnswerMusic");
let answerCounterMusic = 3;

addAnswerButtonMusic.addEventListener("click", function () {
    let newAnswerInput = document.createElement("input");
    newAnswerInput.setAttribute("type", "text");
    newAnswerInput.setAttribute("name", "answers[]");
    newAnswerInput.setAttribute("placeholder", "Titre " + answerCounterMusic);
    newAnswerInput.setAttribute("id", "answer" + answerCounterMusic);
    newAnswerInput.setAttribute("class", "secondaire reponseMusique titreAdd");
    newAnswerInput.setAttribute("required", "required");

    let newArtistInput = document.createElement("input");
    newArtistInput.setAttribute("type", "text");
    newArtistInput.setAttribute("name", "artists[]");
    newArtistInput.setAttribute("placeholder", "Artiste " + answerCounterMusic);
    newArtistInput.setAttribute("id", "artist" + answerCounterMusic);
    newArtistInput.setAttribute("class", "secondaire reponseMusique");
    newArtistInput.setAttribute("required", "required");

    let newFileLabel = document.createElement("label");
    newFileLabel.setAttribute("for", "files" + answerCounterMusic);
    newFileLabel.setAttribute("class", "custom-file secondaire");
    newFileLabel.innerHTML = "Cover" + answerCounterMusic;

    let newFileInput = document.createElement("input");
    newFileInput.setAttribute("type", "file");
    newFileInput.setAttribute("name", "files[]");
    newFileInput.setAttribute("id", "files" + answerCounterMusic);
    newFileInput.setAttribute("required", "required");
    newFileInput.setAttribute("class", "upload");

    dynamicFieldsMusicContainer.appendChild(newAnswerInput);
    dynamicFieldsMusicContainer.appendChild(newArtistInput);
    dynamicFieldsMusicContainer.appendChild(document.createElement("br"));
    dynamicFieldsMusicContainer.appendChild(newFileLabel);
    dynamicFieldsMusicContainer.appendChild(newFileInput);
    dynamicFieldsMusicContainer.appendChild(document.createElement("br"));
    answerCounterMusic++;
    refreshSelection();
});

// Affichage formulaire texte ou musique

let formulaireTexte = document.querySelector("#formulaire-texte");
let typeText = document.querySelectorAll("input[type=radio]");

typeText.forEach(function (element) {
    element.addEventListener("change", function () {
        if (this.value == "text") {
            formulaireTexte.style.display = "block";
            document.querySelector("#formulaire-music").style.display = "none";
        }

        if (this.value == "music") {
            document.querySelector("#formulaire-music").style.display = "block";
            formulaireTexte.style.display = "none";
        }
    });
});

const inputs = document.querySelectorAll(".upload");
const inputsLabel = document.querySelectorAll(".custom-file");

for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener("change", function (e) {
        inputsLabel[i].innerHTML = inputs[i].files[0].name;
        inputsLabel[i].style.color = "#FFFFFF";
    });
}

const refreshSelection = () => {
    const inputs = document.querySelectorAll(".upload");
    const inputsLabel = document.querySelectorAll(".custom-file");

    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener("change", function (e) {
            inputsLabel[i].innerHTML = inputs[i].files[0].name;
            inputsLabel[i].style.color = "#FFFFFF";
        });
    }
};

const boutonsRadio = document.querySelectorAll('input[type="radio"]');
const barreTexte = document.getElementById("barreTexte");
const barreMusique = document.getElementById("barreMusique");

// Ajoutez un écouteur d'événements "click" à chaque bouton radio
boutonsRadio.forEach((bouton) => {
    bouton.addEventListener("click", () => {
        if (bouton.id == "type-text") {
            document.querySelector(`[for="type-text"]`).style.color = "#27eb42";
            document.querySelector(`[for="type-music"]`).style.color =
                "#767676";
            barreTexte.style.fill = "#27eb42";
            barreMusique.style.fill = "#767676";
        } else if (bouton.id == "type-music") {
            document.querySelector(`[for="type-text"]`).style.color = "#767676";
            document.querySelector(`[for="type-music"]`).style.color =
                "#27eb42";
            barreTexte.style.fill = "#767676";
            barreMusique.style.fill = "#27eb42";
        }

        //const idBoutonCliqué = bouton.id;

        // // Utilisez l'ID de l'élément pour effectuer les opérations nécessaires
        //console.log("Bouton radio cliqué:", idBoutonCliqué);
        // // const labelRadio = document.querySelector(`[for="${idBoutonCliqué}"]`);

        // labelRadio.style.color = "#27eb42";
    });
});
</script>
@endsection

<style>

.active_label{
	visibility: visible;
}
.dev_info{
	font-family: Helvetica, Arial, sans-serif;
	font-size: 13pt;
	color: #FFF;
}
#float_body{
	background: #217163;
}

.float_container{
	border: 1px solid #FFF;
	background: #FFF;
	margin: 0 auto;
	position: relative;
	width: 350px;
	padding: 10px 10px 15px 10px;
	border-radius: 6px;
	-webkit-box-shadow: 2px 2px 2px #3E3B3B;
	-moz-box-shadow: 2px 2px 2px #3E3B3B;
	box-shadow: 2px 2px 2px #3E3B3B;
}
.float {
  position: relative;
  margin-top: 10px;
}

.float input {
  font-size: 15pt;
  border: none;
  outline: none;
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  background: transparent;
  z-index: 2;
  border: 1px solid #ccc;
  text-indent: 20px;
}

.float label {
  color: #ccc;
  display: block;
  font-size: 13pt;
  left: 20px;
  position: absolute;
  top: 0;
  z-index: 1;
  -moz-transform-origin: 0 0em;
  -ms-transform-origin: 0 0em;
  -webkit-transform-origin: 0 0em;
  transform-origin: 0 0em;
  -moz-transition: -moz-transform 160ms, color 200ms;
  -o-transition: -o-transform 160ms, color 200ms;
  -webkit-transition: -webkit-transform 160ms, color 200ms;
  transition: transform 160ms, color 200ms;
  -moz-transform: scale(1, 1) rotateY(0);
  -ms-transform: scale(1, 1) rotateY(0);
  -webkit-transform: scale(1, 1) rotateY(0);
  transform: scale(1, 1) rotateY(0);
  
}

.float-active label {
	color: #165DCC;
	-moz-transform: scale(0.65, 0.65) rotateY(0);
	-ms-transform: scale(0.65, 0.65) rotateY(0);
	-webkit-transform: scale(0.65, 0.65) rotateY(0);
	transform: scale(0.65, 0.65) rotateY(0);
}

.float-active input {
  line-height: 2.8em;
  width: 100%;
}

.inactive_label{
	visibility: hidden;
}

input, .float {
  font-family: Helvetica, Arial, sans-serif;
  font-size: 15pt;
  line-height: 2em;
  height: 2em;
  padding: 0;		  
  width:100%;
}

</style>



<script>
/*!
 * Float.js v1
 * https://sangramjagtap.github.io/Float.js/
 * https://codepen.io/sangramjagtap/pen/pyPdPb
 * Licensed MIT © Sangram Jagtap
 */

 $(document).ready(function(){
  function floatLabel(event){
    var input=$(this);
      var val=$.trim(input.val());
        input.parent().addClass("float-active");
		$(this).siblings().each(function() {
		 if(val!="")
		 {
			 if($(this).hasClass('first_label'))
			  {
				$(this).addClass("inactive_label");
				$(this).removeClass("active_label");    		  
			  }  
			  else if($(this).hasClass('inactive_label'))
			  {
				$(this).addClass("active_label");
				$(this).removeClass("inactive_label");    		  
			  }
		 }
		 else
		 {
			if($(this).hasClass('first_label'))
			  {
				$(this).addClass("active_label");
				$(this).removeClass("inactive_label");    		  
			  }  
			  else
			  {
				$(this).addClass("inactive_label");
				$(this).removeClass("active_label");    		  
			  } 
		 }
		 });
  }
  function floatBack(event){
    var input=$(this);
      var val=input.val();
      if(val!="")
        input.parent().addClass("float-active");
	  else
        input.parent().removeClass("float-active");   
  } 
  $(".float input").keyup(floatLabel);
  $(".float input").focus(floatLabel);
  $(".float input").blur(floatBack);
  $(".float input").change(floatLabel);
});
    


</script>
